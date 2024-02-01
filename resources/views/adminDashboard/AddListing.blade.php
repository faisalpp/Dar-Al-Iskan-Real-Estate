@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>@lang('Add Listing')</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<script>
  let globalImagePaths = [];
</script>
<script>
 function addOptionToSelect(id, name) {
  // Close Bootstrap modal
  $('#searched-client').html('');
  
  // Add option to select
  let newOption = $('<option>', {
    value: id,
    text: name
  });
  let guestOption = $('<option>', {
    value: 'Guest',
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
            $('#no_client').css('display','none')
            $('#client-loader').css('display','flex')
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
                   $('#client-list .searched-item').remove()
                   
                   if(response.users.length > 0){
                    // Iterate through users and append names to the #userList div
                    response.users.forEach(function (user) {
                     const full_name = user.first_name + ' ' + user.middle_name + ' ' + user.last_name;
                      let newUserElement = $(
                      '<div class="searched-item d-flex align-items-center px-2 my-2" style="background-color:#6890AA;border-radius:5px">'
                      + '<div class="w-100">'
                      + '<h4 style="font-size:15px;width:fit-content;color:white;margin-top:7px;margin-right:5px">'
                      + 'Full Name: ' + user.first_name + ' ' + user.middle_name + ' ' + user.last_name + '<br>' + 'Phone: ' + user.phone + '<br>' + 'Email: ' + user.email
                      + '</h4>'
                      + '</div>'
                      + '<button type="button" onclick="addOptionToSelect(\'' + user.id + '\', \'' + full_name + '\')" class="d-flex align-items-center btn px-2" style="font-size:12px;background-color:#D5924D;margin-left:10px;border-radius:5px;height:20px;color:white" href="{{ url("/admin/dashboard") }}">Select</button>'
                      + '</div>'
                     );
                     $('#client-list').append(newUserElement);
                    });
                   }else{
                     $('#no_client').css('display','flex')
                   }
                    $('#client-loader').css('display','none')
                  },
                 error: function (error) {
                  $('#client-loader').css('display','none')
                }
            });
        });
    });
</script>



<script>
 $(document).ready(function () {
   $('#file-picker-select').on('change',function () {
    const fileInput = document.getElementById('file-picker-select');
    const file = fileInput.files[0];
    if(file){
      if(file.type.startsWith('image') || file.type.startsWith('video')){
      $('#file-loader').css('display','flex');
       const data = new FormData()
       data.append('file',file);
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
          success: function (res) {
            const path = {'type':file.type,path:res.path}
            globalImagePaths.push(path)
            const domain = "{{url('/')}}"

            $('#media-placeholder .item').remove();
            globalImagePaths.forEach(function (media) {
              if(media.type.startsWith('video')){
                const newUserElement = $(
               `<div class="item col-2" style="position:relative;width:fit-content" >`
                +`<p onclick="DeleteMedia('${media.path}');" style="z-index:999;top:8px;right:5px;position:absolute;display:flex;justifty-content:center;align-items:center;" ><i class="fas fa-window-close" style="cursor:pointer;background-color:white;color:red" ></i></p>`
                +`<image style="width:100px;height:100px;border:1px solid gray;border-radius:5px" src="${domain}/uploads/${media.path}" class="mx-2 my-2 px-2 py-2" />`
                +`</div>`
                  );
                  $('#media-placeholder').append(newUserElement);
                }else{
               const newUserElement = $(
                `<div class="item col-2" style="position:relative;width:fit-content" >`
       +`<p onclick="DeleteMedia('${media.path}');" style="z-index:999;top:8px;right:5px;position:absolute;display:flex;justifty-content:center;align-items:center;" ><i class="fas fa-window-close" style="cursor:pointer;background-color:white;color:red" ></i></p>`
       + `<image style="width:100px;height:100px;border:1px solid gray;border-radius:5px" src="${domain}/uploads/${media.path}" class="mx-2 my-2 px-2 py-2" />`
       +`</div>`
              );
              $('#media-placeholder').append(newUserElement);
             }
            });
            $('#file-loader').css('display','none');
            toastr.success('File Uploaded Successfully!');
          },
          error: function (error) {
           // Handle the error response
           $('#file-loader').css('display','none');
           toastr.error('File Upload Failed!');
          }
         })
       }else{
        toastr.error('Invalid File Type!');
       }
      }
    })
 });
