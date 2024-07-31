<style>
    .bg-yellow-header{
        background-color: #FEEE72;
        border-radius: 31px 0px 0px 0px;
        color: #43362B;
    }
    .input-tanggal{
        font-weight: 600;
        border-radius:6px 0 0 6px;
        border: 0.3px solid #dee2e6;
        border-right: 0;
        width: 200px;
    }
    .input-tanggal::placeholder{
        color: #222222;
    }
    .calendar-logo{
        border-radius: 0 6px 6px 0;
        border: 2px solid #dee2e6;
        border-left: 0;
        background: white;
    }
    .Rupiah{
        font-weight: 600;
        border-radius:6px 0 0 6px;
        border: 2px solid #dee2e6;
        border-right: 0;
        background: white;
        width: 50px;
    }
    .inputNumber{
        font-weight: 600;
        border-radius:0 6px 6px 0;
        border: 2px solid #dee2e6;
        border-left: 0;
        width: 200px;
    }
    .border-dropdown{
        border: 2px solid #dee2e6;
        border-radius: 6px;
        background: white;
    }
    .border-dropdown:hover{
        border: 2px solid #222222;
    }
</style>
    
<div class="modal fade" id="modalEditAnggaran" aria-hidden="true"  tabindex="1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content p-0" style="margin-top: -50px; border-radius: 35px; box-shadow: 0 4px 4px 0 #ffffff42;">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="modal-title fs-5 bg-yellow-header" style="padding: 15px 50px;" id="exampleModalToggleLabel">Edit Anggaran</h1>
              <button type="button" class="btn-close" style="margin-right: 30px;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex mt-3">
                <form action="{{ route('anggaran.edit') }}" class="w-100 d-flex flex-column w-100 align-items-center" method="POST">
                    @method('PUT')
                    @csrf                    
                <div class="" style="width: 90%;">
                    <label style="font-size: 18px;" for="NamaAnggaran" class="mb-3">Masukkan Nama Anggaran</label>
                    <input name="NamaAnggaran" type="text" class="w-100 px-3 py-2 border border-2" style="border-radius: 10px;" placeholder={{ $budget->nama_budget }}>
                </div>
                <div class="" style="width: 90%;">
                    <label style="font-size: 18px;" for="NamaAnggaran" class="mb-3 mt-3">Masukkan saldo untuk anggaranmu</label>
                    <div class="d-flex">
                        <span class="input-group-append">
                            <span class="input-group-text Rupiah h-100 d-block">
                                Rp
                            </span>
                        </span>
                        <input class="w-100 px-3 py-2 inputNumber" type="number" name="saldo" placeholder={{ $budget->jumlah }}>
                    </div>
                </div>
                @if ($budget->tx_status == 0)
                    @php                                            
                        $budgets = App\Models\User::find(auth()->user()->user_id)->budgets;
                        $kategoris = App\Models\User::find(auth()->user()->user_id)->kategoris;
                    @endphp
                    <div class="" style="width: 90%;">
                        <label style="font-size: 18px;" for="NamaAnggaran" class="mb-3 mt-3">Pilih kategori untuk anggaran!</label>
                        <select class="form-select px-3 py-2 border-dropdown" aria-label="Default select example" name="kategori">
                            <option selected value="">Open this select menu</option>
                            @foreach ($kategoris as $kategori)
                                @php
                                    $cekKategori = 1;
                                @endphp
                                @foreach ($budgets as $budget)
                                    @if ($budget->kategoris_id == $kategori->kategori_id && $budget->status == 0)
                                        @php
                                            $cekKategori = 0;
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($cekKategori == 1)
                                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->nama_kategori }}</option>
                                @endif
                            @endforeach
                        </select>                      
                    </div>
                @endif
                <div style="width: 90%;" class="mt-3 d-flex flex-column justify-content-between">
                    <label style="font-size: 18px;">Pilih Jangka waktu Anggaranmu!</label>
                    <div class="d-flex w-100 justify-content-between">
                        {{-- <div class="" style="width: 100%;">
                            <div class="d-flex flex-column w-100 justify-content-end">
                                <label for="" style="font-size: 15px;">Mulai</label>
                                <div class="d-flex">
                                    <input style="width: 85%;" class="px-3 py-2 input-tanggal" type="date" id="fromdate" placeholder={{ $budget->tanggal_pembuatan }}>
                                    <span class="input-group-append">
                                        <span class="calendar-logo input-group-text h-100 d-block">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                        <div class="" style="width: 100%;">
                            <div class="d-flex flex-column w-100 justify-content-end">
                                <label for="" style="font-size: 15px;">Berakhir</label>
                                <div class="d-flex">
                                    <input style="width: 85%;" class="px-3 py-2 input-tanggal" type="date" id="todate" name="tanggal_berakhir">
                                    <span class="input-group-append">
                                        <span class="calendar-logo input-group-text h-100 d-block">
                                        <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="width: 90%; margin: 20px 0" class="d-flex flex-column align-items-center">
                        <div class="d-flex flex-row gap-2 mt-2 mb-3">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EC0D0D" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="m-0" style="font-weight: 500; color: #EC0D0D;">Email/Username Anda Sudah Terdaftar!</p>
                            </div>
                        </div>
                        <button type="submit" name="budget_id" value="{{ $budget->budget_id }}" class="btn" style="padding: 15px 100px; background-color: #FEEE72; font-weight:600;">Ubah</button>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>
</div>
    
<script>
    document.querySelector('.buttonAddKategori').addEventListener('click', function() {
            console.log("tes");
    });
    $(".input-group-append").click(function(){
        $(this).prev().focus();
    });
    $.fn.datepicker.dates['in'] = {
        days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        daysMin: ["S", "M", "T", "W", "T", "F", "S"],
        months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        today: "Hari Ini",
        clear: "Bersihkan",
        format: "dd MM yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    };

    $('#fromdate').datepicker({
        format: "dd MM yyyy",
        todayHighlight: true,
        autoclose: true,
        clearBtn: true,
        language: "in-IN",
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
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#fromdate').datepicker('setEndDate', maxDate);
    });
</script>