<style>
        .TransaksiBaru{
            background-color: #ffde59;
            padding: 25px 0px 10px 25px;
            border-radius: 10px 0px 0px 0px;

        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 10px;
            position: relative; /* Ensure relative positioning */
        }
        .closeModal {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
        }
        .closeModal:hover,
        .closeModal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .column {
            padding: 10px;
            /* margin-left: 10px; */
        }
        .field-group {
            padding-top: 20px;
            padding-right: 20px;
            padding-bottom: 20px;
        }
        .flex {
            display: flex;
            justify-content: flex-start;
        }
        .flex .currency {
            font-size: 15px;
            font-weight: 500;
            padding: 2px 10px 0 15px;
            color: rgba(0, 0, 0, 1);
            outline: 2px solid #FEEE7285;
            border-right: 0;
            line-height: 2.5;
            border-radius: 10px 0 0 10px;
            background-color: #FEEE7285;
        }
        .text-field-saldo {
            padding: 15px;
            border-radius: 0 10px 10px 0;
            width: 76.5%;
            border: 0.2px solid rgba(0, 0, 0, 0.4);
            border-left: 0;
            -moz-appearance: textfield;
        }

        .text-field-saldo::-webkit-outer-spin-button,
        .text-field-saldo::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .text-field-saldo {
            -moz-appearance: textfield; /* Firefox */
        }

        .text-field-saldo:focus {
            outline: 2px solid #FEEE72;
            border: 0;
        }
        /*  */
        .isiPeruntukan{
            margin-top: 20px;
            /* margin-left: 50px; */
            margin-bottom: 20px;
        }
        .isiPeruntukan label{
            font-size: 18px;
        }

        .isiPeruntukan input[type="radio"] {
            margin-right: 10px;
        }

        .isiDeskripsi{
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .isiBukti {
            padding-top: 20px;
        }

        .file-upload-input {
            display: none;
        }
        .file-upload-label {
            height: 100px;
            width: 200px;
            border-radius: 10px;
            border: 1px dashed #999;
            display: inline-block;
            text-align: center;
            line-height: 100px;
            cursor: pointer;
        }
        .file-upload-label:hover {
            color: #dbbe5f;
            border: 1px dashed #000000;
        }

        .isiTanggal{
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .kategori{
            margin-top: 15px;
        }


        .select-container {
            margin-bottom: 20px;
        }

        .select-wrapper {
            margin-top: 20px;
            position: relative;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            width: 100%;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px 40px 10px 20px;
            font-size: 16px;
            color: #555;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        select:focus {
            border-color: #aaa;
        }

        select::-ms-expand {
            display: none;
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 20px;
            top: 50%;
            width: 0;
            height: 0;
            pointer-events: none;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid #333;
            transform: translateY(-50%);
        }
        .tombol{
            margin-top: 70px;
            /* margin-left: 100px; */
            margin-bottom: 50px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .tombolPencet {
            background-color: #FEEE72;
            width: 500px;
            height: 50px;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: box-shadow 0.4s ease, border 0.4s ease;
        }
        .tombolPencet:hover {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
        .file-upload-status {
            margin-top: 10px;
            color: #333;
            font-size: 14px;
        }

        .uploading {
            color: blue;
        }

        .uploaded {
            color: green;
        }

</style>
<div>

    <div id="ModalJosh" class="modal p-0 overflow-hidden">

      <!-- Modal content -->
      <div class="modal-content p-0" style="scale: 0.9;">
        <span class="closeModal">&times;</span>
        <div class="TransaksiBaru" style="width: 40%">
            <h1 class="">Transaksi Baru</h1>
        </div>
        <!-- wrap columns in a row -->        
        <form action="{{ route('input_transaction')}}" method="POST" enctype="multipart/form-data">
            <div class="row p-4" id="transaksiForm">
                    @csrf
                    <!-- left column -->
                    <div class="column col-md-6">
                        {{-- tujuan --}}
                        <div class="peruntukan">
                            <h4>Peruntukan</h4>
                            <div class="isiPeruntukan">
                                <label ><input type="radio" name="tujuan" id="income" value="Pemasukkan">Pemasukan</label>
                                <label style="margin-left: 80px"><input type="radio" name="tujuan" id="expense" value="Pengeluaran">Pengeluaran</label>
                            </div>
                        </div>
                        {{-- nominal --}}
                        <div class="nominal"> 
                            <h4>Nominal</h4>
                            <div class="field-group">
                                <div class="flex">
                                <span class="currency" aria-hidden="true">Rp</span>
                                <input type="number" class="text-field-saldo" id="SaldoAwal" placeholder="Saldo Awal Dompet Baru" name="nominal">
                                </div>
                            </div>
                        </div>
                        {{-- deskripsi --}}
                        <div class="deskripsi">
                            <h4>Deskripsi (Opsional)</h4>
                            <div class="isiDeskripsi">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Isi Deskripsi disini" name="deskripsi">
                            </div>
                        </div>
                        {{-- bukti --}}
                        <div class="bukti">
                            <h4>Bukti (Opsional)</h4>
                            <div class="isiBukti">
                                <input type="file" id="file" class="file-upload-input" name="bukti"/>
                                <label for="file" class="file-upload-label">Upload File</label>
                                {{-- <div id="file-upload-status" class="file-upload-status"></div> --}}
                            </div>
                        </div>
                    </div>

                    <!-- right column -->
                    <div class="column col-md-6">
                        {{-- tanggal --}}
                        <div class="tanggal">
                            <h4>Tanggal</h4>
                            <div class="isiTanggal">
                                <input type="date" id="tanggal1" name="tanggal" value="">
                            </div>
                        </div>
                        {{-- dompet --}}
                        @php
                            $dompets = App\Models\User::find(auth()->user()->user_id)->dompets;
                            $kategoris = App\Models\User::find(auth()->user()->user_id)->kategoris;
                        @endphp
                        <div class="dompet select-container">                            
                            <h4>Dompet</h4>
                            <div class="select-wrapper">
                                <select name="dompet" id="dompet1">                                    
                                    <option value="">Pilih Dompet</option>
                                    @foreach ($dompets as $dompet)
                                        <option value={{ $dompet->dompet_id }}>{{ $dompet->nama_dompet }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- kategori --}}
                        <div class="kategori select-container">
                            <h4>Kategori</h4>
                            <div class="select-wrapper">
                                <select name="kategori" id="kategori1">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value={{ $kategori->kategori_id }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tombol">
                            <button type="submit" class="tombolPencet" id="submitBtn">Tambah Transaksi</button>
                        </div>
                    </div>
                </div>
        </form>
      </div>
    </div>
</div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>

        // Get the modal
        var modalJosh = document.getElementById("ModalJosh");

        // Get the button that opens the modal
        var btnJosh = document.getElementById("ButtonAddTransaksi");

        // Get the <span> element that closes the modal
        var closeButton = document.getElementsByClassName("closeModal")[0];

        // Get the submit button
        var submitBtn = document.getElementById("submitBtn");

        // Get the output div
        var output = document.getElementById("output");

        // When the user clicks the button, open the modal
        btnJosh.onclick = function() {
            modalJosh.style.display ="block";
        }

        // When the user clicks on <span> (x), close the modal
        closeButton.onclick = function() {
            modalJosh.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modalJosh) {
                modalJosh.style.display = "none";
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

            output.innerHTML = `
                <h3>Submitted Data:</h3>
                <p><strong>Peruntukan:</strong> ${purposeValue}</p>
                <p><strong>Nominal:</strong> Rp ${saldoAwal}</p>
                <p><strong>Deskripsi:</strong> ${deskripsi}</p>
                <p><strong>Tanggal:</strong> ${tanggal}</p>
                <p><strong>Dompet:</strong> ${dompet}</p>
                <p><strong>Kategori:</strong> ${kategori}</p>
                <p><strong>Bukti:</strong> ${fileName}</p>
            `;

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
    </script>