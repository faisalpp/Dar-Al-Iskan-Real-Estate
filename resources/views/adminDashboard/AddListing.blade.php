@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Add Listing</title>
@endpush
<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">Add Listing</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/user/dashboard')}}">Dashboard</a>
      </li>
      <li>Add Listing</li>
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
          <form class="row gy-4" action="{{url('/admin/profile-update')}}" method="post">
            @csrf
              <div class="col-sm-6 col-xxl-4">
                <label for="name" class="form-label">Listing Title</label>
                <input type="text" id="name" name="title" autocomplete="title" class="form-control" value="">
              </div>
              <div class="col-sm-6 col-xxl-4">
               <label for="email" class="form-label">Size</label>
               <input type="text" id="email" autocomplete="size" class="form-control" value="" readonly>
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">Location</label>
                  <div class="input-group">
                      <input type="text" autocomplete="phone" name="phone" id="phone" class="form-control" value="">
                  </div>
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                      <button type="submit" class="cmn--btn">Create</button>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection