<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UUIDGenerator;
use App\Models\User;
use App\Models\Wallet;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Requests\UserEdit;
use App\Http\Requests\AdminEdit;
use App\Http\Requests\WalletAdd;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UserCreate;
use App\Http\Requests\AdminCreate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WalletSubstract;
use App\Models\WalletHistory;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->can('view_balance')) {
            return view('backend.wallets.index');
        } else {
            return abort(404);
        }
    }

    public function ssd()
    {
        $wallet = Wallet::query();
        return Datatables::of($wallet)
        ->editColumn('user_id', function ($each) {
            return $each->user ? $each->user->username : '';
        })
        ->addColumn('action', function ($each) {
            $add_icon = "";
            $substract_icon ="";
            if (Auth()->user()->can('add_balance')) {
                $add_icon = '<a href="'.url('admin/wallets/'.$each->user_id.'/add').'" class="text-success"><i class="fas fa-circle-plus"></i></a>';
            }

            if (Auth()->user()->can('substract_balance')) {
                $substract_icon = '<a href="'.url('admin/wallets/'.$each->user_id.'/substract').'" class="text-danger" ><i class="fas fa-circle-minus"></i></a>';
            }
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
        if (Auth()->user()->can('add_balance')) {
            $wallet = Wallet::where('user_id', $id)->first();
            return view('backend.wallets.add', compact('wallet'));
        } else {
            return abort(404);
        }
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
            $history->is_deposit = 1;
            $history->date = now()->format('Y-m-d');
            $history->save();

            DB::commit();

            return redirect('/admin/wallets')->with('create', 'Added');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/wallets/'.$request->user_id.'/add')->withErrors(['fail' => 'Something wrong'.$e->getMessage()]);
        }
    }

    public function substract($id)
    {
        if (Auth()->user()->can('substract_balance')) {
            $wallet = Wallet::where('user_id', $id)->first();
            return view('backend.wallets.substract', compact('wallet'));
        } else {
            return abort(404);
        }
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
            $history->is_deposit = 0;
            $history->date = now()->format('Y-m-d');
            $history->save();

            DB::commit();

            return redirect('/admin/wallets')->with('create', 'Substracted');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('admin/wallets/'.$request->user_id.'/substract')->withErrors(['fail' => 'Something wrong'.$e->getMessage()]);
        }
    }
}
