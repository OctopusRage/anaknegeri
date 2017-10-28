<!DOCTYPE html>
<html lang="en">

	@include('layouts.partials.head')
	@section('title','Anaknegeri')
	@include('alert::message')

<body class="app header-fixed sidebar-hidden sidebar-fixed" >
		
		@include('layouts.partials.navbar')
		<div class="app-body">
			@include('layouts.partials.sidebar')
		</div>
		@include('banner.unactive')
		@yield('content')


		@include('layouts.partials.footer')    
		@include('layouts.partials.script') 
		@yield('script')   
</body>
	
</html>
