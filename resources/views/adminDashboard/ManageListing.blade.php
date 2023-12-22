@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Land Management</title>
@endpush
<div class="dashborad--content">
				<div class="breadcrumb-area">
  <h3 class="title">Land Management</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/admin/dashboard')}}">Dashboard</a>
      </li>
      <li>Land Management</li>
  </ul>
</div>

<script>
  function DeleteListing(id){
      // Show the loader
   $(`#loader-${id}`).removeClass('d-none');
   $(`#form-btn-text-${id}`).addClass('d-none');

   const formData = $(`#listing-form-${id}`).serialize();
  //  $(`#listing-form-${id}`).e.preventDefault()
// Make an Ajax POST request
$.ajax({
    type: 'POST',
    url: '{!! url("/admin/delete-listing") !!}', // Replace with your actual endpoint
    data: formData,
    success: function(response) {
      toastr.success('Listing Successfully Deleted!');
      // location.reload(true); // 'true' forces a reload from the server
      $(`#loader-${id}`).addClass('d-none');
      $(`#form-btn-text-${id}`).removeClass('d-none');
    },
    error: function(error) {
      $(`#loader-${id}`).addClass('d-none');
      $(`#form-btn-text-${id}`).removeClass('d-none');
        // Handle the error response here
    }
});

  }
</script>

@if(session()->has('success'))
    <script>
        // Display toastr notification with the success message
        toastr.success('{{ session('success') }}');
    </script>
@endif
@if(session()->has('error'))
  <script>
   // Display toastr notification with the success message
   toastr.success('{{ session('error') }}');
  </script>
@endif
<div class="col-sm-12 mb-2">
<style>
                    .nav-btn1 {
                        background-color: #00A2FE;
                        color: white;
                        border: 2px solid #00A2FE;
                        width: fit-content;
                    }

                    .nav-btn1:hover {
                        background-color: transparent;
                        border: 2px solid #00A2FE;
                        color: #00A2FE;
                    }

                    .nav-btn2 {
                        border: 2px solid #00A2FE;
                        color: #00A2FE;
                    }

                    .nav-btn2:hover {
                        background-color: #00A2FE;
                        color: white;
                    }
                </style>

<div class="d-flex align-items-center py-3">
  <div class="d-flex justify-content-start flex-row w-100" >
  <a class="btn px-3 py-2 me-3 nav-btn1" style="border-radius:5px;font-size:14px;font-weight:bold" href="{{ url('/admin/add-listing') }}">Add Listing</a>
</div>
 
  <!-- Search Bar -->
  <form action="" class="d-flex align-items-center justify-content-end flex-row w-100" >
  <h5 style="font-size:18px" >Filters:</h5> 
  <select name="filter" type="text" style="height:35px;width:30%;outline:none;margin-left:5px;margin-right:5px">
    <option value="serial_no" >Kroki No</option>
    <option value="title" >Title</option>
    <option value="size" >Size</option>
    <option value="no_bedrooms" >No Of Bedrooms</option>
    <option value="no_toilets" >No Of Toilets</option>
    <option value="no_majlis" >No Of Majlis</option>
    <option value="no_floors" >No Of Floors</option>
    <option value="no_kitchens" >No Of Kitchens</option>
   </select>
   <input type="text" name="search" style="height:35px;width:50%;outline:none" value="{{$search}}" />
   <button class="btn px-3 py-2" style="background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></button>
  </form>
  

</div>
 @if(count($listings) > 0)
<table class="table bg--body">
			  <thead>
				  <tr>
					<th>Kroki No</th>
					<th>Title</th>
					<th>Land Type</th>
					<th>Land Size</th>
					<th>Date</th>
					<th>Actions</th>
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
          <div class="d-flex justify-content-center" >
         <a title="View Listing" href="{{url('/admin/view-listing')}}/{{$listing->id}}" style="border:none;font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:3px 8px 5px 8px" ><i class="fas fa-eye" style="font-size:14px" ></i></a>	
         <form id="listing-form-{{$listing->id}}" onSubmit="DeleteListing({{$listing->id}})" action="{{url('/admin/delete-listing')}}" method="post" class="mx-2" >
              @csrf  
              <input type="hidden" name="id" value="{{$listing->id}}" />
               <button title="Delete Client" style="border:none;font-weight:bold;background-color:red;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" >
                <i id="form-btn-text-{{$listing->id}}" class="fas fa-trash" style="font-size:14px" ></i>
                <div id="loader-{{$listing->id}}" class="d-none">
                <div class="spinner-border" style="width:14px;height:14px" role="status"><span class="sr-only">Loading...</span></div>
                </div>
              </button>	
              </form>	
                  </div>
         <!-- <button title="Delete Listing" style="border:none;font-weight:bold;background-color:red;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-trash" style="font-size:14px" ></i></button>	 -->
         </td>
        </tr>
        @endforeach
</table>
@else
 <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 400px)" >
   <h4>No Listing Found!</h4>
 </div>
@endif
</div>

@endsection