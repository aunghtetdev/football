@extends('backend.layouts.app')
@section('totalbet-moung-history','active')
@section('content')
   <div class="container pt-3">
      <div class="d-flex justify-content-between">
        <div class="col-md-8">
            {{-- <div class="d-inline mr-3">
                <button class="btn btn-warning btn-sm" style="width :40px ; height:24px"></button>
                <span class="font-weight-bolder"> ဘော်ဒီ</span>
            </div>
            <div class="d-inline">
                <button class="btn btn-info btn-sm" style="width :40px ; height:24px"></button>
                <span class="font-weight-bolder"> ဂိုးပေါင်း</span>
            </div> --}}
        </div>

         <div class="col-md-4 p-0">
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
               </div>
               <input type="text" class="form-control" value="{{request()->date}}" id="match-total-bet" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
             </div>
         </div>

         
      </div>
      
       <div class="card p-3">
          
        <table class="table table-bordered table-hover" id="bet-moung-history-table" style="width: 100% ; overflow-x :auto">
            <thead>
                <tr class="font-weight-bolder">
                    <th class="no-sort">Bet Id</th>
                    <th class="no-sort">လောင်းကြေး</th>
                    <th class="no-sort">လျော်ကြေး</th>
                    <th class="no-sort">နိုင်/ရှူံး</th>
                    <th class="no-sort">Detail</th>
                </tr>
            </thead>
            <tbody id="history">
                
            </tbody>
        </table>
        </div>
        
   </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

        let table = $('#bet-moung-history-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/bets-history/total-moung/datatables/ssd",
            columns : [
                {  data : 'bet_id' , name : 'bet_id' },
                {  data : 'bet_amount' , name : 'bet_amount' },
                {  data : 'win_amount' , name : 'win_amount' },
                {  data : 'bet_result' , name : 'bet_result' },
                {  data : 'detail' , name : 'detail' },
            ]
            });
            
           

         $('#match-total-bet').daterangepicker({
                    "singleDatePicker": true,
                    "locale" : {
                        format : "YYYY-MM-DD"
                    }
                });
            
                
                $('#match-total-bet').on('apply.daterangepicker', function(ev, picker) {
                   let date = picker.startDate.format('YYYY-MM-DD') ?? moment().format('YYYY-MM-DD');
                   $.ajax({
                        url : `/admin/bets-history/total-moung/datatables/ssd?date=${date}`,
                        type : "GET",
                        success : function(res){
                            let data = res.data.map(i => 
                                `<tr>
                                    <td>${i.bet_id}</td>
                                    <td>${i.bet_amount}</td>
                                    <td>${i.win_amount}</td>
                                    <td>${i.bet_result}</td>
                                </tr>`
                            );
                            console.log(res.data);

                            $('#history').html(data);
                        }
                    });
                  });
            
        })
    </script>
@endsection