@extends('backend.layouts.app')
@section('role','active')
@section('content')
   <div class="container pt-3">
       <div class="card">
           <div class="card-header">
               <div class="">
                   @can('create_role')
                   <a href="{{url('admin/roles/create')}}" class="btn btn-theme "><i class="fas fa-circle-plus"></i></a>
                   @endcan
                   <h5 class="float-right pt-1" style="font-weight: 700">Role Dashboard</h5>
               </div>
           </div>
           <div class="card-body">
               <div class="col-lg-12">
                   <table class="table table-bordered table-hover" id="permission-table" style="width: 100%">
                       <thead>
                           <th>Name</th>
                           <th>Permission</th>
                           <th>Action</th>
                           <th class="hidden no-search">Updated_at</th>
                       </thead>
                       <tbody>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            let table = $('#permission-table').DataTable({
               processing: true,
               serverSide: true,
               ajax: "/admin/roles/datatables/ssd",
               columns : [
                   {  data : 'name' , name : 'name' },
                   {  data : 'permission' , name : 'permission' },
                   {  data : 'action' , name : 'action' },
                   {  data : 'updated_at' , name : 'updated_at'}
               ],
               order : [3,"desc"]
            });

            $(document).on('click','#delete',function(e){
               e.preventDefault();

               let id = $(this).data('id');
               
               const swalWithBootstrapButtons = Swal.mixin({
                               customClass: {
                                   confirmButton: 'btn btn-success',
                                   cancelButton: 'btn btn-danger'
                               },
                               buttonsStyling: false
                               })
                               swalWithBootstrapButtons.fire({
                               title: 'Are you sure?',
                               text: "You want to delete!",
                               icon: 'warning',
                               showCancelButton: true,
                               confirmButtonText: 'Confirm',
                               cancelButtonText: 'Cancel',
                               reverseButtons: true
                               }).then((result) => {
                               if (result.isConfirmed) {
                                   $.ajax({
                                       url : "/admin/roles/"+id,
                                       type : "DELETE",
                                       success : function(){
                                           table.ajax.reload();
                                       }
                                   });
                               }
                               })
                      
            })
        })
    </script>
@endsection