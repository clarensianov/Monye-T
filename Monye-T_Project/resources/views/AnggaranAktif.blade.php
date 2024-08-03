@extends('components.navbar')

@section('style')
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .w-85{
        width: 85%;
    }
    body{
        background-color: #FDFCF7;
        font-family: 'Inter', sans-serif;
    }
    .bg-yellow-light{
        background-color: #feee725f;
    }
    .searchbar{
        margin-bottom: auto;
        margin-top: auto;
        height: 60px;
        background-color: #d9d9d95b;
        border-radius: 30px;
        padding: 10px;
        border: 1px solid #0000006b;
    }

    .searchbar:hover{
        background-color: #d9d9d9;
    }

    .searchbar:hover > .search_input::placeholder{
        color: #222222;
    }

    .search_input{
        color: #222222;
        border: 0;
        outline: 0;
        background: none;
        width: 450px;
        caret-color:transparent;
        line-height: 40px;
        transition: width 0.4s linear;
    }

    .search_icon{
        height: 40px;
        width: 40px;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        color:#222222;
        text-decoration:none;
    }
    .CardAnggaran{
        height: 200px;
        width: 350px;
        border-radius: 20px;
        border: 1px solid #0000003f;
        box-shadow: 0px 4px 4px 0px #0000003f;
    }
    .borderTanggal{
        border: 1px solid #43362B;
        padding: 2px 5px;
        border-radius: 5px;
        font-weight: 600;
    }
    .tanggalStart{
        background-color: #8db3b960;
    }
    .tanggalEnd{
        background-color: #ff00002f;
    }
    .text-yellow-terpakai{
        color: #FBD354;
    }
    .paginationBox{
        padding: 1px 4px;
    }
    .paginationText{
        color: #0000007f;
    }
    .paginationNotActive{
        border-radius: 10px;
        border: 1px solid #0000007f;
    }
    .paginationActive{
        background-color: #FEEE72;
        color: #000000;
        box-shadow: 0px 4px 4px 0px #0000003f;
        border-radius: 10px;

    }
</style>
@endsection

