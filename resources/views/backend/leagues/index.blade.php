 @extends('backend.layouts.app')
 @section('league','active')
 @section('content')
    <div class="container pt-3">
        <div class="card">
            <div class="card-header">
                <div class="">
                    <a href="{{url('admin/leagues/create')}}" class="btn btn-primary "><i class="fas fa-circle-plus"></i></a>
                    <h5 class="float-right pt-1" style="font-weight: 700">League Dashboard</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="league-table" style="width: 100%">
                        <thead>
                            <th>Name MM</th>
                            <th>Name EN</th>
                            <th>Order</th>
                            <th>Image</th>
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
             let table = $('#league-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/leagues/datatables/ssd",
                columns : [
                    {  data : 'name_mm' , name : 'name_mm' },
                    {  data : 'name_en' , name : 'name_en' },
                    {  data : 'order' , name : 'order' },
                    {  data : 'image' , name : 'image' },
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
                                        url : "/admin/leagues/"+id,
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