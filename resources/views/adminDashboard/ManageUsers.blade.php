@extends('adminDashboard.layout.main')
@section('main')
@push('title')
<title>@lang('User Management')</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

<!-- unBan Form Function Start -->
<script>
  function UnBanClient(id){
      // Show the loader
   $(`#loader-unban-${id}`).removeClass('d-none');
   $(`#form-unban-btn-text-${id}`).addClass('d-none');

   const formData = new FormData();
   formData.append('id',id);

// Make an Ajax POST request
$.ajax({
    type: 'POST',
    url: '{!! url("/admin/unban-user") !!}', // Replace with your actual endpoint
    data: formData,
    contentType: false,
    processData: false,
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      window.location.reload()
      toastr.success('User Successfully UnBanned!');
      // location.reload(true); // 'true' forces a reload from the server
      $(`#loader-unban-${id}`).addClass('d-none');
      $(`#form-unban-btn-text-${id}`).removeClass('d-none');
    },
    error: function(error) {
      toastr.error('Internal Server Error!');
      $(`#loader-ban-${id}`).addClass('d-none');
      $(`#form-unban-btn-text-${id}`).removeClass('d-none');
        // Handle the error response here
    }
});

  }
</script>

<!-- unBan Form Function End -->
<!-- Ban Form Function Start -->
<script>
  function BanClient(id){
      // Show the loader
   $(`#loader-ban-${id}`).removeClass('d-none');
   $(`#form-ban-btn-text-${id}`).addClass('d-none');

   const formData = new FormData();
   formData.append('id',id);

// Make an Ajax POST request
$.ajax({
    type: 'POST',
    url: '{!! url("/admin/ban-user") !!}', // Replace with your actual endpoint
    data: formData,
    contentType: false,
    processData: false,
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      window.location.reload()
      toastr.success('User Successfully Banned!');
      // location.reload(true); // 'true' forces a reload from the server
      $(`#loader-ban-${id}`).addClass('d-none');
      $(`#form-ban-btn-text-${id}`).removeClass('d-none');
    },
    error: function(error) {
      toastr.error('Internal Server Error!');
      $(`#loader-ban-${id}`).addClass('d-none');
      $(`#form-ban-btn-text-${id}`).removeClass('d-none');
        // Handle the error response here
    }
});

  }
</script>

