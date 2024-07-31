<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Navbar</title>
   <!-- bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

   <!-- google font -->
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

   <!-- font awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">


    @yield('style')
    <style>
        header {
            z-index: 999;
        }
    </style>
    </head>

@php
    $user = App\Models\User::find(auth()->user()->user_id)
@endphp
<body>
    <header class="position-fixed top-0">
        <div class="d-flex flex-column flex-shrink-0 sidebar-wrap">
            <a style="padding: 10px;" href="/" class="mt-5 text-decoration-none logo-wrap">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('../assets/navbar/LOGO.png') }}" alt="">
                </div>
                <h2 class="m-0">Monye-T</h2>
            </a>
            <hr>
            <div style="padding: 10px;">
                <a id="ButtonAddTransaksi" class="yellowbg d-flex text-decoration-none text-black justify-content-center align-items-center buttoncircle mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                    </svg>
                    <h2>Transaksi</h2>
                </a>
            </div>
            <ul style="padding: 10px;" class="nav nav-pills flex-column mb-auto mt-3 beforehover">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link HomeIcon" aria-current="page">
                        <div class="icon-wrap">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="beforehover">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('anggaran.index')}}" class="nav-link AnggaranIcon">
                        <div class="icon-wrap">
                            <i class="bi bi-database"></i>
                        </div>
                        <span class="">Anggaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pencatatan') }}" class="nav-link TransaksiIcon">
                        <div class="icon-wrap">
                            <i class="bi bi-cash"></i>
                        </div>
                        <span class="">Transaksi</span>
                    </a>
                </li>
            </ul>
            <div>
                <a href="{{route('profile.index')}}" class="text-decoration-none loginButton d-flex justify-content-center align-items-center">
                    @if($user->gambar_user)
                        <img width="50" height="50" style="border-radius: 100%" id="profilepic" src="{{ asset($user->gambar_user) }}" alt="Profile Picture">
                    @else
                        <img class="profilepic" src="{{ asset('../Assets/Navbar/default.png') }}" alt="">
                    @endif
                    <h2>{{ Auth::user()->username }}</h2>
                </a>
            </div>
        </div>
    </header>
    <div class="position-absolute " style="z-index: 100000;">
        @include('PopupTambahAnggaran')
    </div>
    <div class="position-absolute" style="z-index: 100;">
        @include('popup_Transaksi')
    </div>
    @yield('content')
</body>
<!-- Bootstrap JS and dependencies -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap Date Picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@yield('script')

</html>
