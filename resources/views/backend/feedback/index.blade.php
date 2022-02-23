@extends('backend.layouts.app')
@section('feedback','active')
@section('content')
   <div class="container pt-3">
       <h5 class="text-center" style="font-weight: 800px">Feedbacks</h5>
       <div class="card">
           <div class="card-body">
               <div class="col-md-12">
                   <table class="table table-bordered table-hover" id="feedback-table" style="width: 100%">
                       <thead>
                           <th>Username</th>
                           <th>Title</th>
                           <th>Message</th>
                           <th>Created At</th>
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
            let table = $('#feedback-table').DataTable({
               processing: true,
               serverSide: true,
               ajax: "/feedbacks/datatables/ssd",
               columns : [
                   {  data : 'username' , name : 'username', class: 'text-center' },
                   {  data : 'title' , name : 'title', class: 'text-center' },
                   {  data : 'message' , name : 'message', class: 'text-center' },
                   {  data : 'created_at' , name : 'created_at', class: 'text-center' },
               ],
               order : [3,"desc"]
            });

           
        })
    </script>
@endsection