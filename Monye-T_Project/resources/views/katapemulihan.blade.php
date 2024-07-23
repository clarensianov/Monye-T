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
</style>
<body>    
    <div class="w-100 vh-100 Yellow d-flex justify-content-center align-items-center">
        <div class=" w-75 bg-swhite container-field corner-radius d-flex align-items-center">            
            <div class="w-100 h-100">
                <div class="row h-100 ">
                    <div class="col-5 d-flex align-items-center bg-warning justify-content-center" style="border-radius: 30px 0 0 30px;">
                        <h1 class="text-white">Belum Ada Ide</h1>
                    </div>
                    <div class="col h-85">
                        <div class=" flex-column d-flex justify-content-center align-items-center h-100 w-100">
                            <h1 class="text-sblack font-weight-bold">Logo</h1>
                            <h2 class="mt-5">Buat Kata Pemulihan Anda!</h2>
                            <p>Autentikasi Untuk Mengganti Kata Sandi Anda</p>
                            <div class="w-65">            
                                <form action="{{ route('create_katapemulihan', auth()->user()->user_id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-3 d-flex flex-column mt-3">
                                        <label for="KataPemulihan">Kata Pemulihan</label>
                                        <div class="password-box d-flex">
                                            <input type="password" class="mt-2 p-2-5 form-control" id="KataPemulihan" placeholder="Masukkan kata pemulihan" name="katapemulihan">
                                            <div class="w-10 mt-2 d-flex justify-content-center align-items-center eye-button eye-toggle">
                                                <i class="fa fa-eye" id="show_eye"></i>
                                                <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                                            </div>
                                        </div>
                                        <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="mt-5 yellow-button border-0 w-100 mt-3 text-brown font-weight-700 button-layout" onclick="finishSubmit()">Selesai</button>

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
        $(".eye-toggle").click(function(){
            $("#show_eye").toggleClass("d-none");
            $("#hide_eye").toggleClass("d-none");
            var input = $("#KataPemulihan");
            if(input.attr("type") == "password"){
                input.attr("type", "text");
            }else{
                input.attr("type", "password");
            }
        });
    });
</script>
</html>