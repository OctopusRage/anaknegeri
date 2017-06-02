<!DOCTYPE html>
<html lang="en">

@include('auth.layouts.partials.head')

<body class="app flex-row align-items-center">
    @yield('content')

@include('auth.layouts.partials.script')    
</body>

</html>