<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


    <nav class="navbar navbar-expand-lg bg-dark shadow-lg" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create.seeker') }}">Job Seeker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('create.employer') }}">Employer</a>
                    </li>
                    @endif
                    @if(Auth::check()){
                        <li class="nav-item">
                            <a class="nav-link" id="dashboard" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        @if(auth()->user()->user_type == 'employer')
                            <li class="nav-item">
                                <a class="nav-link" id="subscribe" href="{{ route('subscribe') }}">Subscribe</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" id="logout" href="#">Logout</a>
                        </li>
                    }
                    <form id="form-logout" action={{ route('logout') }} method="post">@csrf </form>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')

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
