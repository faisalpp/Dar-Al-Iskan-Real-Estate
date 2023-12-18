@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Add Client</title>
@endpush
<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">Add Client</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/user/dashboard')}}">Dashboard</a>
      </li>
      <li>Add Client</li>
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
                <label for="name" class="form-label">First Name</label>
                <input type="text" id="name" name="first_name" autocomplete="title" class="form-control" value="">
              </div>
              <div class="col-sm-6 col-xxl-4">
               <label for="email" class="form-label">last Name</label>
               <input type="text" id="email" name="last_name" autocomplete="size" class="form-control" value="" >
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">Phone</label>
                  <div class="input-group">
                      <input type="text" autocomplete="phone" name="phone" id="phone" class="form-control" value="">
                  </div>
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">Client Type</label>
                  <div class="input-group">
                  <select class="form-control">
                    <option>VIP</option>
                    <option>General</option>
                  </select>    
                  <!-- <input type="" autocomplete="phone" name="phone" id="phone" class="form-control" value=""> -->
                  </div>
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                      <button type="submit" class="cmn--btn">Add</button>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection