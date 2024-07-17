@extends('components.navbar')

@section('style')

<!-- Bootstrap Date Picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    .cardTransaksi{
        width: 300px;
        height: 150px;
        border-radius: 8px;
        box-shadow: 0 2px 5px 0 #0000004f;
        flex-shrink: 0;
    }
    .cardPemasukan{
        background-color: #6ccccc1f;
        background: url("../Assets/Transaksi/CardPemasukan.png") border-box no-repeat;
        background-size: cover;
    }
    .cardPengeluaran{
        background: url("../Assets/Transaksi/CardPengeluaran.png") border-box no-repeat;
        background-size: cover;
    }
    .text-transaksi{
        font-size: 18px;
    }
    .input-tanggal{
        font-weight: 600;
        border-radius:6px 0 0 6px;
        border: 0.3px solid #838282;
        background-color: #FEEE72;
        border-right: 0;
        width: 200px;
    }
    .input-tanggal::placeholder{
        color: #222222;
    }
    .calendar-logo{
        border-radius: 0 6px 6px 0;
        border: 0.3px solid #838282;
        border-left: 0;
        background-color: #FEEE72;
    }
    .selectdown{
        width: 150px;
    }
    .rowTitle{
        background-color: #ffec5ed9;
        height: 60px;
        border-radius: 10.37px;
        box-shadow: 0 4.61px 4.61px 0 rgba(0, 0, 0, 0.25);
    }
    .columnTitle{
        border-right: 1.15px solid rgba(0, 0, 0, 0.25);
        font-weight: 600;
        color: #43362B;
    }
    .itemRow{
        background-color: #FFFFFF;
        height: 60px;
        border-radius: 10.37px;
    }
    .columnItem{
        border-right: 1.15px solid rgba(0, 0, 0, 0.25);
        font-weight: 400;
        color: #000000;
    }
    .tipe-pemasukan{
        background-color: #64cd76e0;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 500;
        color: #24572F;
    }
    .tipe-pengeluaran{
        background-color: #FF8D8D;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 500;
        scale: 0.93;
        color: #24572F;
    }

    .scrollItem{
        height: 270px;
        overflow-y: scroll;
    }

    .scrollItem::-webkit-scrollbar{
        display: none;
    }
