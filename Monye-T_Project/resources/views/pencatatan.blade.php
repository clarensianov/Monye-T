@extends('components.navbar')

@section('style')

<!-- Bootstrap Date Picker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link  href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" rel="stylesheet">
<link  href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">

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

    /* Update Style untuk menyesuaikan Data Tables */
    /* Kalau g gini, stylenya ngikut class bootstrap table dan gbs diotak-atik */
    .table tr{
        /* background-color: #ffec5ed9; */
        height: 60px;
        border-radius: 10.37px;
        box-shadow: 0 4.61px 4.61px 0 rgba(0, 0, 0, 0.25);
    }
    .table th{
        background-color: #ffec5ed9;
        border-right: 1.15px solid rgba(0, 0, 0, 0.25);
        font-weight: 600;
        color: #43362B;
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
                        <h2 style="font-weight: 700 ; font-size: 36px; margin-left: 25px; margin-top: 6px;" class="w-100" id="total_pemasukan"></h2>
                    </div>
                </div>
                <div class="cardTransaksi cardPengeluaran">
                    <div class="d-flex gap-3 px-4 py-3 mt-1 align-items-center">
                        <img width="35" height="35" src="../Assets/Transaksi/Arrow_down.png" alt="">
                        <h5 class="m-0 text-transaksi">Total Pengeluaran</h5>
                    </div>
                    <div>
                        <h2 style="font-weight: 700 ; font-size: 36px; margin-left: 25px; margin-top: 6px;" class="w-100" id="total_pengeluaran"></h2>
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
                            <input placeholder="Dari Tanggal" class="p-2 input-tanggal" type="text" id="DariTanggal">
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
                            <input placeholder="Sampai Tanggal" class="p-2 input-tanggal" type="text" id="SampeTanggal">
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
                        <select class="form-select selectdown" aria-label="Default select example" id="dompet_filter">
                            <option selected>Dompet</option>
                            @foreach (auth()->user()->dompets as $dompet)
                                <option value={{ $dompet->dompet_id }}>{{ $dompet->nama_dompet }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select class="form-select selectdown" aria-label="Default select example" id="kategori_filter">
                            <option selected>Kategori</option>
                            @foreach (auth()->user()->kategoris as $kategori)
                                <option value={{ $kategori->kategori_id }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select class="form-select selectdown" aria-label="Default select example" id="status_filter">
                            <option selected>Status</option>
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <button id="button" onclick="resetForm()">Reset Filter</button>
                </div>
            </div>
            <br>

            {{-- Data Tables --}}
            <table id="tbl_list" class="table table-striped table-bordered d-flex flex-column" cellspacing="0" width="100%">
                <thead class="md-2">
                    <tr class="rowTitle d-flex flex-row justify-content-between">
                        <th class="columnTitle d-flex align-items-center justify-content-center w-100">Tanggal</th>
                        <th class="columnTitle d-flex align-items-center justify-content-center w-100">Dompet</th>
                        <th class="columnTitle d-flex align-items-center justify-content-center w-100">Kategori</th>
                        <th class="columnTitle d-flex align-items-center justify-content-center w-100">Deskripsi</th>
                        <th class="columnTitle d-flex align-items-center justify-content-center w-100">Status</th>
                        <th class="columnTitle d-flex align-items-center justify-content-center w-100">Jumlah</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <br>
            <br>
        </div>
    </div>

    @include('popup_Transaksi')

    <div class="position-absolute" style="z-index: 1000000;">
        @include('PopupHapusAnggaran')
    </div>

@endsection

@section('script')

{{-- Data Table AJAX Requirements --}}
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>

<script>
$(".descLimit").each(function(){
        // console.log($(this).text());
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
        // format: "dd MM yyyy",
        // format: "dd MM yyyy",
        titleFormat: "MM yyyy",
        weekStart: 0
    };

    // Show only day for selected month
    $('#DariTanggal').datepicker({
        // format: "dd MM yyyy",
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        clearBtn: true,
        language: "in-IN",
        endDate: new Date(),
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        minDate = moment(minDate).format('YYYY-MM-DD');
        $('#DariTanggal').val(minDate);
        $('#SampeTanggal').datepicker('setStartDate', minDate);
    });

    $('#SampeTanggal').datepicker({
        // format: "dd MM yyyy",
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        clearBtn: true,
        language: "in-IN",
        endDate: new Date(),
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        maxDate = moment(maxDate).format('YYYY-MM-DD');
        $('#SampeTanggal').val(maxDate);
        $('#DariTanggal').datepicker('setEndDate', maxDate);
    });

// Data Tables
 $(document).ready(function() {
        var dompet_filter = $('#dompet_filter').val();
        var kategori_filter = $('#kategori_filter').val();
        var status_filter = $('#status_filter').val();

        // Initialize DataTable
        var table = $('#tbl_list').DataTable({
            dom: 'lrtip',
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pencatatan.data') }}", // Route for fetching data
                type: 'POST', // Use POST method for DataTables server-side processing
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function(d) {
                    d.fromdate = $('#DariTanggal').val();
                    d.todate = $('#SampeTanggal').val();
                    d.dompet_filter = $('#dompet_filter').val();
                    d.kategori_filter = $('#kategori_filter').val();
                    d.status_filter = $('#status_filter').val();
                }
            },
            columns: [
                { data: 'tanggal', name: 'tanggal' },
                { data: 'nama_dompet', name: 'nama_dompet' },
                { data: 'nama_kategori', name: 'nama_kategori' },
                { data: 'deskripsi', name: 'deskripsi' },
                { data: 'status', name: 'status' },
                { data: 'jumlah', name: 'jumlah' },
                { data: 'action', name: 'action', orderable: false },
            ],
            order: [[0, 'desc']],
            createdRow:function(row, data, dataIndex, cells) {
                $(row).addClass('itemRow mt-2 d-flex flex-row justify-content-between');
            },
            columnDefs:[
                { className: 'columnItem d-flex align-items-center justify-content-center w-100', targets: "_all" }
            ],
            drawCallback: function (settings) {
                var data = table.rows().data().toArray();

                // Initialize sums
                var totalPemasukan = 0;
                var totalPengeluaran = 0;

                // Calculate the sum of 'jumlah' based on 'status'
                data.forEach(function(row) {
                    var jumlah = parseInt(row.jumlah) || 0;
                    if (row.status === 'Pemasukan') {
                        totalPemasukan += jumlah;
                    } else if (row.status === 'Pengeluaran') {
                        totalPengeluaran += jumlah;
                    }
                });

                // Display the sums in the appropriate elements
                $('#total_pemasukan').text(totalPemasukan.toFixed(0)); // Format to 2 decimal places
                $('#total_pengeluaran').text(totalPengeluaran.toFixed(0));
            },
            language: {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "processing": "Sedang memproses..."
                }
        });

        // Get the row data to be displayed in edit modal
            $('#tbl_list tbody').on('click', '.btn_edit_transaksi', function() {
                var data = table.row($(this).closest('tr')).data();
                displayModalEdit(data);
            });

            $('#tbl_list tbody').on('click', '.btn_delete_transaksi', function() {
                var data = table.row($(this).closest('tr')).data();
                tampilkanPopupHapus(data.pencatatan_id);
            });


            // Apply date range filtering
            $('#DariTanggal, #SampeTanggal').on('change', function () {
                table.draw();
            });

            $('#dompet_filter').on('change', function () {
                table.draw();
            });

            $('#kategori_filter').on('change', function () {
                table.draw();
            });

            $('#status_filter').on('change', function () {
                table.draw();
            });
    });
    document.querySelector('.TransaksiIcon').classList.add('active');
</script>

<script>
    function resetForm() {
        const event = new Event('change');
        // Reset select elements
        document.querySelectorAll('select').forEach(select => {
            select.selectedIndex = 0;
            select.dispatchEvent(event);
        });

        document.querySelectorAll('input[type="text"]').forEach(input => {
        input.value = '';
});
    }
</script>

<script>
    // Get the modal
    var modalJosh = document.getElementById("ModalJosh");

    // Get the <span> element that closes the modal
    var closeButton = document.getElementsByClassName("closeModal")[0];

    // Get the submit button
    var submitBtn = document.getElementById("submitBtn");

    // Get the output div
    var output = document.getElementById("output");

     // When the user clicks the button, open the edit modal
        function displayModalEdit(data) {
            modalJosh.style.display ="block";

            var form = document.getElementById("form_transaksi");
            form.action = '{{route("edit_transaction")}}';

            // Change method to put
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', '_method');
            hiddenInput.setAttribute('value', 'PUT');
            form.appendChild(hiddenInput);

            // Set Judul Pop Up & Button ke Edit
            document.getElementById("judul_popup").innerText = "Edit Transaksi"
            document.getElementById("submitBtn").innerText = "Edit Transaksi"

            var id_input = document.createElement('input');
            id_input.setAttribute('type', 'hidden');
            id_input.setAttribute('name', 'pencatatan_id');
            id_input.setAttribute('value', data.pencatatan_id);
            form.appendChild(id_input);

            var purpose = document.querySelector('input[name="tujuan"][value="'+ data.status +'"]');
            var saldoAwal = document.getElementById("SaldoAwal");
            var deskripsi = document.getElementById("exampleFormControlInput1");
            var tanggal = document.getElementById("tanggal1");
            var dompet = document.getElementById("dompet1");
            var kategori = document.getElementById("kategori1");
            var file = document.getElementById("file").files[0];

            purpose.checked = true;
            saldoAwal.value = data.jumlah;
            deskripsi.value = data.deskripsi;
            tanggal.value = data.tanggal;
            dompet.value = data.dompets_id;
            kategori.value = data.kategoris_id;

            setImagePreview(data.bukti);
        }

        // Set ImagePreview
        function setImagePreview(imagePath) {
            var imageUrl = '{{ asset("uploads/" . ":path") }}'.replace(':path', imagePath);
            $('#imagePreview').attr('src', imageUrl).show();
        }

        // When the user clicks on <span> (x), close the modal
        closeButton.onclick = function() {
            modalJosh.style.display = "none";

            var form = document.getElementById("form_transaksi");

            form.reset();

            var imageUrl = "";
            $('#imagePreview').attr('src', imageUrl);
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalJosh) {
                modalJosh.style.display = "none";

                var form = document.getElementById("form_transaksi");

                form.reset();

                var imageUrl = "";
                $('#imagePreview').attr('src', imageUrl);
            }
        }

        // When the user clicks the submit button, display the form data
        submitBtn.onclick = function() {
            var purpose = document.querySelector('input[name="purpose"]:checked');
            var saldoAwal = document.getElementById("SaldoAwal").value;
            var deskripsi = document.getElementById("exampleFormControlInput1").value;
            var tanggal = document.getElementById("tanggal1").value;
            var dompet = document.getElementById("dompet1").value;
            var kategori = document.getElementById("kategori1").value;
            var file = document.getElementById("file").files[0];

            var purposeValue = purpose ? purpose.value : "Not selected";
            var fileName = file ? file.name : "No file chosen";

            var form = document.getElementById("form_transaksi");


            modalJosh.style.display = "none";
        }

        document.getElementById('file').addEventListener('change', function() {
            var statusElement = document.getElementById('file-upload-status');
            statusElement.textContent = 'File sedang diunggah...';
            statusElement.classList.remove('uploaded');
            statusElement.classList.add('uploading');

        // Simulate file upload for demo purposes
            setTimeout(function() {
                statusElement.textContent = 'File telah diunggah.';
                statusElement.classList.remove('uploading');
                statusElement.classList.add('uploaded');
            }, 2000); // Ganti dengan waktu unggah sebenarnya
        });

        document.getElementById('upload-form').addEventListener('submit', function() {
            var statusElement = document.getElementById('file-upload-status');
            statusElement.textContent = 'File sedang diunggah...';
            statusElement.classList.remove('uploaded');
            statusElement.classList.add('uploading');
        });

        function tampilkanPopupHapus(dor){
            document.getElementById('pencatatan_id').value = dor;
            document.getElementById('judul_popup_hapus').innerText = "Hapus Transaksi";
            document.getElementById('narasi_popup_hapus').innerText = "Apakah Anda Yakin Ingin Menghapus Transaksi Ini?";
            $('#modalHapusAnggaranTransaksi').modal('show');

            document.getElementById('form_hapus_anggaran_transaksi').action = '{{route("delete_transaction")}}';

            document.getElementById("btn_batal").addEventListener("click", function () {
                $('#modalHapusAnggaranTransaksi').modal('hide');
            });
        }
</script>
@endsection
