# 🚀 Cara Menggunakan Server Laravel - Siakad Polkisma

## ✅ **Langkah Mudah:**

### **1. Start Server**
Double-click file: **`serve.bat`**

Atau jalankan di terminal:
```bash
serve.bat
```

### **2. Server Akan:**
- ✅ Start otomatis dengan PHP 8.3.29
- ✅ Buka browser otomatis ke `http://localhost:8000`
- ✅ Tanpa deprecation warnings!

### **3. Akses Aplikasi:**
- **URL Utama:** http://localhost:8000
- **IP Address:** http://127.0.0.1:8000

### **4. Stop Server:**
Tekan `Ctrl + C` di window command prompt

---

## 📋 **Akun Test untuk Login:**

### Admin:
- Username: `admin`
- Password: `password`

### Dosen:
- Username: `dosen`
- Password: `password`

### Mahasiswa:
- Username: `mahasiswa` / `siti` / `budi`
- Password: `password` (semua sama)

---

## 🔧 **Informasi Teknis:**

- **PHP Version:** 8.3.29 (Laragon)
- **Laravel Version:** 9.52.21
- **Database:** kampusdb (MySQL 8.0.30)
- **Port:** 8000
- **Host:** 0.0.0.0 (bisa diakses dari IP lokal)

---

## 💡 **Tips:**

1. **Akses dari HP/Laptop lain di jaringan yang sama:**
   - Cari IP komputer Anda (jalankan `ipconfig` di CMD)
   - Akses dari device lain: `http://[IP-ANDA]:8000`
   - Contoh: `http://192.168.1.100:8000`

2. **Cek Status Database:**
   - phpMyAdmin: `http://localhost/phpmyadmin`
   - Database: `kampusdb`

3. **File Helper Lainnya:**
   - `laragon-status.bat` - Cek status services
   - `laragon-start.bat` - Start Apache & MySQL
   - `laragon-stop.bat` - Stop semua services
