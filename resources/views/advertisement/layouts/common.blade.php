
<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'>
	<link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/x-icon">
	<meta name="google-site-verification" content="aqKB2Y5OJx455FadC19ENwv07ekmR-u1kc67hzJgkNI" />
	
	<!-- Google Adz -->
    {!! $googleAdsInfo !!}
    <!-- Google Adz -->
    <!-- Google Tag Manager -->
    {!! $googleTagInfo !!}
    <!-- End Google Tag Manager -->
    
    <script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js" crossorigin="anonymous"></script>
    
	@stack('custom-meta')
	
	<!--ad blocking recovery code start-->
    @include('ad_blocking_recovery')
    <!--ad blocking recovery code end-->

	@include('advertisement.includes.head_script')
	@stack('custom-search_script')
    @stack('custom-css')
    @stack('ads-script')
    
    <style>
    /*    ins.adsbygoogle[data-ad-status='unfilled'] {*/
    /*        display: none !important;*/
    /*    }*/
    </style>
        
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJ77XV6N"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
	<!-- Main navbar -->
	@include('advertisement.includes.common_head_menu')
	@include('advertisement.components.common.marque')
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			@if(Auth::guard('customer')->check())
				@include('advertisement.includes.head_menu')
			@endif
			<!-- /page header -->

			@yield('content')

			<!-- Footer -->
			@include('advertisement.includes.footer')
			<!-- /footer -->

		</div>
		<!-- /main content -->

		<div class="modal fade" id="myModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

		<div id="product_detail_loader"  class="preloader">
			<div class="inner-div-loader">
				<div class="lds-ripple"><div></div><div></div>   
				</div> 
				{{--<h1>Action is being processed,</h1>
				<h1>Please wait ...</h1>
				<h1>(Please do not press 'Refresh' or 'Back' button)</h1>
				<h1>Thank you.</h1>--}}
			</div>
		</div>
		
		@stack('custom-scripts')
	</div>
	<!-- /page content -->
	<script>
		@if (Session::has('success'))
			toastr.success("{{Session::get('success') }}", 'Success');
			@php
			Session::forget('success')
			@endphp
			@endif
			@if (Session::has('error'))
			toastr.error("{{ Session::get('error') }}", 'Error');
			@php
			Session::forget('error')
			@endphp
		@endif
	</script>
</body>
</html>
