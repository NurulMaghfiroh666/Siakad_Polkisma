/* =========================================
   APP CORE FUNCTIONS (GLOBAL)
========================================= */

// Login dummy
function login() {
    // redirect sesuai role (sementara default ke dashboard dosen)
    window.location.href = "../dosen/dashboard.html";
}

// Logout
function logout() {
    window.location.href = "../index.html";
}

// Notifikasi umum
function notify(msg) {
    alert(msg);
}

// Simulasi KRS
function saveKRS() {
    alert("KRS berhasil disimpan (dummy). Nanti akan terhubung ke database.");
}

// Cetak
function printKRS() {
    window.print();
}

// Pembayaran dummy
function payNow() {
    alert("Fitur pembayaran akan aktif setelah backend siap.");
}

// History operasi
function viewHistory() {
    alert("Riwayat pembayaran (dummy).");
}

// Download dummy
function downloadUTS() {
    alert("Download Jadwal UTS (dummy).");
}

function downloadUAS() {
    alert("Download Jadwal UAS (dummy).");
}

function downloadTranskrip() {
    alert("Download Transkrip (dummy).");
}
