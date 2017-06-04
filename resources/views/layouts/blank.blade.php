<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.head')

<body class="app flex-row align-items-center sidebar-hidden ">
    @yield('content')

	@include('layouts.partials.script')    
</body>

</html>