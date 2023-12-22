@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Client Management</title>
@endpush

<!-- <script>
  toastr.success('Success messages');
</script> -->

<!-- Delete Form Function Start -->
<script>
  function DeleteClient(id){
      // Show the loader
   $(`#loader-${id}`).removeClass('d-none');
   $(`#form-btn-text-${id}`).addClass('d-none');

   const formData = $(`#client-form-${id}`).serialize();

// Make an Ajax POST request
$.ajax({
    type: 'POST',
    url: '{!! url("/admin/delete-client") !!}', // Replace with your actual endpoint
    data: formData,
    success: function(response) {
      toastr.success('Client Successfully Deleted!');
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

<!-- Delete Form Function End -->



<div class="dashborad--content">
				<div class="breadcrumb-area">
  <h3 class="title">Client Management</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/admin/dashboard')}}">Dashboard</a>
      </li>

      <li>Client Management</li>
  </ul>
</div>

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
  <a class="btn px-3 py-2 me-3 nav-btn1" style="border-radius:5px;font-size:14px;font-weight:bold" href="{{ url('/admin/add-client') }}">Add Client</a>
</div>
 
  <!-- Search Bar -->
  <form action="" class="d-flex align-items-center justify-content-end flex-row w-100" >
  <h5 style="font-size:18px" >Filters:</h5> 
  <select name="filter" type="text" style="height:35px;width:30%;outline:none;margin-left:5px;margin-right:5px">
    <option value="all" >All Clients</option>
    <option value="first_name" >First Name</option>
    <option value="last_name" >Last Name</option>
    <option value="middle_name" >Middle Name</option>
    <option value="yes" >Vip</option>
    <option value="no" >General</option>
    <option value="email" >Email</option>
    <option value="phone" >Phone No</option>
   </select>
   <input type="text" name="search" style="height:35px;width:50%;outline:none" value="{{$search}}" />
   <button class="btn px-3 py-2" style="background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></button>
  </form>
  

</div>
 @if(count($clients) > 0)
<table class="table bg--body">
			  <thead>
				  <tr>
					<th>Client Name</th>
					<th>Type</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Date</th>
					<th>Listings</th>
				  </tr>
			  </thead>
			  <tbody>
       @foreach($clients as $client)
			  <tr>
						<td data-label="No">
							<div>
							<span >{{$client->first_name}} {{$client->middle_name}} {{$client->last_name}}</span>
							</div>
						</td>
						<td data-label="No">
							<div class="d-flex justify-content-center" >
              @if($client->is_vip === 'yes')
               <div title="VIP" style="font-weight:bold;background-color:#800080;border-radius:100%;color:white;width:fit-content;padding:3px 8px 5px 8px" ><i class="fas fa-crown" style="font-size:12px" ></i></div>
              @else
              <div title="Normal" style="font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-user" style="font-size:14px" ></i></div>	
              @endif
							</div>
						</td>
            <td data-label="No">
							<div>
							<span >{{$client->email}}</span>
							</div>
						</td>
            <td data-label="No">
							<div>
							<span >{{$client->phone}}</span>
							</div>
						</td>
            <td data-label="No">
							<div>
							<span >{{date_format($client->created_at,"d M Y")}}</span>
							</div>
						</td>
            <td data-label="No">
							<div class="d-flex justify-content-center" >
							<a title="View Client" href="{{url('/admin/view-client')}}/{{$client->id}}" style="border:none;font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-eye" style="font-size:14px" ></i></a>	
              <form id="client-form-{{$client->id}}" onSubmit="DeleteClient({{$client->id}})" action="{{url('/admin/delete-client')}}" method="post" class="mx-2" >
              @csrf  
              <input type="hidden" name="id" value="{{$client->id}}" />
               <button title="Delete Client" style="border:none;font-weight:bold;background-color:red;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" >
                <i id="form-btn-text-{{$client->id}}" class="fas fa-trash" style="font-size:14px" ></i>
                <div id="loader-{{$client->id}}" class="d-none">
                <div class="spinner-border" style="width:14px;height:14px" role="status"><span class="sr-only">Loading...</span></div>
                </div>
              
              </button>	
              </form>	
             </div>
						</td>
        </tr>
        @endforeach
</table>
@else
 <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 400px)" >
   <h4>No Client Found!</h4>
 </div>
@endif

{{ $clients->links() }}
</div>

@endsection