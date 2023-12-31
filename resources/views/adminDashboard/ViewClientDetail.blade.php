@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>@lang('Client Details')</title>
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
  <h3 class="title">@lang('Client Details')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/user/dashboard')}}">@lang('Dashboard')</a>
      </li>
      <li>@lang('Client Details')</li>
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
          <form id="client-form" class="row gy-4" action="{{url('/admin/update-client')}}" method="post">
            @csrf
              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label">@lang('First Name')</label>
                 @error('first_name')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="hidden" id="name" name="id" class="form-control" value="{{$client->id}}">
                <input type="text" id="name" name="first_name" class="form-control" value="{{$client->first_name}}">
              </div>
              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">@lang('Middle Name')</label>
               @error('middle_name')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="text" id="email" name="middle_name" class="form-control" value="{{$client->middle_name}}" >
              </div>
              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">@lang('last Name')</label>
               @error('last_name')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="text" id="email" name="last_name" class="form-control" value="{{$client->last_name}}" >
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Phone')</label>
                  @error('phone')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                      <input type="text" name="phone" id="phone" class="form-control" value="{{$client->phone}}">
                  </div>
              </div>
              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Email')</label>
                  @error('email')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                      <input type="text" name="email" id="phone" class="form-control" value="{{$client->email}}">
                  </div>
              </div>
              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Address')</label>
                  @error('address')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                      <input type="text" name="address" id="phone" class="form-control" value="{{$client->address}}">
                  </div>
              </div>

              <div class="col-sm-6 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Is Client VIP')?</label>
                  @error('is_vip')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select name="is_vip" class="form-control">
                    @if($client->is_vip === 'yes')
                    <option value="yes" >@lang('Yes')</option>
                    <option value="no">@lang('No')</option>
                    @else
                    <option value="no">@lang('No')</option>
                    <option value="yes" >@lang('Yes')</option>
                    @endif  
                </select>    
                  </div>
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                    <button type="submit" class="cmn--btn"><span id="form-btn-text" class="" >@lang('Update')</span> <div id="loader" class="d-none">
                     <div class="spinner-border" role="status">
                             <span class="sr-only">Loading...</span>
                         </div>
                     </div>
                    </button>
                  </div>
              </div>
            </form>

           <div>
           <h4>@lang('Client Listings')</h4>

           @if(count($listings) > 0)
<table class="table bg--body">
			  <thead>
				  <tr>
					<th>@lang('Kroki No')</th>
					<th>@lang('Title')</th>
					<th>@lang('Land Type')</th>
					<th>@lang('Land Size')</th>
					<th>@lang('Date')</th>
					<th>@lang('Actions')</th>
				  </tr>
			  </thead>
			  <tbody>
        @foreach($listings as $listing)
			  <tr>
				 <td data-label="No"><div><span >{{$listing->serial_no}}</span></div></td>
				 <td data-label="No"><div><span >{{$listing->title}}</span></div></td>
				 <td data-label="No"><div><span >{{$listing->type}}</span></div></td>
				 <td data-label="No"><div><span >{{$listing->size}}</span></div></td>
				 <td data-label="No"><div><span >{{date_format($listing->created_at,'d M Y')}}</span></div></td>
				 <td data-label="No">
         <a title="View Listing" href="{{url('/admin/view-listing')}}/{{$listing->id}}" style="border:none;font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-eye" style="font-size:14px" ></i></a>	
         <button title="Delete Listing" style="border:none;font-weight:bold;background-color:red;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-trash" style="font-size:14px" ></i></button>	
         </td>
        </tr>
        @endforeach
</table>
@else
 <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 400px)" >
   <h4>@lang('Client Has No Listings')!</h4>
 </div>
@endif

           </div>


        </div>
    </div>
</div>
@endsection