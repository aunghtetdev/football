@extends('backend.layouts.app')
@section('wallet','active')
@section('content')
    <div class="container pt-3">
        @include('backend.layouts.flash')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Balance Substract Page
                </div>
                <form action="{{url('admin/wallets/'.$wallet->id.'/extract')}}" method="POST" id="wallet-substract">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" value="{{$wallet->user ? $wallet->user->username : '-'}}">
                            <input type="hidden" name="user_id" value="{{$wallet->user_id}}">
                        </div>
    
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" name="amount">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-theme" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\WalletSubstract', '#wallet-substract'); !!}

    
@endsection