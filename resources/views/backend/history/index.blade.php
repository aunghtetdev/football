@extends('backend.layouts.app')
@section('history','active')
@section('content')
   <div class="container pt-3">
       <h5 class="text-center" style="font-weight: 800px">Balance History</h5>
       <div class="card">
           <div class="card-body">
               <div class="col-md-12">
                   <table class="table table-bordered table-hover" id="wallet-history-table" style="width: 100%">
                       <thead>
                           <th>Username</th>
                           <th>Transaction Id</th>
                           <th>Type</th>
                           <th>Amount</th>
                           <th>Date</th>
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
            let table = $('#wallet-history-table').DataTable({
               processing: true,
               serverSide: true,
               ajax: "/admin/wallets/history/datatables/ssd",
               columns : [
                   {  data : 'user_id' , name : 'user_id' },
                   {  data : 'trx_id' , name : 'trx_id' },
                   {  data : 'type' , name : 'type' },
                   {  data : 'amount' , name : 'amount' },
                   {  data : 'updated_at' , name : 'updated_at' },
               ],
               order : [3,"desc"]
            });

           
        })
    </script>
@endsection