@section('content')
    <div class="w-100 d-flex flex-column align-items-center">
        <div class="w-85 mt-4 text-black ">
            <h2>Anggaran Aktif</h2>
        </div>
        <hr style="width:100%; height: 2px; z-index: -3; background-color: #0000004a;">
        <div class="text-black" style="width: 76%;">
            <div class="mt-4 d-flex justify-content-between w-75">
                <div style="border-radius: 10px;" class="d-flex align-items-center bg-yellow-light px-2 py-2 ">
                    <a style="width: 140px; border-radius: 5px; font-weight: 700;"  class="px-3 py-2 bg-warning d-flex justify-content-center text-black text-decoration-none">
                        Aktif
                    </a>
                    <a style="width: 140px; border-radius: 5px; font-weight: 700;" href="{{route('anggaran.nonIndex')}}" class="px-3 py-2 d-flex justify-content-center text-black text-decoration-none">
                        Tidak Aktif
                    </a>
                </div>
                <form class="d-flex" role="search">
                    <div class="searchbar">
                        <input class="search_input" type="text" name="" placeholder="Cari Anggaran..">
                        <button href="#" class="btn search_icon"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @php
            $budgets = App\Models\User::find(auth()->user()->user_id)->budgets;
            $cek = 0;
        @endphp
        <div class="text-black mt-4 d-flex flex-wrap" style="width: 76%; height:500px; column-gap: 50px; row-gap:50px;">
            @foreach ($budgets as $budget)
                @if ($budget->status == 0 && $budget->kategoris_id != null)
                    @php
                        $cek = 1;
                    @endphp
                    <div class="bg-white CardAnggaran">
                        <div class="d-flex align-items-center w-100 justify-content-evenly mt-3">
                            <div>
                                <img width="50" src="../Assets/Anggaran/Kategori.png" alt="">
                            </div>
                            <div>
                                <div class="d-flex flex-column">
                                    <h4>{{ $budget->nama_budget }}</h4>
                                    <div>
                                        <div>
                                            <i class="bi bi-calendar-week"></i>
                                            <span class="borderTanggal tanggalStart">{{ $budget->tanggal_pembuatan }}</span>
                                            <i class="bi bi-arrow-right"></i>
                                            <span class="borderTanggal tanggalEnd">{{ $budget->tanggal_berakhir }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex w-100 justify-content-between px-4">
                            <div class="w-50" style="margin-left: 10px;">
                                <p class="m-0 w-50" style="font-weight: 600;">Terpakai</p>
                                <p class="text-yellow-terpakai" style="font-weight: 600;">{{ $budget->digunakan }}</p>
                            </div>
                            <div class="w-50" style="margin-left:35px;">
                                <p class="m-0" style="font-weight: 600;">Dari</p>
                                <p style="font-weight: 600;">{{ $budget->jumlah }}</p>
                            </div>
                        </div>
                        <div class="w-100 d-flex" style="border-top: 1px solid #00000055; height: 42px;">
                            <a onclick="tampilkanPopupEdit('{{ $budget->budget_id }}')" class="w-50 d-flex align-items-center justify-content-center h-100" style="border-right: 1px solid #00000055;">
                                <i class="text-black bi bi-pencil"></i>
                            </a>
                            <a onclick="tampilkanPopupHapus('{{ $budget->budget_id }}')" class="w-50 d-flex align-items-center justify-content-center h-100">
                                <i class="text-black bi bi-trash3"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- @if ($cek == 0)
                <p>tidak ada anggaran</p>
            @endif       -->
            <a class="bg-white CardAnggaran CardTambah" onclick="ModalAnggaran()">
                <div class="d-flex align-items-center w-100 h-100 justify-content-evenly">
                    <i style="font-size: 120px; color:#5BBA6F;" class="bi bi-plus"></i>
                </div>
            </a>
        </div>

        <div class="text-black mt-4 d-flex flex-wrap justify-content-end" style="width: 76%; column-gap: 100px; row-gap:50px;">
            <nav aria-label="Page navigation example">
                <ul class="pagination gap-3">
                  <li class="page-item">
                    <a class="page-link border-0 paginationText" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link paginationActive" href="#">1</a></li>
                  <li class="page-item"><a class="page-link paginationNotActive paginationText" href="#">2</a></li>
                  <li class="page-item"><a class="page-link paginationNotActive paginationText" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link border-0 paginationText" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
        </div>

<div class="position-absolute" style="z-index: 1000000;">
    @include('popupEditAnggaran')
    @include('popupHapusAnggaran')
</div>

@endsection

@section('script')
<script>
    $(".search_input").on("click", function(){
        $(this).attr("placeholder", "");
        $(this).css("caret-color", "#222222");
    });
    $(document).on("click", function(e){
        if(!$(e.target).is(".search_input")){
            $(".search_input").attr("placeholder", "Cari Anggaran..");
            $(".search_input").css("caret-color", "transparent");
        }
    });

    document.getElementById("btn_batal").addEventListener("click", function () {
        $('#modalHapusAnggaranTransaksi').modal('hide');
    });

    function ModalAnggaran(){
        $('#exampleModalToggle').modal('show');
    }

    function tampilkanPopupEdit(budgetId){
        $.ajax({
            url: `/budget/${budgetId}/edit`,
            type: 'GET',
            success: function(data) {
                // Mengakses budget dan kategori dari array numerik
                var budget = data[0];
                var kategori = data[1];

                // Isi modal dengan data yang diperoleh
                $('#modalEditAnggaran').find('input[name="NamaAnggaran"]').val(budget.nama_budget);
                $('#modalEditAnggaran').find('input[name="saldo"]').val(budget.jumlah);
                document.getElementById('kategori-now').innerText = "Kategori saat ini: " + kategori.nama_kategori + " - Terpilih dari dropdown";
                $('#modalEditAnggaran').find('input[name="budget_id"]').val(budget.budget_id);

                // Periksa nilai tx_status dari budget
                if (budget.tx_status == 0) {
                    // Tampilkan elemen tertentu jika tx_status == 0
                    $('#modalEditAnggaran').find('.element-specific-to-status-0').show();
                } else {
                    // Sembunyikan elemen tersebut jika tx_status != 0
                    $('#modalEditAnggaran').find('.element-specific-to-status-0').hide();
                }
                $('#modalEditAnggaran').modal('show');
            },
            error: function(err) {
                console.error(err);
                alert('Terjadi kesalahan saat mengambil data anggaran');
            }
        });
    }

    function tampilkanPopupHapus(dor){
        document.getElementById('budgetId').value = dor;
        document.getElementById('form_hapus_anggaran_transaksi').action = '{{route("anggaran.destroy")}}';
        $('#modalHapusAnggaranTransaksi').modal('show');
    }

    document.querySelector('.AnggaranIcon').classList.add('active');
</script>
@endsection
