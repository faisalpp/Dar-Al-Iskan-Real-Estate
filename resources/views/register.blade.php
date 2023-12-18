@extends('layout.main')
@section('main')
<!-- Account Section -->
        <section class="accounts-section">
            <div class="accounts-inner">
                <div class="accounts-inner__wrapper bg--section">
                    <div class="accounts-left">
                        <div class="accounts-left-content mw-100">
                        
                            <div class="section-header">
                                <h6 class="section-header__subtitle"></h6>
                                <h3 class="section-header__title">SignUp in to IM EasyCash</h3>
                                <p>
                                    Change your lifestyle signing up here. Invest and easily earn money for much better life</p>
                            </div>
                            <form id="registerfor" class="row gy-3" action="{{url('/register')}}" method="post"  enctype="multipart/form-data" >
                                @csrf
                                <div class="col-lg-6 col-lg-12 col-xl-6">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    @error('full_name')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                    <input type="text" name="full_name" id="fullname" class="form-control">
                                </div>
                                <div class="col-lg-6 col-lg-12 col-xl-6">
                                    <label for="username" class="form-label">User Name</label>
                                    @error('user_name')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                    <input type="text" name="user_name" id="username" class="form-control">
                                </div>

                                <div class="col-lg-6 col-lg-12 col-xl-6">
                                    <label for="email" class="form-label">Your Email</label>
                                    @error('email')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>

                                <div class="col-lg-6 col-lg-12 col-xl-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    @error('phone')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                    <div class="input-group">
                                        <input type="text" name="phone" id="phone" class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-lg-12 col-xl-6">
                                    <label for="password" class="form-label">Your Password</label>
                                    @error('password')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>

                                <div class="col-lg-6 col-lg-12 col-xl-6">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    @error('password_confirmation')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                                    <input type="password" name="password_confirmation" id="confirm-password"
                                        class="form-control">
                                </div>
                                


                                <div class="col-sm-12 d-flex justify-content-center align-items-center justify-content-evenly">
                                    <button type="submit" class="cmn--btn">Sign Up <div class="spinner-borde formSpin" role="status"></div></button>
                                    <div>
                                        Already Registered ? <a href="{{url('/login')}}" class="text--base">Sign In</a>
                                    </div>
                                </div>
                                @if(isset($refBy))
                                 <input type="hidden" name="ref_by" value="{{$refBy}}" />
                                 <span class="text--base text-center" >Upline: {{$refBy}}</span>
                                 @else
                                 <span class="text--base text-center" >Upline: N/A</span>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="accounts-right bg--blue">
                        <img src="{{url('/login-img.png')}}" alt="images">
                        <div class="section-header text-center text-white mb-0">
                            <h6 class="section-header__subtitle"></h6>
                            <h3 class="section-header__title">Turn Your ideas into Reality</h3>
                            <p>
                                Change your lifestyle signing up here. Invest and easily earn money for much better life                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</div>
       @endsection