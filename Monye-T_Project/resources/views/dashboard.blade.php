@extends('components.navbar')

@section('style')
<link rel="stylesheet" href="{{ asset('popup/popup.css') }}">
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .w-85 {
        width: 85%;
    }

    .historyCard {
        background-color: #D9D9D9;
        padding: 10px;
        height: 70px;
    }

    .dompetCard {
        width: 200px;
        height: 120px;
        border-radius: 8px;
        box-shadow: 0 4px 4px 0 #0000004f;
        flex-shrink: 0;
        cursor: pointer;
    }

    .LightYellow {
        background-color: #fbd4545b;
    }

    .YellowMore {
        background-color: #FBD354;
    }

    .dompetScroll {
        height: 145px;
        overflow-x: scroll;
        flex-shrink: 0;
    }

    .dompetScroll::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .dompetScroll::-webkit-scrollbar {
        height: 15px;
        background-color: #F5F5F5;
    }

    .dompetScroll::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #fbd4545b;
    }

    .graph {
        height: 300px;

        background-color: #000000;
    }

    body {
        background-color: #EEEEEE;
    }

    .boldFont {
        font-weight: 700;

    }

    .Dashboard {
        scale: 0.9
    }
</style>
@endsection

@section('content')


<!-- POPUP TAMBAH DOMPET -->
<div id="myPopup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <div class="header">
            <h1 class="header-title">Tambah Dompet</h1>
        </div>
        <form action="{{ route('input_dompet') }}" method="POST">
            @csrf
            <div class="field-group">
                <p class="TextField-title">Masukkan nama dompet barumu!</p>
                <input type="text" class="text-field" id="NamaDompet" name="namaDompet" placeholder="Nama Dompet Baru">
            </div>

            <div class="field-group">
                <p class="TextField-title">Masukkan saldo awal dompet barumu!</p>
                <div class="flex">
                    <span class="currency" aria-hidden="true">Rp</span>
                    <input type="text" class="text-field-saldo" id="SaldoAwal" name="saldoAwal" placeholder="Saldo Awal Dompet Baru"
                        name="saldoAwal">
                </div>
            </div>

            <div class="ButtonArea">
                <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- POPUP EDIT DOMPET -->
<div id="editPopUp" class="popup">
    <div class="popup-content">
        <span class="close" id="closeEdit">&times;</span>
        <div class="header">
            <h1 class="header-title">Edit Dompet</h1>
        </div>
        <form action="{{ route('edit_dompet') }}" method="POST">
            @csrf
            <input type="text" class="text-field" id="DompetID" name="DompetID" hidden>

            <div class="field-group">
                <p class="TextField-title">Nama Dompet</p>
                <input type="text" class="text-field" id="NamaDompetEdit" name="namaDompet" placeholder="Nama Dompet Baru" value="">
            </div>

            <div class="field-group">
                <p class="TextField-title">Saldo Dompet</p>
                <div class="flex">
                    <span class="currency" aria-hidden="true">Rp</span>
                    <input type="text" class="text-field-saldo" id="SaldoDompet" name="saldoDompet" placeholder="Saldo Dompet Baru"
                        name="saldoAwal">
                </div>
            </div>

            <div class="ButtonArea">
                <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button">Edit</button>
            </div>
        </form>
    </div>
</div>

<!-- Sebelum -->
<div class="Dashboard w-100 d-flex justify-content-center flex-column align-items-center">
    <div class="w-85 text-black ">
        <h2>Halo, {{ $user->username }}</h2>
        <h4>Apakah Kamu Sudah Mencatat Keuanganmu Hari ini?</h4>
    </div>
    <br>
    <br>
    <div class="w-85 text-black">
        <h3 class="boldFont">Dompet</h3>
        <div class="dompetScroll d-flex flex-row gap-5" style="margin-top: 30px;">

            {{-- Tambah Dompet --}}
            <a href="#myPopup" class="text-decoration-none text-black">
                <div class="addDompet  LightYellow dompetCard d-flex justify-content-center align-items-center"
                    id="tambahDompet">
                    <svg style="margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    <h2 class="mb-0">Dompet</h2>
                </div>
            </a>

            {{-- View Semua Dompet User --}}
            @foreach($dompetUser as $dompet)
                <a href="#" class="text-decoration-none text-black">
                    <div class="dompetList dompetCard YellowMore d-flex align-items-center p-3">
                        <div>
                            <h3 class="namaDompet" style="font-weight: 700;">{{ $dompet->nama_dompet }}</h3>
                            <h5 class="saldoDompet" style="font-weight: 400;" class="mt-3">Rp {{ $dompet->jumlah_uang }}</h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <br>
    <br>
    <div class="w-85 d-flex justify-content-between">
        <div class="w-50">
            <h3 class="boldFont">History</h3>
            <div class="historyCard w-85 mt-3">

            </div>
            <div class="historyCard w-85 mt-3">

            </div>
            <div class="historyCard w-85 mt-3">

            </div>
            <div class="historyCard w-85 mt-3">

            </div>
        </div>
        <div class="w-50">
            <div class="w-85">
                <div class="d-flex justify-content-between">
                    <h3 class="boldFont">Recap</h3>
                    <div class="dropdown">
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    </div>
                </div>

                <div class="graph mt-4">

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('/popup/popup.js') }}"></script>

<script>

    function showEditDompetPopUp(dompet_id, nama_dompet, jumlah_uang)
    {
        var edit_modal = document.getElementById("editPopUp");

        var txt_nama_dompet = document.getElementById("NamaDompetEdit");

        var txt_jumlah_uang = document.getElementById("SaldoDompet");

        var txt_dompet_id = document.getElementById("DompetID");

        txt_nama_dompet.value = nama_dompet;
        txt_jumlah_uang.value = jumlah_uang;
        txt_dompet_id.value = dompet_id;

        edit_modal.style.display = "block";

        // Ambil elemen <span> yang menutup modal
        var edit_span = document.getElementById("closeEdit");

        // Ketika <span> diklik, tutup modal
        edit_span.onclick = function() {
            edit_modal.style.display = "none";
        }

        // Ketika pengguna mengklik di luar modal, tutup modal
        window.onclick = function(event) {
            if (event.target == edit_modal) {
                edit_modal.style.display = "none";
            }
        }
    }
</script>
@endsection
