<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('AdminDesign/Asset/css/fontawsome/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <title>Document</title>
    <style>
        .mainContainer {
            display: flex;
            flex-direction: column; /* Stack content vertically */
        }
        .content {
            padding: 20px;
        }
        .card-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center; /* Center cards */
        }
        .card {
            width: 100%; /* Full width in the container */
            max-width: 300px; /* Limit maximum width */
            height: 400px; /* Fixed height */
            display: flex;
            flex-direction: column; /* Stack content vertically */
        }
        .card-container .card img{
 width: 100%;
 height: 200px;
 padding: 20px;
}
        .card-body {
            flex: 1; /* Allow the body to grow */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Space out elements */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" >
                <img src="{{ asset('Capture3-removebg-preview.png') }}" alt="Logo" style="width: 100px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href="profile" class="btn dropdown-item">Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <div class="mainContainer" id="mainContainer">
        <div class="content">
            <h3 class="m-4 heading">همه موارد</h3>
            <div class="row">
              
                <div class="card-container col-md-3 col-sm-6">
                    <div class="card shadow-sm">
                        <img class="card-img-top" src="{{ asset('exam.png') }}" alt="Title">
                        <div class="card-body">
                            <h4 class="card-title">امتحان </h4>
                            <p class="card-text time">زمان امتحان: </p>
                            <p class="card-text score">نمره امتحان: }</p>
                            
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="links">
                
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>