<!-- Ban Form Function End -->
<!-- Delete Form Function Start -->
<script>
  function DeleteClient(id){
      // Show the loader
   $(`#loader-${id}`).removeClass('d-none');
   $(`#form-btn-text-${id}`).addClass('d-none');

   const formData = new FormData();
   formData.append('id',id);

// Make an Ajax POST request
$.ajax({
    type: 'POST',
    url: '{!! url("/admin/delete-user") !!}', // Replace with your actual endpoint
    data: formData,
    contentType: false,
    processData: false,
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      console.log(response)
      toastr.success('User Successfully Deleted!');
      // location.reload(true); // 'true' forces a reload from the server
      $(`#loader-${id}`).addClass('d-none');
      $(`#form-btn-text-${id}`).removeClass('d-none');
    },
    error: function(error) {
      toastr.error('Internal Server Error!');
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
  <h3 class="title">@lang('User Management')</h3>
  <ul class="breadcrumb">
      <li>
        <a href="{{url('/admin/dashboard')}}">@lang('Dashboard')</a>
      </li>

      <li>@lang('User Management')</li>
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

<div class="d-flex flex-column-reverse flex-lg-row justify-content-center align-items-center py-3">
  <div class="d-flex justify-content-start flex-row mt-2" >
  <a class="btn px-3 py-2 me-3 nav-btn1" style="border-radius:5px;font-size:0.87rem;font-weight:bold;min-width:100px" href="{{ url('/admin/add-user') }}">@lang('Add User')</a>
</div>
 
  <!-- Search Bar -->
  <form action="" class="d-flex align-items-center justify-content-end flex-row w-100" >
  <h5 style="font-size:18px" >@lang('Filters'):</h5> 
  <select name="filter" type="text" style="height:35px;width:fit-content;outline:none;margin-left:5px;margin-right:5px">
    <option value="all" >@lang('All users')</option>
    <option value="user_name" >@lang('UserName')</option>
    <option value="email" >@lang('Email')</option>
    <option value="phone" >@lang('Phone')</option>
   </select>
   <input type="text" name="search" style="height:35px;width:20%;outline:none" value="{{$search}}" />
   <button class="btn px-3 py-2" style="background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-search" style="color:white;font-size:14px"></i></button>
  </form>
  <!-- <button data-bs-toggle="modal" data-bs-target="#client-export" type="button" class="btn btn-success px-3 py-2" style="margin-left:10px;border-radius:5px;height:40px" href="{{ url('/admin/dashboard') }}"><i class="fas fa-print" style="color:white;font-size:18px"></i></button> -->
</div>

 @if(count($users) > 0)
 <div style="overflow-x:scroll" >
<table class="table bg--body">
			  <thead>
				  <tr>
					<th>@lang('User Name')</th>
					<th>@lang('Email')</th>
					<th>@lang('Phone')</th>
					<th>@lang('Date')</th>
					<th>@lang('Status')</th>
					<th>@lang('Actions')</th>
				  </tr>
			  </thead>
			  <tbody>
@foreach($users as $user)
			  <tr>
						<td style="min-width:100px" >{{$user->user_name}}</td>
            <td style="min-width:100px">{{$user->email}}</td>
            <td style="min-width:130px">{{$user->phone}}</td>
            <td style="min-width:100px">Dec 28 2024</td>
            <td style="min-width:100px">
            @if($user->status === '1')
             Working
             @else
             Banned
             @endif
            </td>
            <td style="min-width:100px">
            <div class="d-flex justify-content-center" >
              <div id="client-form-{{$user->id}}" class="mx-2" >  
               <button type="button" onclick="DeleteClient({{$user->id}})" title="Delete User" style="border:none;font-weight:bold;background-color:red;border-radius:100%;color:white;width:fit-content;padding:3px 9px 5px 9px" >
                <i id="form-btn-text-{{$user->id}}" class="fas fa-trash" style="font-size:14px" ></i>
                <div id="loader-{{$user->id}}" class="d-none">
                <div class="spinner-border" style="width:14px;height:14px" role="status"><span class="sr-only">Loading...</span></div>
                </div>
              </button>	
             </div>	
             @if($user->status === '1')
              <div id="client-ban-form-{{$user->id}}" class="mx-2" >  
               <button type="button" onclick="BanClient({{$user->id}})" title="Ban User" style="border:none;font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:5px 7px 3px 7px" >
                <i id="form-ban-btn-text-{{$user->id}}" class="fas fa-ban" style="font-size:18px" ></i>
                <div id="loader-ban-{{$user->id}}" class="d-none">
                <div class="spinner-border" style="width:14px;height:14px" role="status"><span class="sr-only">Loading...</span></div>
                </div>
              </button>	
             </div>	
             @else
             <div id="client-unban-form-{{$user->id}}" class="mx-2" >  
              <button type="button" onclick="UnBanClient({{$user->id}})" title="UnBan User" style="border:none;font-weight:bold;background-color:orange;border-radius:100%;color:white;width:fit-content;padding:5px 7px 3px 7px" >
               <i id="form-unban-btn-text-{{$user->id}}" class="fas fa-redo" style="font-size:16px" ></i>
               <div id="loader-unban-{{$user->id}}" class="d-none">
               <div class="spinner-border" style="width:14px;height:14px" role="status"><span class="sr-only">Loading...</span></div>
               </div>
             </button>	
            </div>	
             @endif
             </div>
            </td>
        </tr>
      @endforeach
</table>
</div>
{{ $users->links() }}
@else
 <div class="d-flex justify-content-center align-items-center w-100" style="height: calc(100vh - 400px)" >
   <h4>@lang('No Users Found')!</h4>
 </div> 
@endif

</div>

<script>
  $(document).ready(function(){
    $('#print_options').on('change', function(){
      const option = $('#print_options').val();
      console.log(option)
      if(option === 'all-time'){
        $('#date_start').css('display','none')
        $('#date_end').css('display','none')
      }else{
        $('#date_start').css('display','flex')
        $('#date_end').css('display','flex')
      }
    });
  });
</script>

<script>
$(document).ready(function(){
 $('#pdf-form').on('submit',function(){
  $('#loader-download').removeClass('d-none');
   $('#download-txt').addClass('d-none');  
 });
});
</script>

 <!-- Invest Modal -->
<div class="modal fade" id="client-export">
 <div class="modal-dialog">
  <div class="modal-content">
   <form action="{{url('/admin/export-clients-pdf')}}" method="POST" id="pdf-form" style="gap:10px" class="d-flex me-5 flex-column align-items-center justify-content-center my-2 mx-4" >
   @csrf
   <div class="d-flex flex-column align-items-center" style="width:50%" >
    <h4 style="font-size:16px;align-self:start" >@lang('Filter')</h4>
   <select id="print_options" name="print-options" class="form-control" style="width:100%" >
    <option value="all-time">@lang('All Time')</option>
    <option value="by-date" >@lang('By Date')</option>
   </select>
</div>
   <div id="date_start" class="flex-column align-items-center" style="display:none;width:50%" >
    <h4 style="font-size:16px;align-self:start" >@lang('Start Date')</h4>
    <input type="date" name="date_start" class="form-control" style="width:100%" />
   </div>
   <div id="date_end" class="flex-column align-items-center" style="display:none;width:50%" >
    <h4 style="font-size:16px;align-self:start" >@lang('End Date')</h4>
    <input type="date" name="date_end" class="form-control" style="width:100%" />    
   </div>
   <div class="d-flex me-5 w-100 justify-content-center" >
    <button class="btn px-3 py-2" style="color:white;background-color:#D5924D;margin-left:10px;border-radius:5px;height:40px">
     <span id="download-txt" >@lang('Download')</span>
     <div id="loader-download" class="d-none">
      <div class="spinner-border" style="width:14px;height:14px" role="status"><span class="sr-only">Loading...</span></div>
     </div>
    </button>
   </div> 
  </form> 
 </div>
</div>

@endsection