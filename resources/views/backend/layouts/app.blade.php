<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    {{-- switch bootstrap --}}
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Datetime Picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="/path/to/select2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('extra_css')

    <style>
        .select2-container .select2-selection--single{
            height : 44px;
        }
    </style>
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin/login') }}">{{ __('Admin Login') }}</a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-0">
            <!-- Navbar -->
                <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button" id="show-sidebar"><i class="fas fa-bars"></i></a>
                    </li>
                    </ul>
                </nav>
            <!-- /.navbar -->

               @include('backend.layouts.side')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <div class="content">
                    @yield('content')
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->
        </main>
    </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <!-- AdminLTE App -->
         <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
         
        <!-- Bootstrap 4 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
        {{-- Datatables --}}
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        {{-- Switch bootstrap --}}
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
        
        {{-- Sweet alert --}}
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        {{-- Datetime Picker --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        {{-- Select 2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        {{-- js validation --}}
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        <!-- ChartJS -->
        <script src="{{ asset('js/chart.min.js') }}"></script>

        @yield('scripts')
        
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
            //date picker
            $('#single-datepicker').daterangepicker({
                "singleDatePicker": true,
                "timePicker": true,
                "timePickerIncrement": 5,
                locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
                    }
            }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD H:i:s') + ' to ' + end.format('YYYY-MM-DD H:i:s') + ' (predefined range: ' + label + ')');
            });
            
            let token = document.head.querySelector('meta[name="csrf-token"]');

            if(token){
                $.ajaxSetup({
                    headers : {
                        'X-CSRF_TOKEN' : token.content
                    }
                })
            }

            
            // document.addEventListener('click',function(event){
            //     if(document.getElementById('show-sidebar').contains(event.target)){
            //         $("#show-sidebar").addClass("sidebar-closed");
            //         $("#show-sidebar").addClass("sidebar-collapse");
            //     }
            // })

            //select 2
            // $('.select-role').select2({
            //     theme: 'bootstrap4',
            // });

            //Datatables
            $.extend(true, $.fn.dataTable.defaults, {
                                        processing: true,
                                        serverSide: true,
                                        responsive: true,
                                        mark: true,
                                        "columnDefs": [
                                    {
                                        "targets": "hidden",
                                        "visible": false,
                                    },
                                    {
                                        "targets": 'no-sort',
                                        "orderable": false,
                                    },
                                    {
                                        "targets": 'no-search',
                                        "searchable": false,
                                    }
                                ],
                            "language": {
                                "paginate" :{
                                    "next": "<i class='fas fa-arrow-alt-circle-right'></i>",
                                    "previous": "<i class='fas fa-arrow-alt-circle-left'></i>",
                                },
                                "processing":     "<img src='/image/giphy.gif' width='90px' /><p class='my-2'>Loading ...</p> "
                            }
                        });     

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })
                
                @if(session('create'))
                    Toast.fire({
                    icon: 'success',
                    title: '{{session('create')}}'
                    })
                @endif

                @if(session('update'))
                    Toast.fire({
                    icon: 'success',
                    title: '{{session('update')}}'
                    })
                @endif
                

        </script>
    </body>
</html>
