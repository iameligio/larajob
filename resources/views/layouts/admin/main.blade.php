@include('layouts.admin.header')
    <body class="sb-nav-fixed">
       @include('layouts.admin.navbar')
        <div id="layoutSidenav">
            @include('layouts.admin.sidebar')
            <div id="layoutSidenav_content">
               {{-- @include('layouts.admin.body') --}}
               @yield('content')
                @include('layouts.admin.footer')
            </div>
        </div>
        @if(Auth::check()){
            <script>
                let logout = document.getElementById('logout');
                let navform = document.getElementById('form-logout');
                logout.addEventListener('click', function() {
                    navform.submit();
                })
            </script>
        @endif
    </body>
</html>
