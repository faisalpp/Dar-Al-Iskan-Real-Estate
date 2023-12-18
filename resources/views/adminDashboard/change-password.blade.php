
@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Change Password</title>
@endpush
<div class="dashborad--content">
				<div class="breadcrumb-area">
    <h3 class="title">Change Password</h3>
    <ul class="breadcrumb">
        <li>
            <a href="{{url('/user/dashboard')}}">Dashboard</a>
        </li>
        <li>Change Password</li>
    </ul>
</div>
@if(session()->has('success'))
<div>
 <h5 class="text-success text-center mb-2" >{{session()->get('success')}}</h5>
</div>
@endif
<div class="dashboard--content-item">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6">
            <div class="profile--card">
                <form id="request-form" action="{{url('/admin/change-password')}}" method="post">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-sm-12">
                            <label for="new-password" class="form-label">New Password</label>
                            @error('password')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                            <input type="password" name="password" id="new-password" class="form-control"
                                placeholder="New Password" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            @error('password_confirmation')
                                     <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                                    @enderror
                            <input type="password" name="password_confirmation" id="confirm-password" class="form-control"
                                placeholder="Confirm Password" required>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-end">
                                <button type="submit" class="cmn--btn">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection