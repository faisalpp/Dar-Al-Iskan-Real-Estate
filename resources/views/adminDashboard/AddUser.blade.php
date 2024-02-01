@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>@lang('Add User')</title>
@endpush

<script>
 $(document).ready(function () {
  // Intercept the form submission
  $('#client-form').submit(function () {
   // Show the loader
   $('#loader').removeClass('d-none');
   $('#form-btn-text').addClass('d-none');
  });
 });
</script>


<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">@lang('Add User')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/user/dashboard')}}">@lang('Dashboard')</a>
      </li>
      <li>@lang('Add User')</li>
  </ul>
</div>
@if(session()->has('success'))
<div>
 <h5 class="text-success text-center mb-2" >{{session()->get('success')}}</h5>
</div>
@endif

<div class="dashboard--content-item">
    <div id="request-form">
    @csrf
    <div class="profile--card">
          <form id="client-form" class="row gy-4" action="{{url('/admin/create-user')}}" method="post">
            @csrf
              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label">@lang('User Name')</label>
                 @error('user_name')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="text" id="user_name" name="user_name" class="form-control" value="">
              </div>
              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">@lang('Password')</label>
               @error('password')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="password" id="password" name="password" class="form-control" value="" >
              </div>
              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">@lang('Re-Type Password')</label>
               @error('password_confirmation')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" value="" >
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Phone')</label>
                  @error('phone')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                      <input type="text" name="phone" id="phone" class="form-control" value="">
                  </div>
              </div>
              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Email')</label>
                  @error('email')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                      <input type="text" name="email" id="phone" class="form-control" value="">
                  </div>
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                    <button type="submit" class="cmn--btn"><span id="form-btn-text" class="" >@lang('Add')</span> <div id="loader" class="d-none">
                     <div class="spinner-border" role="status">
                             <span class="sr-only">Loading...</span>
                         </div>
                     </div>
                    </button>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection