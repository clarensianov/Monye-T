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
    .Gambar-BG{
        background-image: url("../assets/Login/WelcomeImage.png");
        background-size: cover;
        background-position: center;
    }
</style>
<body>
    <div class="w-100 vh-100 Yellow d-flex justify-content-center align-items-center">
        <div class=" w-75 bg-swhite container-field corner-radius d-flex align-items-center">
            <div class="w-100 h-100">
                <div class="row h-100 ">
                    <div class="Gambar-BG col-5 d-flex align-items-center justify-content-center" style="border-radius: 30px 0 0 30px; height: 100%;">

                    </div>
                    <div class="col">
                        <div class=" flex-column d-flex justify-content-center align-items-center h-100 w-100">
                            <div class="d-flex justify-content-center align-items-center">
                                <img width="60" src="{{ asset('../assets/navbar/logo_monyet.png') }}" alt="">
                                <h1 class="text-sblack font-weight-bold" style="margin-left: 15px; margin-top: 20px">Monye-T</h1>
                            </div>
                            <h2 class="mt-5">Lupa Kata Sandi?</h2>
                            <p>Jangan Khawatir! Kami akan membantu anda</p>
                            <div class="w-65">
                                <form action="/lupasandi" method="POST">
                                    @csrf
                                    <div class="form-1 d-flex flex-column mt-2">
                                        <label for="Email" class="font-14">Email</label>
                                        <input type="email" class="p-2-5 form-control" id="Email" placeholder="Masukkan email yang terdaftar" name="email" value="{{ Session::get('email') }}">
                                        <div class="d-flex flex-row">
                                            &nbsp;
                                            @error('email')
                                                <span class="text-danger"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-2 d-none d-flex flex-column mt-3">
                                        <div class="d-flex flex-column mt-3">
                                            <label for="Kata Pemulihan">Kata Pemulihan</label>
                                            <div class="d-flex flex-row align-items-center password-box w-100">
                                                <input type="password" class="p-2-5 form-control" id="KataPemulihan" placeholder="Masukkan kata pemulihan anda" name="katapemulihan">
                                                <div class="eye-toggle2 w-10 d-flex mx-1 justify-content-center align-items-center eye-button">
                                                    <i class="fas fa-eye" id="show_eye2"></i>
                                                    <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row">
                                                &nbsp;
                                                @error('katapemulihan')
                                                    <span class="text-danger"> {{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
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
                                    </div>


                                    <!-- <div class="d-flex flex-row gap-2 mt-2">
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-serror m-0" style="font-weight: 500;">Email/Username Anda Sudah Terdaftar!</p>
                                        </div>
                                    </div>  -->

                                    <div>
                                        @if(session('error'))
                                            <div class="d-flex flex-row gap-2 mt-2">
                                            <div class="d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-danger m-0" style="font-weight: 500;">{{ session('error') }}</p>
                                            </div>
                                        </div>
                                        @endif
                                        <div style="box-shadow: 0 2px 2px 0 #00000025;" class="NextButton become-pointer d-flex align-items-center justify-content-center yellow-button border-0 w-100 mt-3 text-brown font-weight-700 button-layout">Selanjutnya</div>
                                        <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="d-none yellow-button border-0 w-100 mt-3 text-brown font-weight-700 button-layout">Check</button>
                                        <div class="BackButton become-pointer d-flex flex-row gap-2 align-items-center mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#00000065" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                                            </svg>
                                            <a href="/login" style="color: #00000065; font-weight:500;" class="text-decoration-none backtologin m-0">Kembali</a>
                                            <p style="color: #00000065; font-weight:500;" class="d-none mincounter m-0">Kembali</p>
                                        </div>
                                    </div>
                                </form>
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
        $(".eye-toggle2").click(function(){
            $("#show_eye2").toggleClass("d-none");
            $("#hide_eye2").toggleClass("d-none");
            var input = $("#KataPemulihan");
            if(input.attr("type") == "password"){
                input.attr("type", "text");
            }else{
                input.attr("type", "password");
            }
        });
        var counter = 1;

        $(".NextButton").click(function(){
            if(counter == 1){
                $(".form-1").addClass("d-none");
                $(".form-2").removeClass("d-none");
                $(".NextButton").addClass("d-none");
                $("button[type='submit']").removeClass("d-none");
                $(".backtologin").addClass("d-none");
                $(".mincounter").removeClass("d-none");
                counter++;
            }
        });
        $(".BackButton").click(function(){
            if(counter == 2){
                $(".form-1").removeClass("d-none");
                $(".form-2").addClass("d-none");
                $(".NextButton").removeClass("d-none");
                $("button[type='submit']").addClass("d-none");
                $(".backtologin").removeClass("d-none");
                $(".mincounter").addClass("d-none");
                counter--;
            }
        });
    });

</script>
</html>