</script> 
<script>
  function selectMedia(){
  $('#file-picker-select').click()
}
</script>

<script>
  function DeleteMedia(fileName){
  //  console.log(fileName)
    const data = new FormData()
       data.append('name',fileName);
      //  data.append('_csrf',file);
       data.append('csrf_token', $('input[name=_token]').val());
       $.ajax({
          url: "{{url('/admin/delete-media')}}", // Replace with your server-side endpoint
          type: 'POST',
          data: data,
          contentType: false,
          processData: false,
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (res) {

           const copy = globalImagePaths.filter(item => item.path !== fileName)
           globalImagePaths = copy;
          //  console.log(copy)
           const domain = "{{url('/')}}"

           $('#media-placeholder .item').remove();
            copy.forEach(function (media) {
              if(media.type.startsWith('video')){
                const newUserElement = $(
                  `<div class="item col-2" style="position:relative;width:fit-content" >`
                +`<p onclick="DeleteMedia('${media.path}');" style="z-index:999;top:8px;right:5px;position:absolute;display:flex;justifty-content:center;align-items:center;" ><i class="fas fa-window-close" style="cursor:pointer;background-color:white;color:red" ></i></p>`
                +`<image style="width:100px;height:100px;border:1px solid gray;border-radius:5px" src="${domain}/uploads/${media.path}" class="mx-2 my-2 px-2 py-2" />`
                +`</div>`
                  );
                  $('#media-placeholder').append(newUserElement);
                }
                if(media.type.startsWith('image')){
               const newUserElement = $(
                `<div class="item col-2" style="position:relative;width:fit-content" >`
       +`<p onclick="DeleteMedia('${media.path}');" style="z-index:999;top:8px;right:5px;position:absolute;display:flex;justifty-content:center;align-items:center;" ><i class="fas fa-window-close" style="cursor:pointer;background-color:white;color:red" ></i></p>`
       + `<image style="width:100px;height:100px;border:1px solid gray;border-radius:5px" src="${domain}/uploads/${media.path}" class="mx-2 my-2 px-2 py-2" />`
       +`</div>`
              );
              $('#media-placeholder').append(newUserElement);
             }
            });
            toastr.success('File Deleted Successfully!');
          },
          error: function (error) {
           toastr.error('File Deleted Failed!');
          }
         })
}
</script>

<script>
  function CreateListing() {
   const form = new FormData()
   form.append('serial_no',$('#serial_no').val())
   form.append('title',$('#title').val())
   form.append('size',$('#size').val())
   form.append('client',$('#searched-client').val())
   form.append('status',$('#status').val())
   form.append('location',$('#location').val())
   form.append('lat_lng',$('#lat_lng').val())
   form.append('type',$('#type').val())
   form.append('amount',$('#amount').val())
   form.append('no_bedrooms',$('#no_bedrooms').val())
   form.append('no_floors',$('#no_floors').val())
   form.append('no_kitchens',$('#no_kitchens').val())
   form.append('no_toilets',$('#no_toilets').val())
   form.append('no_majlis',$('#no_majlis').val())
   form.append('media',JSON.stringify(globalImagePaths))
      $('#loader').removeClass('d-none');
  $('#form-btn-text').addClass('d-none');
   $.ajax({
    url: "{{url('/admin/create-listing')}}", // Replace with your server-side endpoint
    type: 'POST',
    data: form,
    contentType: false,
    processData: false,
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (res) {
     toastr.success('Listing Creating Successfully!')
     $('#loader').addClass('d-none');
     $('#form-btn-text').removeClass('d-none');
     window.location.href = "{{url('/')}}/admin/manage-listings"
    },
    error: function (error) {
      // console.log(error) 
    $('#loader').addClass('d-none');
    $('#form-btn-text').removeClass('d-none');
    toastr.error('Internal Server Error!')
    }
  })

  }

