// Ambil elemen modal
var modal = document.getElementById("myPopup");

// Ambil elemen tombol yang membuka modal
var btn = document.getElementById("tambahDompet");

var namaDompet = document.getElementById("NamaDompet");

// Ambil elemen <span> yang menutup modal
var span = document.getElementsByClassName("close")[0];

// Ketika tombol diklik, buka modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Ketika <span> diklik, tutup modal
span.onclick = function() {
    modal.style.display = "none";
}

// Ketika pengguna mengklik di luar modal, tutup modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

