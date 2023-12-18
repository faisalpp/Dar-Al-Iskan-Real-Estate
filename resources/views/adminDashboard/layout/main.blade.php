<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="image/x-icon" href="{{ url('/logo.png') }}" rel="icon">
    <meta property="og:image" content="{{ url('/logo.png') }}" />
    @stack('title')
    @vite(['resources/css/bootstrap.min.css', 'resources/css/animate.css', 'resources/css/lightbox.min.css', 'resources/css/odometer.css', 'resources/css/owl.min.css', 'resources/css/main.css', 'resources/css/toastr.min.css'])
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    
           <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include toastr CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Overlayer -->
    <span class="toTopBtn">
        <i class="fa fa-angle-up"></i>
    </span>
    <div class="overlayer"></div>
    <!-- <div class="loader"></div> -->
    <!-- Overlayer -->

    <!-- User Dashboard -->
    <main class="dashboard-section">
        <aside class="dashboard-sidebar">
            <!-- <div class="bg-primaryColor">&nbsp;</div> -->
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
                            <span class="subtitle" style="font-weight:bold;">General Information</span>
                        </li>
                        <li>
                            <a class="active" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/dashboard') }}">
                                <span class="icon"><i class="fas fa-chart-line" style="font-size:16px;color:#D5924D"></i></span>
                                Dashboard</a>
                        </li>

                        <li>
                            <span class="subtitle" style="font-weight:bold">Management</span>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-listings') }}">
                                <span class="icon"><i class="fas fa-globe" style="font-size:16px;color:#D5924D"></i></span>
                                Land Management</a>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-clients') }}">
                                <span class="icon"><i class="fas fa-users" style="font-size:16px;color:#D5924D"></i></span>
                                Client Management</a>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/manage-appointments') }}">
                                <span class="icon"><i class="fas fa-calendar" style="font-size:16px;color:#D5924D"></i></span>
                                Appointment Scheduling</a>
                        </li>
                        <li>
                            <span class="subtitle" style="font-weight:bold">Account Information</span>
                        </li>
                        <li>
                            <a class="" style="font-weight:bold;;text-decoration:none" href="{{ url('/admin/change-password') }}">
                                <span class="icon"><i class="fas fa-key" style="font-size:16px;color:#D5924D"></i></span>
                                Change Password</a>
                        </li>

                        <li>
                            <a style="font-weight:bold;text-decoration:none" href="{{ url('/logout') }}">
                                <span class="icon"><i class="fas fa-exchange-alt" style="font-size:16px;color:#D5924D"></i></span>
                                Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <article class="main--content">
            <nav class="navbar navbar-expand-lg py-2 bg-primaryColor">
                <div class="container-fluid">
                    <img src="/logo.png" class="d-lg-none" style="width:16%;border-radius:5px" />
                    <!-- <a class="navbar-brand" href="#"><img src="{{ url('imearn-logo.png') }}" style="width: 120px;margin-left:10px;" /></a> -->
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

                        <ul class="d-flex d-lg-none nav navbar-nav mx-auto mb-2 mb-lg-0" style="border-top:1px solid white">

                            <!--Mobile Nav Links-->
                            <li>
                                <span class="subtitle" style="color:#00A2FE;font-size:1.5rem">General Information</span>
                            </li>
                            <li>
                                <a class="active px-4" href="{{ url('/admin/dashboard') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-chart-line" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Dashboard</a>
                            </li>

                            <li>
                                <span class="subtitle" style="color:#00A2FE;font-size:1.5rem">Management</span>
                            </li>

                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-master-plan') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-gift" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Master Plan</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-plans') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-coins" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Plans Manager</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-users') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-users" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Users Manager</a>
                            </li>

                            <li>
                                <span class="subtitle" style="color:#00A2FE;font-size:1.5rem">Finance</span>
                            </li>

                            
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-gateway') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fa fa-file-invoice-dollar" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Manage Gateways</a>
                            </li>

                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-memberships/all') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fa fa-file-invoice-dollar" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Memberships Request's</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/extend-memberships/all') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fa fa-file-invoice-dollar" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Extend Membership's</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-withdraws/all') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-cash-register" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Withdraw Request's</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/manage-withdraw-gateways') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-cash-register" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Withdraw Gateway's</a>
                            </li>


                            <li>
                                <span class="subtitle" style="color:#00A2FE;font-size:1.5rem">Account Information</span>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/profile') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-user-circle" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Admin Profile</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/admin/change-password') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-question-circle" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Change Password</a>
                            </li>
                            <li>
                                <a class="px-4" href="{{ url('/logout') }}" style="text-decoration:none;color:white;margin-bottom:5px;margin-top:5px;font-size:1.2rem">
                                    <span class="icon"><i class="fas fa-exchange-alt" style="color:#00A2FE;margin-right:5px"></i></span>
                                    Logout</a>
                            </li>

                            <div class="d-flex d-lg-none justify-content-center flex-row">
                                <li class="nav-item">
                                    <a class="btn px-4 py-2 me-3 mt-2 nav-btn1" href="{{ url('/admin/dashboard') }}">Account</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn px-4 py-2 me-3 mt-2 nav-btn2" href="{{ url('/logout') }}">Logout</a>
                                </li>
                            </div>
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
                <form class="d-none d-lg-flex flex-lg-row w-25">
                    <a class="btn px-4 py-2 me-3 nav-btn1" href="{{ url('/admin/dashboard') }}">Account</a>
                    <a class="btn px-4 py-2 me-3 nav-btn2" href="{{ url('/logout') }}">Logout</a>
                </form>
            </nav>
            @yield('main')
        </article>
    </main>

    <!-- User Dashboard -->

    @vite(['resources/js/jquery-3.6.0.min.js', 'resources/js/bootstrap.min.js', 'resources/js/viewport.jquery.js', 'resources/js/odometer.min.js', 'resources/js/lightbox.min.js', 'resources/js/owl.min.js', 'resources/js/notify.js', 'resources/js/main.js', 'resources/js/toastr.min.js', 'resources/js/custom.js'])
    <script>
        'use strict';

        function myFunction() {
            var copyText = document.getElementById("cronjobURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            $.notify("Referral url copied", "info");
        }
    </script>

    <script>
        'use strict';
    </script>
</body>

</html>
