@extends('backend.layouts.app')
@section('totalbet-body','active')
@section('content')
   <div class="container pt-3">
      <div class="d-flex justify-content-end">
         <div class="col-md-4 p-0">
            <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="inputGroup-sizing-default">Date</span>
               </div>
               <input type="text" class="form-control" value="{{request()->date}}" id="match-total-bet" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
             </div>
         </div>
      </div>
    @foreach ($bet_bodys as $bet_body)
       <div class="card p-3">
          <span class="h5 font-weight-bolder">{{$bet_body->over_team_name}} Vs {{$bet_body->under_team_name}}</span>
           <table class="table table-bordered table-striped">
               <thead>
                  <tr class="font-weight-bolder">
                    <th>အပေါ်သင်း</th>
                    <th>အောက်သင်း</th>
                    <th>ဂိုးပေါ်</th>
                    <th>ဂိုးအောက်</th>
                  </tr>
               </thead>
               <tbody>
                  {{$bet_body->bet_total_goal}}
                  <tr>
                    <td>
                        <div class="d-flex justify-content-between">
                         <span>{{$bet_body->overteam_amount}}</span>
                         <a href="{{url('admin/bets-body/'.$bet_body->match_id.'/'.$bet_body->over_team_id)}}"><i class="fas fa-eye text-success"></i></a>
                        </div>
                     </td>
 
                     <td>
                         <div class="d-flex justify-content-between">
                          <span>{{$bet_body->underteam_amount}}</span>
                          <a href="{{url('admin/bets-body/'.$bet_body->match_id.'/'.$bet_body->underteam_id)}}"><i class="fas fa-eye text-success"></i></a>
                         </div>
                      </td>
 
                      <td>
                         <div class="d-flex justify-content-between">
                          <span>{{$bet_body->over_goal_amount}}</span>
                          <a href="{{url('admin/'.$bet_body->match_id.'/'.'over-goal')}}"><i class="fas fa-eye text-success"></i></a>
                         </div>
                      </td>
 
                      <td>
                         <div class="d-flex justify-content-between">
                          <span>{{$bet_body->under_goal_amount}}</span>
                          <a href="{{url('admin/'.$bet_body->match_id.'/'.'under-goal')}}"><i class="fas fa-eye text-success"></i></a>
                         </div>
                      </td>
                   </tr>
                   
                </tbody>
            </table>
        </div>
        @endforeach
   </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
         $('#match-total-bet').daterangepicker({
                    "singleDatePicker": true,
                    "locale" : {
                        format : "YYYY-MM-DD"
                    }
                });
            
                
                $('#match-total-bet').on('apply.daterangepicker', function(ev, picker) {
                   let date = picker.startDate.format('YYYY-MM-DD');
                    history.pushState(null, '' , `?date=${date}`);
                    window.location.reload();
                  });
            
        })
    </script>
@endsection