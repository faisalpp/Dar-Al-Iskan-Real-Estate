@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>Dashboard</title>
@endpush
<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">Dashboard</h3>
  <ul class="breadcrumb">
      <li>
          <a href="{{url('/user/dashboard')}}">Dashboard</a>
      </li>
      <li>Dashboard</li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="dashboard--wrapper">

        <div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
            <!-- <img src="{{url('/c5.png')}}" alt="wallet"> -->
			<i class="fas fa-crown" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">Vip Clients</h6>
            <div class="balance" style="font-weight:bold">65</div>
           </div>
          </div>
         </div>
        </div>

		<div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
            <!-- <img src="{{url('/c5.png')}}" alt="wallet"> -->
			<i class="fas fa-user" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">General Clients</h6>
            <div class="balance" style="font-weight:bold">65</div>
           </div>
          </div>
         </div>
        </div>
	
		<div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
            <!-- <img src="{{url('/c5.png')}}" alt="wallet"> -->
			<i class="fas fa-map" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">Total Listings</h6>
            <div class="balance" style="font-weight:bold">65</div>
           </div>
          </div>
         </div>
        </div>

  </div> 
</div> 

<div>
 <h4 style="font-weight:bold">Latest Listings</h4>
</div>

<div class="dashboard--content-item">
	  <div class="table-responsive table--mobile-lg">
		  <table class="table bg--body">
			  <thead class="bg-dark" >
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

						<td data-label="Type" style="align-text:center" class="d-flex justify-content-center">	
						<div style="font-weight:bold;background-color:#800080;border-radius:100%;color:white;width:fit-content;padding:3px 8px 5px 8px" ><i class="fas fa-crown" style="font-size:12px" ></i></div>
						</td>

						<td data-label="Txnid">
                         <div class="">
                          <button type="submit" type="button" style="background-color:white;height:fit-content;outline:none" data-bs-toggle="modal" data-bs-target="#invest-modal" class="cmn--btn"><i class="fas fa-map-marked" style="color:red;font-size:18px" ></i></button>
                         </div>

           <!-- Invest Modal -->
           <div class="modal fade" id="invest-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                 <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Faisalabad&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:500px;}</style></div></div>   
                </div>
            </div>
        </div>

							</div>
						</td>

						<td data-label="Amount">
							<div>
							<p class="text-success" style="font-weight:bold">300 OMR</p>	
						</div>
						</td>

						<td data-label="Date">
						 <p style="font-weight:bold" >On Sell</p>
						</td>
						<td data-label="Date">
						 <p style="font-weight:bold" >Dec 24 2024</p>
						</td>
					</tr>
			  <tr>
						<td data-label="No">
							<div>
							<span style="font-weight:bold" >M.Faisal</span>
							</div>
						</td>
                        <td data-label="Type" style="align-text:center" class="d-flex justify-content-center">
							<div style="font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-user" style="font-size:14px" ></i></div>
						</td>

						<td data-label="Txnid">
							<div>
							<i class="fas fa-map-marked" style="color:red;font-size:18px" ></i>
							</div>
						</td>

						<td data-label="Amount">
							<div>
							<p class="text-danger" style="font-weight:bold">300 OMR</p>	
						</div>
						</td>

						<td data-label="Date">
							<p style="font-weight:bold" >Sold</p>
						</td>
						<td data-label="Date">
							<p style="font-weight:bold" >Dec 24 2024</p>
						</td>
					</tr>
			  			  	        
			  </tbody>
		  </table>
	  </div>
</div>
@endsection