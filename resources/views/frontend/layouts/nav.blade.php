<div class="navigation-wrap gradient-bg bg-primary start-header start-style">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">
                
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{asset('image/football.png')}}" alt="lara Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    </a>	
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto py-4 py-md-0">
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                <a class="nav-link" href="{{ route('home') }}">ပင်မစာမျက်နာ</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="{{ route('match.moung') }}">မောင်း</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="{{ route('home') }}">ဘော်ဒီ/ဂိုးပေါင်း</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="{{ route('match.active-bet') }}">လောင်းထားသောပွဲများ</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="{{ route('match.previous-bet') }}">ပွဲစဥ်ဟောင်းများ</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i class="fas fa-user-cog p-1"></i> အကောင့်</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-dollar-sign p-1"></i>&nbsp; ငွေစာရင်း</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        <i class="fas fa-power-off"></i>&nbsp;&nbsp; ထွက်ရန်
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </nav>		
            </div>
        </div>
    </div>
</div>