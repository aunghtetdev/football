 @extends('backend.layouts.app')
 @section('odds','active')
 @section('content')
    <div class="container pt-3">
        <div class="card">
            <div class="card-header">
                <div class="">
                    <a href="{{url('admin/odds/create')}}" class="btn btn-theme "><i class="fas fa-user-plus"></i></a>
                    <h5 class="float-right pt-1" style="font-weight: 700">Odds Dashboard</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="odds-table" style="width: 100%">
                                    <thead>
                                        <th>Body</th>
                                        <th>Over Team</th>
                                        <th>Under Team</th>
                                        <th>Total Goal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="odds-table" style="width: 100%">
                                    <thead>
                                        <th>Odds</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @endsection
 @section('scripts')
     <script>
         $(document).ready(function(){
             let table = $('#odds-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "/admin/odds/datatables/ssd",
                columns : [
                    {  data : 'body_value' , name : 'body_value', class: 'text-center'},
                    {  data : 'over_team_name' , name : 'over_team_name', class: 'text-center'},
                    {  data : 'under_team_name' , name : 'under_team_name', class: 'text-center'},
                    {  data : 'goal_total_value' , name : 'goal_total_value', class: 'text-center'},
                    {  data : 'status' , name : 'status', class: 'text-center'},
                    {  data : 'action' , name : 'action', class: 'text-center'}
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
                                        url : "/admin/odds/"+id,
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