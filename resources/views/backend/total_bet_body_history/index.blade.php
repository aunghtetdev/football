@extends('backend.layouts.app')
@section('totalbet-body-history','active')
@section('content')
   <div class="container pt-3">
      <div class="d-flex justify-content-between">
        <div class="col-md-8">
            <div class="d-inline mr-3">
                <button class="btn btn-warning btn-sm" style="width :40px ; height:24px"></button>
                <span class="font-weight-bolder"> ဘော်ဒီ</span>
            </div>
            <div class="d-inline">
                <button class="btn btn-info btn-sm" style="width :40px ; height:24px"></button>
                <span class="font-weight-bolder"> ဂိုးပေါင်း</span>
            </div>
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
          
        <table class="table table-bordered table-hover" id="bet-body-history-table" style="width: 100% ; overflow-x :auto">
            <thead>
                <tr class="font-weight-bolder">
                    <th class="no-sort">အသင်း</th>
                    <th class="no-sort">လောင်းအသင်း</th>
                    <th class="no-sort">ဂိုး</th>
                    <th class="no-sort">Live ကြေး</th>
                    <th class="no-sort">Bet Id</th>
                    <th class="no-sort">လောင်းကြေး</th>
                    <th class="no-sort">လျော်ကြေး</th>
                    <th class="no-sort">နိုင်/ရှူံး</th>
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

        let table = $('#bet-body-history-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/bets-history/total-body/datatables/ssd",
            columns : [
                {  data : 'over_team_id' , name : 'over_team_id' },
                {  data : 'bet_team_id' , name : 'bet_team_id' },
                {  data : 'goal' , name : 'goal' },
                {  data : 'live_odd_id' , name : 'live_odd_id' },
                {  data : 'bet_id' , name : 'bet_id' },
                {  data : 'bet_amount' , name : 'bet_amount' },
                {  data : 'win_amount' , name : 'win_amount' },
                {  data : 'bet_result' , name : 'bet_result' },
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
                        url : `/admin/bets-history/total-body/datatables/ssd?date=${date}`,
                        type : "GET",
                        success : function(res){
                            let data = res.data.map(i => 
                                `<tr>
                                    <td>${i.over_team_name} Vs ${i.under_team_name}</td>
                                    <td>${i.bet_team_id}</td>
                                    <td>${i.over_team_goal} - ${i.under_team_goal}</td>
                                    <td>${i.live_odd_id}</td>
                                    <td>${i.bet_id}</td>
                                    <td>${i.bet_amount}</td>
                                    <td>${i.win_amount}</td>
                                    <td>${i.bet_result}</td>
                                </tr>`
                            );


                            $('#history').html(data);
                        }
                    });
                  });
            
        })
    </script>
@endsection