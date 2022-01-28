<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    {{-- Date range picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('extra_css')
</head>
<body>
    @include('frontend.layouts.nav')
    
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6">
                    <aside class="content-sidebar">
                        <h3>Leagues</h3>
                        <ul>
                            <li><a href="">ပရီးမီးယားလိခ်</a></li>
                            <li><a href="">လာလီဂါ</a></li>
                            <li><a href="">ချန်ပီယံလိခ်</a></li>
                            <li><a href="">ဘွန်တက်လီဂါ</a></li>
                            <li><a href="">ယူရိုပါလိခ်</a></li>
                            <li><a href="">စီးရီးအေ</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6">
                    @yield('content')
                </div>
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6">
                    <div class="web-sidebar-widget">
                        <div class="widget-head">
                            <h3>ကြော်ညာများ</h3>
                        </div>
                        <div class="widget-body p-0">
                            <a href=""><img class="w-100" src="{{ asset('image/slider.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="web-sidebar-widget">
                        <div class="widget-head">
                            <h3>Agent အချက်အလက်များ</h3>
                        </div>
                        <div class="widget-body">
                            <p><strong>ဆက်သွယ်ရန် နံပါတ်:</strong> 9776541234</p>
                            <p><strong>ဆက်သွယ်ရန် နံပါတ် ၂:</strong> 9787654123</p>
                            <p><strong>Email:</strong> youremail@gmail.com</p>
                        </div>
                    </div>             
                </div>
            </div>
        </div>
    </section>


    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    {{-- date range picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    @yield('scripts')
    <script src="{{ asset('js/custom.js') }}" defer></script>
</body>
</html>
