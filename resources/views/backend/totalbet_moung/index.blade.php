@extends('backend.layouts.app')
@section('totalbet-moung','active')
@section('content')
   <div class="container pt-3">
      <div class="d-flex justify-content-between">
         <div class="col-md-4 p-0">
            <a href="{{url('admin/bets-moung')}}" class="btn btn-theme font-weight-bolder">လျော်ရန်</a>
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
    @foreach ($bet_moungs as $bet_moung)
       <div class="card p-3">
          <span class="h5 font-weight-bolder">{{$bet_moung->over_team_name}} Vs {{$bet_moung->under_team_name}}</span>
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
                  {{$bet_moung->bet_total_goal}}
                  <tr>
                    <td>
                        <div class="d-flex justify-content-between">
                         <span>{{$bet_moung->overteam_amount}}</span>
                         <a href=""></a>
                        </div>
                     </td>
 
                     <td>
                         <div class="d-flex justify-content-between">
                          <span>{{$bet_moung->underteam_amount}}</span>
                          <a href=""></a>
                         </div>
                      </td>
 
                      <td>
                         <div class="d-flex justify-content-between">
                          <span>{{$bet_moung->over_goal_amount}}</span>
                          <a href=""></a>
                         </div>
                      </td>
 
                      <td>
                         <div class="d-flex justify-content-between">
                          <span>{{$bet_moung->under_goal_amount}}</span>
                          <a href=""></a>
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