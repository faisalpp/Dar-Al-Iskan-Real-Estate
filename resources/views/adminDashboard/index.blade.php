@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>@lang('Dashboard')</title>
@endpush
<div class="dashborad--content">
				
<div class="breadcrumb-area">
  <h3 class="title">@lang('Dashboard')</h3>
  <ul class="breadcrumb">
      <li>
          <a href="{{url('/user/dashboard')}}">@lang('Dashboard')</a>
      </li>
      <li>@lang('Dashboard')</li>
  </ul>
</div>

<script>
  $(document).ready(function() {
    $('#language-switcher').on('change',function(){
      $('#language-switcher-form').submit()
    })
  })
</script>

<form id="language-switcher-form" action="{{url('/change-language')}}" method="POST" class="d-flex w-100 justify-content-end mb-3" >
@csrf  
<select id="language-switcher" name="language" class="form-control" style="width:fit-content" >
    @if(app()->getLocale() === 'ar')
    <option value="ar" >@lang('Arabic')</option>
    <option value="en" >@lang('English')</option>
     @else
     <option value="en" >@lang('English')</option>
     <option value="ar" >@lang('Arabic')</option>
    @endif
  </select>
</form>

<div class="dashboard--content-item">
  <div class="dashboard--wrapper">

        <div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
			<i class="fas fa-crown" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">@lang('Vip Clients')</h6>
            <div class="balance" style="font-weight:bold">{{$total_vip_clients}}</div>
           </div>
          </div>
         </div>
        </div>

		<div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
			<i class="fas fa-user" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">@lang('General Clients')</h6>
            <div class="balance" style="font-weight:bold">{{$total_org_clients}}</div>
           </div>
          </div>
         </div>
        </div>
	
		<div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
			<i class="fas fa-map" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">@lang('Listing On Sell')</h6>
            <div class="balance" style="font-weight:bold">{{$total_onsell_listings}}</div>
           </div>
          </div>
         </div>
        </div>

		<div class="dashboard--width">
         <div class="dashboard-card h-100">
          <div class="dashboard-card__header">
           <div class="dashboard-card__header__icon">
			<i class="fas fa-map" ></i>
           </div>
           <div class="dashboard-card__header__cont">
            <h6 class="name">@lang('Listing Sold')</h6>
            <div class="balance" style="font-weight:bold">{{$total_sold_listings}}</div>
           </div>
          </div>
         </div>
        </div>

  </div> 
</div> 

<div class="my-5" >
 <h4 style="font-weight:bold">@lang('Latest Listings')</h4>
</div>

@if(count($latest_listings) > 0)
<div style="overflow-x:scroll">
<table class="table table-responsive">
  <thead class="thead-dark">
    <tr>
		 <th scope="col" >@lang('Kroki No')</th>
		 <th scope="col" >@lang('Title')</th>
		 <th scope="col" >@lang('Land Type')</th>
		 <th scope="col" >@lang('Land Size')</th>
		 <th scope="col" >@lang('Date')</th>
		 <th scope="col" >@lang('Actions')</th>
		</tr>
  </thead>
  <tbody class="bg-white" >
    @foreach($latest_listings as $listing)
    <tr>
      <td style="min-width:100px" >{{$listing->serial_no}}</td>
		  <td style="min-width:100px" >{{$listing->title}}</td>
      @if($listing->type === 'Apartment')
		  <td style="min-width:100px" >@lang('Apartment')</td>
		  @elseif($listing->type === 'Land')
		  <td style="min-width:100px" >@lang('Land')</td>
      @else
		  <td style="min-width:100px" >@lang('Villa')</td>
      @endif

      <td style="min-width:100px" >{{$listing->size}}</td>
		  <td style="min-width:100px" >{{date_format($listing->created_at,'d M Y')}}</td>
      <td>
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
         </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@else
 <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 600px)" >
   <h4>@lang('No Listings Found!')</h4>
 </div>
@endif


<div>
 <h4 style="font-weight:bold">@lang('Latest Clients')</h4>
</div>


@if(count($latest_clients) > 0)
<div style="overflow-x:scroll">
<table class="table table-responsive" style="overflow-x:scroll">
  <thead class="thead-dark">
    <tr>
      <th scope="col">@lang('Client Name')</th>
			<th scope="col">@lang('Type')</th>
			<th scope="col">@lang('Email')</th>
			<th scope="col">@lang('Phone')</th>
			<th scope="col">@lang('Date')</th>
			<th scope="col">@lang('Listings')</th>
    </tr>
  </thead>
  <tbody class="bg-white" >
    @foreach($latest_clients as $client)
    <tr>
      <td style="min-width:200px" >{{$client->first_name}}&nbsp;{{$client->middle_name}}&nbsp;{{$client->last_name}}</td>
      <td style="min-width:50px" >
      @if($client->is_vip === 'yes')
       <div title="VIP" style="font-weight:bold;background-color:#800080;border-radius:100%;color:white;width:fit-content;padding:3px 8px 5px 8px" ><i class="fas fa-crown" style="font-size:12px" ></i></div>
      @else
      <div title="Normal" style="font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" ><i class="fas fa-user" style="font-size:14px" ></i></div>	
      @endif
      </td>
      <td style="min-width:100px" >{{$client->email}}</td>
      <td style="min-width:150px" >{{$client->phone}}</td>
      <td style="min-width:100px" >{{date_format($client->created_at,"d M Y")}}</td>
      <td>
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
  </tbody>
</table>
</div>
@else
 <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 600px)" >
   <h4>@lang('No Clients Found!')</h4>
 </div>
@endif

</div>
</div>
@endsection