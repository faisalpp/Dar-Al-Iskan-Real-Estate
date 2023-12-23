@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Add Listing</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<script>
 $(document).ready(function () {
  // Intercept the form submission
  $('#listing-create-form').submit(function () {
   // Show the loader
   $('#loader').removeClass('d-none');
   $('#form-btn-text').addClass('d-none');
  });
 });
</script>
<script>
 function addOptionToSelect(id, name) {
  // Close Bootstrap modal
  $('#searched-client').empty();
  
  // Add option to select
  let newOption = $('<option>', {
    value: id,
    text: name
  });
  let guestOption = $('<option>', {
    value: 'guest',
    text: 'Guest'
  });
  $('#searched-client').append(newOption);
  $('#searched-client').append(guestOption);
  // $('#client-modal').removeClass('show');
  $('#client-modal').removeClass('show').css('display', 'none');
  $('.modal-backdrop').modal('hide').remove();
 }
</script>
<script>
    $(document).ready(function () {
        // Event handler for form submission
        $('#get-clients-form').submit(function (e) {
            e.preventDefault(); // Prevent the form from submitting in the traditional way
         const formData = $('#get-clients-form').serialize()
            // Make AJAX request when the form is submitted
            $.ajax({
                url: '{{url("/admin/get-clients")}}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function (response) {
                  // console.log(response)
                    // Clear previous user names
                   $('#user-list').html()

                    // Iterate through users and append names to the #userList div
                    response.users.forEach(function (user) {
                      console.log(user)
                     let newUserElement = $(
                      '<div style="background-color:#6890AA;border-radius:5px" class="d-flex align-items-center px-2 my-2">'
                      + '<div class="w-100">'
                      + '<h4 style="font-size:15px;width:fit-content;color:white;margin-top:7px;margin-right:5px">'
                      + user.first_name + ' ' + user.phone
                      + '</h4>'
                      + '</div>'
                      + '<button type="button" onclick="addOptionToSelect(\'' + user.id + '\', \'' + user.first_name + '\')" class="d-flex align-items-center btn px-2" style="font-size:12px;background-color:#D5924D;margin-left:10px;border-radius:5px;height:20px;color:white" href="{{ url("/admin/dashboard") }}">Select</button>'
                      + '</div>'
                     );
                     $('#client-list').append(newUserElement);
                    //  $('#user-list').append('<h4></h4>');
                    });
                },
                error: function (error) {
                    console.log('Error fetching users:', error);
                }
            });
        });
    });
</script>

<script>
 $(document).ready(function () {
   $('#file-picker-select').on('change',function () {
   
    const file = $('#file-picker-select')[0]
     if(file){
       const data = new FormData()
       data.append('file',file);
      //  data.append('_csrf',file);
       data.append('csrf_token', $('input[name=_token]').val());
            
       $.ajax({
          url: "{{url('/admin/upload-media')}}", // Replace with your server-side endpoint
          type: 'POST',
          data: data,
          contentType: false,
          processData: false,
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
              // Handle the success response
              console.log(response);
          },
          error: function (error) {
              // Handle the error response
              console.error(error);
          }
         })
    
    
      }
    })
 })
function selectMedia(){
  $('#file-picker-select').click()
}
</script> 

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
    <div>
    <div class="profile--card">
          <form id="listing-create-form" class="row gy-4" action="{{url('/admin/create-listing')}}" method="post">
            @csrf
              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label"  >Kroki No</label>
                @error('title')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="text" id="name" name="serial_no" autocomplete="title" class="form-control" value="">
              </div>

              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label"  >Listing Title</label>
                @error('title')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="text" id="name" name="title" autocomplete="title" class="form-control" value="">
              </div>

              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">Size</label>
               @error('size')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="text" name="size" id="email" autocomplete="size" class="form-control" value="">
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">Seller Client</label>
                  @error('seller')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select id="searched-client" name="user" class="form-control">
                    <option value="guest" >Guest</option>
                  </select>
                  <button type="button" style="height:40px;width:33%;font-size:12px;outline:none;border-radius:2px" data-bs-toggle="modal" data-bs-target="#client-modal" class="btn btn-primary">Find</button>                            
                 </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">Status</label>
                  @error('status')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select name="status" class="form-control">
                    <option value="On Sell" >On Sell</option>
                    <option value="Sold" >Sold</option>
                  </select>    
                  </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">Location</label>
                  @error('location')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group d-flex align-items-center">
                      <input type="text" autocomplete="phone" name="location" id="phone" class="form-control" value="">
                          <button type="button" style="height:40px;width:33%;font-size:12px;outline:none;border-radius:2px" data-bs-toggle="modal" data-bs-target="#invest-modal" class="btn btn-primary">Select</button>                        
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
                    <option value="Land" >Land</option>
                    <option value="Villa" >Villa</option>
                    <option value="Appartment" >Apartment</option>
                  </select>    
                  </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">Amount</label>
               @error('amount')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="amount" id="phone" class="form-control" value="">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Bedrooms</label>
               @error('no_bedrooms')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_bedrooms" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Toilets</label>
               @error('no_toilets')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_toilets" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Majlis</label>
               @error('no_majlis')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_majlis" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Floors</label>
               @error('no_floors')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_floors" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">No of Kitchens</label>
               @error('no_kitchens')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input type="text" autocomplete="phone" name="no_kitchens" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div>
                <h4>Land Media</h4>
                @error('media')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <div style="display:relative;border:1px solid #28628B;height:200px;border-radius:10px" >
                 <div onclick="selectMedia()" style="display:absolute;float:right; width:fit-content;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;border-radius:5px;cursor:pointer" class="mx-4 my-2 px-2 py-2" ><i class="fas fa-plus-square" style="font-size:50px;color:#d5924d;" ></i></div>
                 <form id="file-picker" enctype='multipart/form-data' style="display:none" > 
                  @csrf
                  <input id="file-picker-select" name="file" type="file" style="display:none"  accept="video/*,image/*" />
                 </form> 
                 <div id="media-placeholder" >
                    <!-- File Loader -->
                    <div id="file-loader" style="display:none;border:1px solid #28628B;width:fit-content;border-radius:5px" class="mx-2 my-2 px-2 py-2" >
                     <img src="/file-loader.gif" style="width:70px" />
                      </div>
                      <!-- File Loader -->
                  
                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                  <div class="text-end">
                    <button type="submit" class="cmn--btn"><span id="form-btn-text" class="" >Create</span> <div id="loader" class="d-none">
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

 <!-- Invest Modal -->
 <div class="modal fade" id="client-modal">
 <div class="modal-dialog">
     <div class="modal-content">
       <form  id="get-clients-form" class="d-flex align-items-center justify-content-center my-2 mx-4" >
       @csrf
       <h5 style="font-size:18px" >Filters:</h5> 
       <select class="form-control" name="filter" type="text" style="height:35px;width:30%;outline:none;margin-left:5px;margin-right:5px">
         <option value="first_name" >First Name</option>
         <option value="last_name" >Last Name</option>
         <option value="middle_name" >Middle Name</option>
         <option value="email" >Email</option>
         <option value="phone" >Phone No</option>
        </select>
        <input type="text" name="search" style="height:35px;width:35%;outline:none" value="" />
        <button class="btn px-3 py-2" style="background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></button>
       </form>
       <div id="client-list" style="border:1px solid #26826B;max-height:200px;border-radius:5px;overflow-y:scroll;overflow-x:hidden;scrollbar-color:yellow" class="px-2 py-2 mx-2 my-2" >
      
       </div>
      
     </div>
 </div>
</div>

@endsection