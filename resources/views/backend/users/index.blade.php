 @extends('backend.layouts.app')
 @section('user','active')
 @section('content')
    <div class="container pt-3">
        <div class="card">
            <div class="card-header">
                <div class="">
                    <a href="{{url('admin/users/create')}}" class="btn btn-primary "><i class="fas fa-user-plus"></i></a>
                    <h5 class="float-right pt-1" style="font-weight: 700">User Dashboard</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="user-table" style="width: 100%">
                        <thead>
                            <th>Username</th>
                            <th>Action</th>
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
             let table = $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/users/datatables/ssd",
                columns : [
                    {  data : 'username' , name : 'username' },
                    {  data : 'action' , name : 'action' }
                ]
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
                                        url : "/admin/users/"+id,
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