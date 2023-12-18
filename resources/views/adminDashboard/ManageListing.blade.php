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
  <a class="btn px-3 py-2 me-3 nav-btn1" style="border-radius:5px;font-size:14px;font-weight:bold" href="{{ url('/admin/add-listing') }}">Add Listing</a>
</div>
 
  <!-- Search Bar -->
  <div class="d-flex align-items-center justify-content-end flex-row w-100" >
   <input type="text" style="height:35px;width:50%;outline:none" />
   <a class="btn px-3 py-2" style="background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></a>
 </div>
  

</div>
 
<table class="table bg--body">
			  <thead>
				  <tr>
					<th>Client Name</th>
					<th>Type</th>
					<th>Location</th>
					<th>Amount</th>
					<th>Status</th>
					<th>Date</th>
				  </tr>
			  </thead>
			  <tbody>

			  <tr>
						<td data-label="No">
							<div>
							<span style="font-weight:bold" >M.Faisal</span>
							</div>
						</td>
        </tr>
</table>
</div>

@endsection