</script>


<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbPIrXFERaxgSurR_7wxbI-UdLRLTc94w&libraries=places&callback=initMap"></script>
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 19.9625593, lng: 56.2313026},
            zoom: 10
        });

        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: 19.9625593, lng: 56.2313026 }
        });

        // Add event listener to the marker to get the address when it is dropped
        marker.addListener('dragend', function() {
            getMarkerAddress(marker.getPosition());
        });
    }

    function getMarkerAddress(latLng) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'location': latLng}, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    var address = results[0].formatted_address;
                    // Handle the address as needed (e.g., display in a form field)
                    const location = {lat:results[0].geometry.location.lat(),lng:results[0].geometry.location.lng()}
                    $('#location').val(address)
                    $('#lat_lng').val(JSON.stringify(location))
                }
            } else {
                console.error('Geocoder failed due to: ' + status);
            }
        });
    }

    // Initialize the map directly as the callback
    // initMap();
    window.addEventListener('load', initMap);
</script>


<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">@lang('Add Listing')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/user/dashboard')}}">@lang('Dashboard')</a>
      </li>
      <li>@lang('Add Listing')</li>
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
          <form id="listing-create-form" class="row gy-4">
            @csrf
              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label"  >@lang('Kroki No')</label>
                @error('serial_no')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="text" id="serial_no" name="serial_no" autocomplete="title" class="form-control" value="">
              </div>

              <div class="col-sm-6 col-lg-4 col-xxl-4">
                <label for="name" class="form-label"  >@lang('Listing Title')</label>
                @error('title')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <input type="text" id="title" name="title" autocomplete="title" class="form-control" value="">
              </div>

              <div class="col-sm-6 col-lg-4 col-xxl-4">
               <label for="email" class="form-label">@lang('Size')</label>
               @error('size')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <input type="text" name="size" id="size" autocomplete="size" class="form-control" value="">
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Seller Client')</label>
                  @error('client')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select id="searched-client" name="client" class="form-control">
                    <option value="guest" >@lang('Guest')</option>
                  </select>
                  <button type="button" style="height:40px;width:33%;font-size:12px;outline:none;border-radius:2px" data-bs-toggle="modal" data-bs-target="#client-modal" class="btn btn-primary">Find</button>                            
                 </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Status')</label>
                  @error('status')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group">
                  <select id="status" name="status" class="form-control">
                    <option value="On Sell" >@lang('On Sell')</option>
                    <option value="Sold" >@lang('Sold')</option>
                  </select>    
                  </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
                  <label for="phone" class="form-label">@lang('Location')</label>
                  @error('location')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                  <div class="input-group d-flex align-items-center">
                      <input id="location" type="text" autocomplete="phone" name="location" id="phone" class="form-control" value="">
                      <input id="lat_lng" type="hidden" autocomplete="phone" name="lat_lng" id="phone" class="form-control" value="">
                      <!-- <button type="button" style="height:50px;width:33%;font-size:12px;outline:none;border-radius:2px" data-bs-toggle="modal" data-bs-target="#invest-modal" class="btn btn-primary">Select</button>                         -->
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3 col-xxl-4">
                      <label for="phone" class="form-label">@lang('Property Type')</label>
                      @error('type')
                      <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                     @enderror
                      <div class="input-group">
                      <select id="type" name="type" class="form-control">
                        <option value="Land" >@lang('Land')</option>
                        <option value="Villa" >@lang('Villa')</option>
                        <option value="Appartment" >@lang('Apartment')</option>
                      </select>    
                      </div>
                  </div>
                  <!-- <div class="d-flex align-items-center justify-content-center" style="width:100%;height:400px;border:1px solid blue;" class="my-5" ><h4>Map Will Show Here..</h4></div>    -->
                  <div id="map" style="width:100%;height:400px" class="my-5" ></div>   
                  

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">@lang('Amount')</label>
               @error('amount')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input id="amount" type="text" autocomplete="phone" name="amount" id="phone" class="form-control" value="">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">@lang('No of Bedrooms')</label>
               @error('no_bedrooms')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input id="no_bedrooms" type="text" autocomplete="phone" name="no_bedrooms" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">@lang('No of Toilets')</label>
               @error('no_toilets')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input id="no_toilets" type="text" autocomplete="phone" name="no_toilets" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">@lang('No of Majlis')</label>
               @error('no_majlis')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input id="no_majlis" type="text" autocomplete="phone" name="no_majlis" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">@lang('No of Floors')</label>
               @error('no_floors')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input id="no_floors" type="text" autocomplete="phone" name="no_floors" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-6 col-lg-3 col-xxl-4">
               <label for="phone" class="form-label">@lang('No of Kitchens')</label>
               @error('no_kitchens')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
               <div class="input-group">
                <input id="no_kitchens" type="text" autocomplete="phone" name="no_kitchens" id="phone" class="form-control" value="0">
               </div>
              </div>

              <div class="col-sm-12 my-4">
                  <div class="text-end">
                    <button onclick="CreateListing()" type="button" class="cmn--btn"><span id="form-btn-text" class="" >Create</span> <div id="loader" class="d-none">
                     <div class="spinner-border" role="status">
                             <span class="sr-only">Loading...</span>
                         </div>
                     </div>
                    </button>
                  </div>
              </div>

            </form>

            <form id="file-picker" enctype='multipart/form-data' >
                <h4>@lang('Land Media')</h4>
                @error('media')
                  <label style="color:red;font-size:0.7rem" for="fullname-error" class="form-label text-sm ">{{$message}}</label>    
                 @enderror
                <div style="display:relative;border:1px solid #28628B;height:200px;border-radius:10px" >
                 <div onclick="selectMedia()" style="display:absolute;float:right; width:fit-content;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;border-radius:5px;cursor:pointer" class="mx-4 my-2 px-2 py-2" ><i class="fas fa-plus-square" style="font-size:50px;color:#d5924d;" ></i></div> 
                  @csrf
                  <input id="file-picker-select" name="file" type="file" style="display:none"  accept="video/*,image/*" />
                  <!-- <i class="fas fa-window-close" ><i/>  -->
                 <div id="media-placeholder" class="d-flex align-items-center mx-2 my-2" >
                    <!-- File Loader -->
                    <div id="file-loader" style="display:none;width:100px;height:100px;border:1px solid gray;border-radius:5px" class="align-items-center justify-content-center col-2 mx-2 my-2 px-2 py-2" >
                     <img src="/file-loader.gif" style="width:70px" />
                      </div>
                      <!-- File Loader -->
                  </div>
                </div></div>
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
       <h5 style="font-size:18px" >@lang('Filters'):</h5> 
       <select class="form-control" name="filter" type="text" style="height:35px;width:30%;outline:none;margin-left:5px;margin-right:5px">
         <option value="first_name" >@lang('First Name')</option>
         <option value="last_name" >@lang('Last Name')</option>
         <option value="middle_name" >@lang('Middle Name')</option>
         <option value="email" >@lang('Email')</option>
         <option value="phone" >@lang('Phone No')</option>
        </select>
        <input type="text" name="search" style="height:35px;width:35%;outline:none" value="" />
        <button class="btn px-3 py-2" style="background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></button>
       </form>
       <div id="client-list" style="border:1px solid #26826B;height:200px;border-radius:5px;overflow-y:scroll;overflow-x:hidden;scrollbar-color:yellow" class="px-2 py-2 mx-2 my-2" >
         <div id="client-loader" style="display:none;justify-content:center;align-items:center;height:100%" >
          <div class="spinner-border bg-dark" role="status"><span class="sr-only">Loading...</span></div>
         </div>
         <div id="no_client" style="display:flex;justify-content:center;align-items:center;height:100%" >
          <p>@lang('No Client Found')!</p>
         </div>
       
      </div>
      
     </div>
 </div>
</div>

@endsection