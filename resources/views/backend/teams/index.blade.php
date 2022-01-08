 @extends('backend.layouts.app')
 @section('team','active')
 @section('content')
    <div class="container pt-3">
        <div class="card">
            <div class="card-header">
                <div class="">
                    @can('create_team')
                    <a href="{{url('admin/teams/create')}}" class="btn btn-theme "><i class="fas fa-circle-plus"></i></a>
                    @endcan
                    <h5 class="float-right pt-1" style="font-weight: 700">Team Dashboard</h5>
                </div>
            </div>


            <div class="card-body">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover" id="team-table" style="width: 100%">
                        <thead>
                            <th>League</th>
                            <th>Name MM</th>
                            <th>Name EN</th>
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
             let table = $('#team-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/teams/datatables/ssd",
                columns : [
                    {  data : 'league_id' , name : 'league_id' },
                    {  data : 'name_mm' , name : 'name_mm' },
                    {  data : 'name_en' , name : 'name_en' },
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
                                        url : "/admin/teams/"+id,
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