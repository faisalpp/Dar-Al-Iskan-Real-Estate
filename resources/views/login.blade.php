    @extends('layout.main')
    @section('main')
    <!-- Account Section -->
    <section class="accounts-section">
        <div class="accounts-inner">
            <div class="accounts-inner__wrapper bg--section">
                <div class="d-flex d-lg-none my-3 justify-content-center align-items-center w-100" > <img src="/logo.png" style="width:40%;border-radius:10px;border:1px solid orange" /></div>
                <div class="accounts-left">
                    <div class="accounts-left-content">
                        
                        <div class="section-header">
                            <h6 class="section-header__subtitle"></h6>
                            <h3 class="section-header__title">@lang('Sign in to Dar Al-Iskan Real Estate')</h3>
                            <p>
                            @lang('Turn Your ideas into Reality')
                            </p>
                        </div>
                        <form class="row gy-4" id="loginfor" action="{{url('/login')}}" method="post">
                            <div class="alert alert-success alert-dismissible fade show" style="display: none;">
                             <p class="m-0 text-success"></p>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                             <p class="m-0 text-danger"></p>
                            </div>
                            @if(session()->has('success'))
                            <span class="text--base text-center" >
                                 {{session()->get('success')}}
                             </span>
                            @endif
                            @if(session()->has('error'))
                            <span class="text--base text-center" >
                                 {{session()->get('error')}}
                             </span>
                            @endif
                            @csrf
                            <div class="col-sm-12">
                                <label for="email" class="form-label">@lang('UserName Or Email')</label>
                                @error('email')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <label for="password" class="form-label">@lang('Your Password')</label>
                                @error('password')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="cmn--btn">@lang('Sign In') <div class="spinner-borde"></div></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="accounts-right bg-dark" style="border: 2px solid #f3f9ff;;border-left:none">
                    <img src="{{url('/side.png')}}" alt="images" style="border-radius:10px">
                    <div class="section-header text-center text-white mb-0">
                        <h6 class="section-header__subtitle"></h6>
                        <h3 class="section-header__title" style="font-size:25px">@lang('Transform Your Real Estate Vision into Seamless Reality')</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection