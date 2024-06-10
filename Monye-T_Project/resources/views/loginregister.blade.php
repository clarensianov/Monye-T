<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
</head>
<style>
    .w-65{
        width: 65%;
    }
    .w-45{
        width: 45%;
    }
    .h-85{
        scale: 0.93;
    }
    .Yellow{
        background-color: #FEEE72;
    }
    .yellow-button{
        background-color: #FEEE7285;
        transition: ease 0.3s;
    }
    .yellow-button:hover{
        background-color: #FEEE72;
    }
    .font-weight-700{
        font-weight: 700;
    }
    .container-field{
        width: 85%;
        height: 80%;
    }
    .corner-radius{
        border-radius: 30px;
    }
    .button-layout{
        padding: 13px 0;
        border-radius: 21px;
    }
    .bg-swhite{
        background-color: #F5F5F5;
        box-shadow: 10px 8px  20px 0 rgba(0, 0, 0, 0.25);
    }
    .text-sblack{
        color: #222222;
    }
    .text-on-select{
        color: #222222;
        border-bottom: 5px solid #FEEE72;
    }
    .text-not-on-select{
        color: #00000025;
    }
    .become-pointer{
        cursor: pointer;
    }
    .text-brown{
        color: #43362B;
    }
    .font-14{
        font-size: 14px;
    }
    .font-16{
        font-size: 16px;
    }
    .text-serror{
        color: #EC0D0D92;
    }
    .p-2-5{
        padding: 11px;
        border-radius: 13px;
    }
    .password-box .fa{
        width: 20px;
        font-size: 15px;
    }
    .w-10{
        width: 50px;
        height: 46px;
    }
    .eye-button{
        background-color: #FEEE7285;
        color: #00000075;
        border-radius: 10px;
        transition: 0.2s ease;
    }
    .eye-button:hover{
        background-color: #FEEE72;
    }
</style>
<body>
    <div class="w-100 vh-100 Yellow d-flex justify-content-center align-items-center">
        <div class=" w-75 bg-swhite container-field corner-radius d-flex align-items-center">
            <div class="w-100 h-100">
                <div class="row h-100 ">
                    <div class="col-5 d-flex align-items-center bg-warning justify-content-center" style="border-radius: 30px 0 0 30px;">
                        <h1 class="text-white">Belum Ada Ide</h1>
                    </div>
                    <div class="col">
                        <div class=" flex-column d-flex justify-content-center align-items-center h-85 w-100">
                            <h1 class="text-sblack font-weight-bold">Logo</h1>
                            <div class="row mt-4 w-50 justify-content-center">
                                <div class="Daftar col d-flex justify-content-center become-pointer">
                                    <h2 class="text-not-on-select">Daftar</h2>
                                </div>
                                <div class="Masuk col d-flex justify-content-center become-pointer">
                                    <h2 class="text-on-select">Masuk</h2>
                                </div>
                            </div>

                            <!-- Daftar -->
                            <div class="DaftarArea w-100 d-none d-flex flex-column align-items-center">
                                <p class="font-14 mt-2 font-weight-light">Mari bergabung dan ambil kendali atas keuangan Anda!</p>
                                <div class="w-65">
                                    <form action="/loginregister/register" method="POST">
                                        @csrf
                                        <div class="w-100">
                                            <div class="d-flex flex-row w-100 justify-content-between">
                                                <div class="d-flex flex-column w-45">
                                                    <label for="NamaDepan">Nama depan</label>
                                                    <input type="text" class="p-2-5 form-control" id="NamaDepan" placeholder="Nama Depan"  name="namaDepan" value="{{ Session::get('namaDepan') }}">    
                                                    @error('namaDepan')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="d-flex flex-column w-45">
                                                    <label for="NamaBelakang">Nama belakang</label>
                                                    <input type="text" class="p-2-5 form-control" id="NamaBelakang" placeholder="Nama Belakang" value="{{ Session::get('namaBelakang') }}" name="namaBelakang">
                                                    @error('namaBelakang')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100 mt-3">
                                            <div class="d-flex flex-column mt-2">
                                                <label for="Email">Email</label>
                                                <input type="email" class="p-2-5 form-control" id="Email" placeholder="Masukkan email" value="{{ Session::get('email') }}" name="email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mt-3">
                                                <label for="Username">Username</label>
                                                <input type="text" class="p-2-5 form-control" id="Username" placeholder="Masukkan username" value="{{ Session::get('username') }}" name="username">
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mt-3">
                                                <label for="Kata Sandi">Kata Sandi</label>
                                                <div class="d-flex flex-row align-items-center password-box w-100">
                                                    <input type="password" class="p-2-5 form-control" id="KataSandi" placeholder="Masukkan kata sandi" name="password">
                                                    <div class="eye-toggle w-10 d-flex mx-1 justify-content-center align-items-center eye-button">
                                                        <i class="fas fa-eye" id="show_eye"></i>
                                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror  
                                            </div>
                                        </div>
                                        @if (session('registerFailed'))
                                            <div class="d-flex flex-row gap-2 mt-2">
                                                <div class="d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-danger m-0" style="font-weight: 500;">{{ session('registerFailed') }}</p>
                                                </div>
                                            </div>                                    
                                        @endif
                                        {{-- <div class="d-flex flex-row gap-2 mt-2">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-serror m-0" style="font-weight: 500;">Email/Username Anda Sudah Terdaftar!</p>
                                            </div>                                    
                                        </div> --}}
                                        <div class="w-100">

                                            <!-- abis nekan tombol daftar Ini nanti di redirect ke blade buatkatapemulihan -->                                            
                                            <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button border-0 w-100 mt-3 text-brown font-weight-700 button-layout">Daftar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        

                            <!-- Masuk -->
                            <div class="MasukArea w-100 d-flex flex-column align-items-center">
                                <p style="font-weight: 400;">Ayo Masuk Ke Akun Anda!</p>
                                <div class="w-65 ">
                                    <form action="/loginregister/login" method="POST">
                                        @csrf
                                        <div class="w-100">
                                            <div class="d-flex flex-column mt-3">
                                                <label for="Email">Email</label>
                                                <input type="text" class="p-2-5 form-control" id="Email" placeholder="Masukkan email" value="{{ Session::get('email') }}" name="email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="d-flex flex-column mt-3">
                                                <label for="Kata Sandi">Kata Sandi</label>
                                                <div class="d-flex flex-row align-items-center password-box w-100">
                                                    <input type="password" class="p-2-5 form-control" id="KataSandi2" placeholder="Masukkan kata sandi" name="password">
                                                    <div class="eye-toggle2 w-10 d-flex mx-1 justify-content-center align-items-center eye-button">
                                                        <i class="fas fa-eye" id="show_eye2"></i>
                                                        <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if (session('loginFailed'))
                                            <div class="d-flex flex-row gap-2 mt-2 mb-5">
                                                <div class="d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-danger m-0" style="font-weight: 500;">{{ session('loginFailed') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- <div class="d-flex flex-row gap-2 mt-2 mb-5">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-serror m-0" style="font-weight: 500;">Email/Username Anda Sudah Terdaftar!</p>
                                            </div>
                                        </div> --}}
                                        <div class="mt-5 w-100 d-flex flex-column align-items-center">
                                            <div class="d-flex justify-content-end">
                                                <a href="lupasandi" class="LupaPassword become-pointer font-16 text-underscore m-0 text-sblack" style="font-weight: 700;"><u>Lupa kata sandi?</u></a>
                                            </div>

                                            <!-- abis nekan tombol masuk Ini nanti di direct ke blade home -->
                                            <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button border-0 w-100 mt-3 text-brown font-weight-700 button-layout">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".Daftar").click(function(){
            $(".Daftar").children().addClass("text-on-select");
            $(".Daftar").children().removeClass("text-not-on-select");
            $(".Masuk").children().removeClass("text-on-select");
            $(".Masuk").children().addClass("text-not-on-select");
        });
        $(".Masuk").click(function(){
            $(".Masuk").children().addClass("text-on-select");
            $(".Masuk").children().removeClass("text-not-on-select");
            $(".Daftar").children().removeClass("text-on-select");
            $(".Daftar").children().addClass("text-not-on-select");
        });
        $(".eye-toggle").click(function(){
            $("#show_eye").toggleClass("d-none");
            $("#hide_eye").toggleClass("d-none");
            if($("#show_eye").hasClass("d-none")){
                $("#KataSandi").attr("type", "text");
            }else{
                $("#KataSandi").attr("type", "password");
            }
        });
        $(".eye-toggle2").click(function(){
            $("#show_eye2").toggleClass("d-none");
            $("#hide_eye2").toggleClass("d-none");
            if($("#show_eye2").hasClass("d-none")){
                $("#KataSandi2").attr("type", "text");
            }else{
                $("#KataSandi2").attr("type", "password");
            }
        });
        $(".Daftar").click(function(){
            $(".DaftarArea").removeClass("d-none");
            $(".MasukArea").addClass("d-none");
        });
        $(".Masuk").click(function(){
            $(".MasukArea").removeClass("d-none");
            $(".DaftarArea").addClass("d-none");
        });
    });
</script>
</html>