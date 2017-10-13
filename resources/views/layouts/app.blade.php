<!DOCTYPE html>
<html lang="en">

	@include('layouts.partials.head')
	@section('title','Anaknegeri')
	@include('alert::message')

<body class="app header-fixed sidebar-hidden sidebar-fixed" >
		
		@include('layouts.partials.navbar')
		<div class="app-body">
			@include('layouts.partials.sidebar')
			@yield('content')
		</div>
		@include('banner.unactive')


		@include('layouts.partials.footer')    
		@include('layouts.partials.script') 
		@yield('script')   
</body>
	
</html>