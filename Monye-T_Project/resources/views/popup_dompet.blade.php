<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href="{{asset('popup/popup.css')}}">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Tombol untuk membuka modal -->
    <button id="tambahDompet">+ Dompet</button>

    <!-- Modal -->
    <div id="myPopup" class="popup">
      <div class="popup-content">
        <span class="close">&times;</span>
        <div class="header">
          <h1 class="header-title">Tambah Dompet</h1>
        </div>

        <div class="FormArea">
          <p class="TextField-title">Masukkan nama dompet barumu!</p>
          <input type="text" class="textfield" id="NamaDompet" placeholder="Nama Dompet Baru"  name="namaDompet">  
        </div>

        <div class="FormArea">
          <p class="TextField-title">Masukkan saldo awal dompet barumu!</p>
          <div class="flex">
            <span class="currency">Rp</span>
            <input type="text" class="textfield-saldo" id="SaldoAwal" placeholder="Saldo Awal Dompet Baru"  name="saldoAwal">  
          </div>
        </div>
        
        <div class="ButtonArea">
          <button style="box-shadow: 0 2px 2px 0 #00000025;" type="submit" class="yellow-button">Tambah</button>
        </div>

      </div>
    </div>
</body>
<script src="{{asset('popup/popup.js')}}"></script>
<script>

</script>
</html>