<!DOCTYPE html>
<html lang="en">

	@include('admin.layouts.partials.head')
	@section('title','Anaknegeri')
<body class="app header-fixed sidebar-fixed" >

			@include('admin.layouts.partials.navbar')
			<div class="app-body">
			<!-- Tampilkan sidebar sesuai dengan role yang ada -->
      @if (Auth::check())
        @if (Auth::user()->hasRole('administrator'))
					@include('admin.layouts.partials.sidebar.admin')
				@elseif (Auth::user()->hasRole('finance'))
					@include('admin.layouts.partials.sidebar.finance')
				@else
					@include('admin.layouts.partials.sidebar.logistic')
				@endif
			@endif
			<main class="main">
				@include('admin.layouts.partials.breadcrumb')

				<div class="container-fluid">
		  		@yield('content')
				</div>
			</main>
		
			</div>
			@include('admin.layouts.partials.footer')    
			@include('admin.layouts.partials.script') 
			@yield('script')  

</body>
	
</html>

