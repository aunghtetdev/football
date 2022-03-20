<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    protected $model;

    protected $rView = 'backend.ads.';

    public function __construct(Ad $model)
    {
        return $this->model = $model;
    }

    public function index()
    {
        PermissionChecker::CheckPermission('ads');
        return view($this->rView.'index');
    }

    public function ssd()
    {
        $ads = $this->model->query();
        return Datatables::of($ads)
        ->addColumn('action', function ($each) {
            $edit_icon = "";
            $delete_icon = "";

            $edit_icon = '<a href="'.url('admin/ads/'.$each->id.'/edit').'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
            
            $delete_icon = '<a href="'.url('admin/ads/'.$each->id).'" data-id="'.$each->id.'" class="text-danger" id="delete"><i class="fas fa-trash"></i></a>';
            
            return '<div class="action-icon">'.$edit_icon . $delete_icon.'</div>';
        })
        ->editColumn('image', function ($each) {
            return '<img src="'.$each->adImage().'" style="width: 30px; height:30px; border-radius:100%;" >';
        })
        ->rawColumns(['image','action'])
        ->make(true);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        PermissionChecker::CheckPermission('ads');
        return view($this->rView . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name = null;
        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = uniqid().'_'.time().'.'.$image_file->getClientOriginalExtension();
            Storage::disk('public')->put('ads/'.$image_name, file_get_contents($image_file));
        }
        
        $ad = $this->model->create($request->except('image'));
        $ad->update([
            'image' => $image_name
        ]);
        
        
        return redirect('/admin/ads')->with('create', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        PermissionChecker::CheckPermission('ads');
        $ad = Ad::findOrFail($id);
    
        return view($this->rView.'edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return $request->all();
        $ad = $this->model->find($id)->update($request->except('image'));
        
        $image_name = $this->model->find($id)->image;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('ads/'.$image_name);
            $image_file = $request->file('image');
            $image_name = uniqid().'_'.time().'.'.$image_file->getClientOriginalExtension();
            Storage::disk('public')->put('ads/'.$image_name, file_get_contents($image_file));
        }

        $this->model->find($id)->update([
            'image' => $image_name
        ]);

        return redirect('/admin/ads')->with('update', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return 'success';
    }
}
