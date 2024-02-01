<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="image/x-icon" href="{{ url('/logo.png') }}" rel="icon">
    <meta property="og:image" content="{{ url('/logo.png') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @stack('title')
    @vite(['resources/css/bootstrap.min.css', 'resources/css/animate.css', 'resources/css/lightbox.min.css', 'resources/css/odometer.css', 'resources/css/owl.min.css', 'resources/css/main.css', 'resources/css/toastr.min.css'])
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>       
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Include toastr CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
</head>

<body>
    <!-- User Dashboard -->
    <main class="dashboard-section">
        <aside class="dashboard-sidebar">
            <div class="dashboard-sidebar-inner bg-primaryColor">
                <div class="user-sidebar-header d-flex justify-content-center align-items-center">
                 <img src="/logo.png" style="width:40%;border-radius:5px" />    
                    <div class="sidebar-close">
                        <span class="close">&nbsp;</span>
                    </div>
                </div>
                <div class="user-sidebar-body">
                    <ul class="user-sidbar-link">
                        <li>
                            <span class="subtitle" style="font-weight:bold;">@lang('General Information')</span>
                        </li>
                        <li>
                            <a class="active" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/dashboard') }}">
                                <span class="icon"><i class="fas fa-chart-line" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Dashboard')</a>
                        </li>

                        <li>
                            <span class="subtitle" style="font-weight:bold">@lang('Management')</span>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-listings') }}">
                                <span class="icon"><i class="fas fa-globe" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Land Management')</a>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-clients') }}">
                                <span class="icon"><i class="fas fa-users" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Client Management')</a>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-appointments') }}">
                                <span class="icon"><i class="fas fa-calendar" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Appointment Scheduling')</a>
                        </li>
                        <li>
                            <span class="subtitle" style="font-weight:bold">@lang('Account Information')</span>
                        </li>
                        @if(session()->get('user')['role'] === '1')
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-users') }}">
                                <span class="icon"><i class="fas fa-user-edit" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Manage Users')</a>
                        </li>
                        @endif
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/change-password') }}">
                                <span class="icon"><i class="fas fa-key" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Change Password')</a>
                        </li>

                        <li>
                            <a style="font-weight:bold;text-decoration:none" href="{{ url('/logout') }}">
                                <span class="icon"><i class="fas fa-exchange-alt" style="font-size:16px;color:#D5924D"></i></span>
                                @lang('Logout')</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <article class="main--content">
            <nav class="navbar navbar-expand-lg bg-primaryColor py-2 w-100">
                <div class="container-fluid">
                    <img src="/logo.png" class="d-lg-none" style="width:16%;border-radius:5px" />
                    <button class="navbar-toggler shadow-none" data-bs-toggle="collapse" data-bs-target="#navbarGeneral" type="button" aria-controls="navbarGeneral" aria-expanded="false" aria-label="Toggle navigation">
                        <svg class="icon icon-tabler icon-tabler-menu-2" xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l16 0" />
                        </svg>
                    </button>
                    <style>
                        .nav-link {
                            color: white;
                        }

                        .nav-link:hover {
                            color: #00A2FE;
                        }
                    </style>
                    <div class="collapse navbar-collapse" id="navbarGeneral">

                        
                        <ul class="d-flex d-lg-none nav navbar-nav my-2 mb-lg-0" style="border-top:1px solid white">
                            
                        <div class="d-flex d-lg-none justify-content-end flex-lg-row my-2 w-100" >
                      <span style="color:white;font-weight:700;background-color:#d5924d;border-radius:10%" class="px-2 py-2" >{{session()->get('user')['user_name']}}</span>
                    </div>
                            <!--Mobile Nav Links-->
                            <li>
                                <span class="subtitle" style="color:#d5924d;font-size:1.2rem">@lang('General Information')</span>
                            </li>
                            <li>
                                <a class="active px-4" href="{{ url('/admin/dashboard') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-chart-line" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Dashboard')</a>
                            </li>

                            <li>
                                <span class="subtitle" style="color:#d5924d;font-size:1.2rem">@lang('Management')</span>
                            </li>

                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-listings') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-gift" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Listing Management')</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-clients') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-coins" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Client Management')</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-appointments') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-users" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Appointment Schedular')</a>
                            </li>

                            <li>
                                <span class="subtitle" style="color:#d5924d;font-size:1.2rem">@lang('Account Information')</span>
                            </li>
                            @if(session()->get('user')['role'] === '1')
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-users') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-user-edit" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Manage Users')</a>
                            </li>
                            @endif
                            <li>
                                <a class="px-4" href="{{ url('/admin/change-password') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-question-circle" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Change Password')</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/logout') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1rem">
                                    <span class="icon"><i class="fas fa-exchange-alt" style="color:#d5924d;margin-right:5px"></i></span>
                                    @lang('Logout')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <style>
                    .nav-btn1 {
                        background-color: #00A2FE;
                        color: white;
                        width: fit-content;
                    }

                    .nav-btn1:hover {
                        background-color: transparent;
                        border: 1px solid #00A2FE;
                        color: #00A2FE;
                    }

                    .nav-btn2 {
                        border: 1px solid #00A2FE;
                        color: #00A2FE;
                    }

                    .nav-btn2:hover {
                        background-color: #00A2FE;
                        color: white;
                    }
                </style>
                <div class="d-none d-lg-flex flex-lg-row my-2" style="min-width:110px">
                  <span style="color:white;font-weight:700;background-color:#d5924d;border-radius:10%" class="px-2 py-2" >{{session()->get('user')['user_name']}}</span>
                </div>
            </nav>
            @yield('main')
        </article>
    </main>

    <!-- User Dashboard -->

    @vite(['resources/js/jquery-3.6.0.min.js', 'resources/js/bootstrap.min.js', 'resources/js/viewport.jquery.js', 'resources/js/odometer.min.js', 'resources/js/lightbox.min.js', 'resources/js/owl.min.js', 'resources/js/notify.js', 'resources/js/main.js', 'resources/js/toastr.min.js', 'resources/js/custom.js'])
</body>

</html>
