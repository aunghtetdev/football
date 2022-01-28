<div class="navigation-wrap gradient-bg bg-primary start-header start-style">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">
                
                    <a class="navbar-brand" href="https://front.codes/" target="_blank">
                        <img src="{{asset('image/football.png')}}" alt="lara Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    </a>	
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto py-4 py-md-0">
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                                <a class="nav-link" href="#">ပင်မစာမျက်နာ</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Leagues</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="#">မောင်း</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="#">ဘော်ဒီ/ဂိုးပေါင်း</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link" href="#">ပွဲစဥ်ဟောင်းများ</a>
                            </li>
                            <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i class="fas fa-user-cog p-1"></i> အကောင့်</a>
                                    <a class="dropdown-item" href="{{url('history')}}"><i class="fas fa-dollar-sign p-1"></i>&nbsp; ငွေစာရင်း</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-money-bill-wave p-1"></i> ငွေသွင်း/ငွေထုတ်</a>
                                    <a class="dropdown-item text-light" onclick="
                                    event.preventDefault();
                                    if(confirm('Are you sure you want to logout?'))
                                    document.getElementById('logout-form').submit();
                                    "> <i class="fas fa-power-off text-light">
                                        
                                    </i>&nbsp;&nbsp; ထွက်ရန်</a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
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