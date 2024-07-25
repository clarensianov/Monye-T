<style>
    .bg-yellow-header{
        background-color: #FEEE72;
        border-radius: 31px 0px 0px 0px;
        color: #43362B;
    }
</style>
    
<div class="modal fade" id="modalHapusAnggaran" aria-hidden="true"  tabindex="1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content p-0" style="margin-top: -50px; border-radius: 35px; box-shadow: 0 4px 4px 0 #ffffff42;">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="modal-title fs-5 bg-yellow-header" style="padding: 15px 50px;" id="exampleModalToggleLabel">Hapus Anggaran</h1>
              <button type="button" class="btn-close" style="margin-right: 30px;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex mt-3 justify-content-center">
                <div style="width: 90%;">
                    <label style="font-size: 18px;" for="NamaAnggaran" class="mb-3">Apakah Anda Yakin Ingin Menghapus Anggaran Ini?</label>
                </div>
            </div>
            <div class="d-flex justify-content-center gap-5 mt-3 p-3">
                <button type="button" class="btn " style="width: 200px; border-radius: 10px; background-color: #FEEE72;">Batal</button>
                <button type="button" class="btn btn-danger" style="width: 200px; border-radius: 10px;">Hapus</button>
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