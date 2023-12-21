@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Client Management</title>
@endpush
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
<div>
 <h5 class="text-success text-center mb-2" >{{session()->get('success')}}</h5>
</div>
@endif
@if(session()->has('error'))
<div>
 <h5 class="text-danger text-center mb-2" >{{session()->get('error')}}</h5>
</div>
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
  <form action=""  class="d-flex align-items-center justify-content-end flex-row w-100" >
  <input type="search" name="search" style="height:35px;width:40%;outline:none" value="{{$search}}" />
   <button class="btn px-3 py-2" style="border:none;background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></button>
</form>
  

</div>
 
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
							<div>
							<!-- <button title="View Client" style="border:none;font-weight:bold;background-color:#28628B;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-eye" style="font-size:14px" ></i></button>	 -->
							<button title="View Listing" style="border:none;font-weight:bold;background-color:red;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-map" style="font-size:14px" ></i></button>	
							</div>
						</td>
        </tr>
        @endforeach
</table>
{{ $clients->links() }}
</div>

@endsection