</style>
@endsection
@section('content')
    <div class="w-100 d-flex mt-4 flex-column align-items-center">
        <div class="w-85 text-black ">
            <h2>Transaksi</h2>
        </div>
        <hr style="width:100%; height: 2px; z-index: -3; background-color: #0000004a;">
        <div class="text-black" style="width:73%;">
            <div class="d-flex" style="gap: 70px;">
                <div class="cardTransaksi d-flex flex-column cardPemasukan">
                    <div class="d-flex gap-3 px-4 py-3 mt-1 align-items-center">
                        <img width="35" height="35" src="../Assets/Transaksi/Arrow_top.png" alt="">
                        <h5 class="m-0 text-transaksi">Total Pemasukan</h5>
                    </div>
                    <div>
                        <h2 style="font-weight: 700 ; font-size: 36px; margin-left: 25px; margin-top: 6px;" class="w-100">Rp. 2.000.000</h2>
                    </div>
                </div>
                <div class="cardTransaksi cardPengeluaran">
                    <div class="d-flex gap-3 px-4 py-3 mt-1 align-items-center">
                        <img width="35" height="35" src="../Assets/Transaksi/Arrow_down.png" alt="">
                        <h5 class="m-0 text-transaksi">Total Pengeluaran</h5>
                    </div>
                    <div>
                        <h2 style="font-weight: 700 ; font-size: 36px; margin-left: 25px; margin-top: 6px;" class="w-100">Rp. 1.000.000</h2>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="d-flex justify-content-between">
                <div class="d-flex gap-3">
                    <div>
                        <p class="mb-1" style="color: #0000008e; font-weight: 600;">Dari</p>
                        <div class="d-flex flex-row">
                            <input placeholder="Dari Tanggal" class="p-2 input-tanggal" type="text" id="fromdate">
                            <span class="input-group-append">
                                <span class="calendar-logo input-group-text h-100 d-block">
                                <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                    <div>
                        <p class="mb-1" style="color: #0000008e; font-weight: 600;">Sampai</p>
                        <div class="d-flex flex-row">
                            <input placeholder="Sampai Tanggal" class="p-2 input-tanggal" type="text" id="todate">
                            <span class="input-group-append">
                                <span class="calendar-logo input-group-text h-100 d-block">
                                <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row gap-3 align-items-end">
                    <div>
                        <select class="form-select selectdown" aria-label="Default select example">
                            <option selected>Dompet</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <select class="form-select selectdown" aria-label="Default select example">
                            <option selected>Kategori</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <select class="form-select selectdown" aria-label="Default select example">
                            <option selected>Status</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="rowTitle d-flex flex-row justify-content-between">
                <div class="columnTitle d-flex align-items-center justify-content-center w-100">
                    Tanggal
                </div>
                <div class="columnTitle d-flex align-items-center justify-content-center w-100">
                    Dompet
                </div>
                <div class="columnTitle d-flex align-items-center justify-content-center w-100">
                    Kategori
                </div>
                <div class="columnTitle d-flex align-items-center justify-content-center" style="width: 150%;">
                    Deskripsi
                </div>
                <div class="columnTitle d-flex align-items-center justify-content-center w-100">
                    Status
                </div>
                <div style="font-weight: 600;" class="d-flex align-items-center justify-content-center w-100">
                    Jumlah
                </div>
            </div>

            <div class="scrollItem mt-1">
                @php
                    $dompets = $user->dompets;
                @endphp

                @foreach($pencatatans as $pencatatan)
                    <div class="itemRow mt-2 d-flex flex-row justify-content-between">
                        <div class="columnItem d-flex align-items-center justify-content-center w-100">
                            {{ $pencatatan->tanggal }}
                        </div>
                        <div class="columnItem d-flex align-items-center justify-content-center w-100">
                            @php
                                $dompet = App\Models\Dompet::findOrFail($pencatatan->kantung_id);
                                // dd($dompet);
                            @endphp
                            {{ $dompet->nama_dompet }}
                        </div>
                        <div class="columnItem d-flex align-items-center justify-content-center w-100">
                            <i class="fa fa-suitcase m-2"></i>
                            @php
                                $kategori = App\Models\Kategori::findOrFail($pencatatan->kategori_id);
                                // $kategori = App\Models\Kategori::all();
                            @endphp
                            {{ $kategori->nama_kategori }}
                        </div>
                        <div class="columnItem d-flex align-items-center justify-content-center" style="width: 150%;">
                            <p class="descLimit w-85 text-center m-0">{{ $pencatatan->deskripsi }}</p>
                        </div>
                        <div class="columnItem d-flex align-items-center justify-content-center w-100">
                            <div class="tipe-pemasukan">
                                {{ $pencatatan->status }}
                            </div>
                        </div>
                        <div style="font-weight:600;" class="d-flex align-items-center justify-content-center w-100">
                            Rp {{ $pencatatan->jumlah }}
                        </div>
                    </div>
                @endforeach

                {{-- <div class="itemRow mt-2 d-flex flex-row justify-content-between">
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        29 Juni 2024
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        Blu
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <i class="fa fa-suitcase m-2"></i>
                        Liburan
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center" style="width: 150%;">
                        <p class="descLimit w-85 text-center m-0">Ini Kemarin pengeluaran liburan di jogja</p>
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <div class="tipe-pengeluaran">
                            Pengeluaran
                        </div>
                    </div>
                    <div style="font-weight:600;" class="d-flex align-items-center justify-content-center w-100">
                        Rp. 500.000
                    </div>
                </div>

                <div class="itemRow mt-2 d-flex flex-row justify-content-between">
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        29 Juni 2024
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        Blu
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <i class="fa fa-suitcase m-2"></i>
                        Liburan
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center" style="width: 150%;">
                        <p class="descLimit w-85 text-center m-0">Ini Kemarin pengeluaran liburan di jogja</p>
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <div class="tipe-pengeluaran">
                            Pengeluaran
                        </div>
                    </div>
                    <div style="font-weight:600;" class="d-flex align-items-center justify-content-center w-100">
                        Rp. 500.000
                    </div>
                </div>

                <div class="itemRow mt-2 d-flex flex-row justify-content-between">
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        29 Juni 2024
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        Blu
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <i class="fa fa-suitcase m-2"></i>
                        Liburan
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center" style="width: 150%;">
                        <p class="descLimit w-85 text-center m-0">Ini Kemarin pengeluaran liburan di jogja</p>
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <div class="tipe-pengeluaran">
                            Pengeluaran
                        </div>
                    </div>
                    <div style="font-weight:600;" class="d-flex align-items-center justify-content-center w-100">
                        Rp. 500.000
                    </div>
                </div>

                <div class="itemRow mt-2 d-flex flex-row justify-content-between">
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        29 Juni 2024
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        Blu
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <i class="fa fa-suitcase m-2"></i>
                        Liburan
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center" style="width: 150%;">
                        <p class="descLimit w-85 text-center m-0">Ini Kemarin pengeluaran liburan di jogja</p>
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <div class="tipe-pengeluaran">
                            Pengeluaran
                        </div>
                    </div>
                    <div style="font-weight:600;" class="d-flex align-items-center justify-content-center w-100">
                        Rp. 500.000
                    </div>
                </div>

                <div class="itemRow mt-2 d-flex flex-row justify-content-between">
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        29 Juni 2024
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        Blu
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <i class="fa fa-suitcase m-2"></i>
                        Liburan
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center" style="width: 150%;">
                        <p class="descLimit w-85 text-center m-0">Ini Kemarin pengeluaran liburan di jogja</p>
                    </div>
                    <div class="columnItem d-flex align-items-center justify-content-center w-100">
                        <div class="tipe-pengeluaran">
                            Pengeluaran
                        </div>
                    </div>
                    <div style="font-weight:600;" class="d-flex align-items-center justify-content-center w-100">
                        Rp. 500.000
                    </div>
                </div>
            </div> --}}
        </div>
        <br>
        <br>

    </div>
@endsection

@section('script')
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

<script>
    $(".descLimit").each(function(){
        console.log($(this).text());
        if($(this).text().length > 30){
            $(this).text($(this).text().substr(0, 30) + "...");
        }
    });
    $(".input-group-append").click(function(){
        $(this).prev().focus();
    });

    $.fn.datepicker.dates['in'] = {
        days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        today: "Hari Ini",
        clear: "Bersihkan",
        format: "dd MM yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    };

    // Show only day for selected month
    $('#fromdate').datepicker({
        format: "dd MM yyyy",
        todayHighlight: true,
        autoclose: true,
        clearBtn: true,
        language: "in-IN",
        endDate: new Date(),
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#todate').datepicker('setStartDate', minDate);
    });
    $('#todate').datepicker({
        format: "dd MM yyyy",
        todayHighlight: true,
        autoclose: true,
        clearBtn: true,
        language: "in-IN",
        endDate: new Date(),
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#fromdate').datepicker('setEndDate', maxDate);
    });
</script>
@endsection
