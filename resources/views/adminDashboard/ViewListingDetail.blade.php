@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Listing Details</title>
@endpush
<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">Listing Details</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/user/dashboard')}}">Dashboard</a>
      </li>
      <li>Listing Details</li>
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
          <form class="row gy-4" action="{{url('/admin/update-listing')}}" method="post">
            @csrf
              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label"  >Kroki No</label>
                @error('serial_no')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="text" id="name" name="serial_no" autocomplete="title" class="form-control" value="{{$listing->serial_no}}">
              </div>
              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label"  >Listing Title</label>
                @error('title')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="hidden" id="name" name="id" autocomplete="title" class="form-control" value="{{$listing->id}}">
                <input type="text" id="name" name="title" autocomplete="title" class="form-control" value="{{$listing->title}}">
              </div>
              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">Size</label>
               @error('size')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="text" name="size" id="email" autocomplete="size" class="form-control" value="{{$listing->size}}">
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">Status</label>
                  @error('status')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select name="status" class="form-control">
                    @if($listing->status === 'On Sell')
                    <option value="On Sell" >On Sell</option>
                    <option value="Sold" >Sold</option>
                    @else
                    <option value="Sold" >Sold</option>
                    <option value="On Sell" >On Sell</option>
                    @endif
                  </select>    
                  </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">Location</label>
                  @error('location')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group d-flex align-items-center">
                      <input type="text" autocomplete="phone" name="location" id="phone" class="form-control" value="{{$listing->location}}">
                          <button type="button" style="height:50px;width:33%;font-size:12px;outline:none;border-radius:2px" data-bs-toggle="modal" data-bs-target="#invest-modal" class="btn btn-primary">Select</button>                        
                     <!-- Invest Modal -->
                     <div class="modal fade" id="invest-modal">
                      <div class="modal-dialog">
                          <div class="modal-content">
                           <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Faisalabad&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:500px;}</style></div></div>   
                          </div>
                      </div>
                     </div>

                    </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">Property Type</label>
                  @error('type')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select name="type" class="form-control">
                    @if($listing->type === 'Land')
                    <option value="Land" >Land</option>
                    <option value="Villa" >Villa</option>
                    <option value="Apartment" >Apartment</option>
                    @elseif($listing->type === 'Villa')
                    <option value="Villa" >Villa</option>
                    <option value="Land" >Land</option>
                    <option value="Apartment" >Apartment</option>
                    @else
                    <option value="Apartment" >Apartment</option>
                    <option value="Villa" >Villa</option>
                    <option value="Land" >Land</option>
                    @endif
                  </select>    
                  </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="email" class="form-label">Amount</label>
               @error('amount')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="text" name="amount" id="email" autocomplete="size" class="form-control" value="{{$listing->amount}}">
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Bedrooms</label>
               @error('no_bedrooms')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_bedrooms" id="phone" class="form-control" value="{{$listing->no_bedrooms}}">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Toilets</label>
               @error('no_toilets')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_toilets" id="phone" class="form-control" value="{{$listing->no_toilets}}">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Majlis</label>
               @error('no_majlis')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_majlis" id="phone" class="form-control" value="{{$listing->no_majlis}}">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Floors</label>
               @error('no_floors')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_floors" id="phone" class="form-control" value="{{$listing->no_floors}}">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Kitchens</label>
               @error('no_kitchens')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_kitchens" id="phone" class="form-control" value="{{$listing->no_kitchens}}">
               </div>
              </div>

              <div>
                <h4>Land Media</h4>
                @error('media')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <div style="border:1px solid #28628B;height:200px;border-radius:10px" >
                 
                 

                </div>
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                      <button type="submit" class="cmn--btn">Update</button>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection