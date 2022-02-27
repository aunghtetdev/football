<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Wallet;
use App\Models\AdminUser;
use App\Helper\WalletHelper;
use Illuminate\Http\Request;
use App\Helper\UUIDGenerator;
use App\Models\WalletHistory;
use App\Http\Requests\UserEdit;
use App\Http\Requests\AdminEdit;
use App\Http\Requests\WalletAdd;
use Yajra\Datatables\Datatables;
use App\Helper\PermissionChecker;
use App\Http\Requests\UserCreate;
use App\Http\Requests\AdminCreate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WalletSubstract;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        PermissionChecker::CheckPermission('balance');
        return view('backend.wallets.index');
    }

    public function ssd()
    {
        $wallet = Wallet::query();
        return Datatables::of($wallet)
        ->filterColumn('user_id', function ($query, $keyword) {
            $query->whereHas('user', function ($q1) use ($keyword) {
                $q1->where('username', 'like', '%'.$keyword.'%');
            });
        })
        ->editColumn('user_id', function ($each) {
            return $each->user ? $each->user->username : '';
        })
        ->addColumn('action', function ($each) {
            $add_icon = "";
            $substract_icon ="";

            $add_icon = '<a href="'.url('admin/wallets/'.$each->user_id.'/add').'" class="text-success"><i class="fas fa-circle-plus"></i></a>';
            
            $substract_icon = '<a href="'.url('admin/wallets/'.$each->user_id.'/substract').'" class="text-danger" ><i class="fas fa-circle-minus"></i></a>';
            
            return '<div class="action-icon">'.$add_icon . $substract_icon.'</div>';
        })
        ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add($id)
    {
        PermissionChecker::CheckPermission('balance');
        $wallet = Wallet::where('user_id', $id)->first();
        return view('backend.wallets.add', compact('wallet'));
    }

    public function store(WalletAdd $request)
    {
        $add_money = Wallet::where('user_id', $request->user_id)->first();

        DB::beginTransaction();
        
        try {
            $add_money->increment('amount', $request->amount);
            $add_money->update();

            $history = new WalletHistory();
            $history->user_id = $request->user_id;
            $history->trx_id = UUIDGenerator::Trx_id();
            $history->amount = $request->amount;
            $history->is_deposit = 'deposit';
            $history->date = now()->format('Y-m-d H:i:s');
            $history->save();

            WalletHelper::monthly_chart($request->amount, 'deposit');

            DB::commit();

            return redirect('/admin/wallets')->with('create', 'Added');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/wallets/'.$request->user_id.'/add')->withErrors(['fail' => 'Something wrong'.$e->getMessage()]);
        }
    }

    public function substract($id)
    {
        PermissionChecker::CheckPermission('balance');
        $wallet = Wallet::where('user_id', $id)->first();
        return view('backend.wallets.substract', compact('wallet'));
    }

    public function extract(WalletSubstract $request)
    {
        $substract_money = Wallet::where('user_id', $request->user_id)->first();

        DB::beginTransaction();
        
        try {
            $substract_money->decrement('amount', $request->amount);
            $substract_money->update();
        
            $history = new WalletHistory();
            $history->user_id = $request->user_id;
            $history->trx_id = UUIDGenerator::Trx_id();
            $history->amount = $request->amount;
            $history->is_deposit = 'withdraw';
            $history->date = now()->format('Y-m-d H:i:s');
            $history->save();

            WalletHelper::monthly_chart($request->amount, 'withdraw');
            
            DB::commit();

            return redirect('/admin/wallets')->with('create', 'Substracted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/wallets/'.$request->user_id.'/substract')->withErrors(['fail' => 'Something wrong'.$e->getMessage()]);
        }
    }
}
