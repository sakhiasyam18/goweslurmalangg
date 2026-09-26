# 🚴 GowesLurMalang - Panduan Instalasi & Clone

Panduan ini berisi langkah-langkah untuk melakukan *clone* repository **GowesLurMalang** dan mengonfigurasi *project* di komputer lokal Anda agar bisa langsung dijalankan dengan sempurna, lengkap dengan datanya.

---

## 🛠️ Persyaratan Sistem
Sebelum memulai, pastikan Anda telah menginstal:
- **Git**
- **Composer**
- **XAMPP** (dengan PHP dan MySQL)

---

## 🚀 Langkah-langkah Instalasi

### 1. Clone Repository & Install Dependencies
Buka terminal/CMD Anda, lalu jalankan perintah berikut secara berurutan:

```bash
git clone https://github.com/sakhiasyam18/goweslurmalangg.git
cd goweslurmalangg
composer install
```

### 2. Siapkan Database
1. Nyalakan **Apache** dan **MySQL** pada **XAMPP**.
2. Buka browser dan akses **[phpMyAdmin](http://localhost/phpmyadmin)**.
3. Klik tab **Databases**.
4. Buat database baru (kosongan) dengan nama:
   ```text
   iniajagoweslurmalangoktober
   ```

### 3. Konfigurasi Environment (`.env`)
1. *Copy* file `.env.example` dan ubah namanya menjadi `.env` (atau jalankan `cp .env.example .env`).
2. Buka file `.env` menggunakan *text editor* favorit Anda (seperti VS Code).
3. Sesuaikan konfigurasi koneksi database menjadi seperti berikut:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=iniajagoweslurmalangoktober
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### 4. Generate Key, Migrate, & Jalankan Aplikasi
Setelah database dan `.env` sudah sesuai, kembali ke terminal/CMD dan jalankan:

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```
Setelah aplikasi berjalan, buka browser dan akses aplikasi melalui: **[http://localhost:8000/](http://localhost:8000/)**

> **Catatan:** Perintah `migrate:fresh --seed` akan otomatis mengisi database dengan data bawaan (*dummy* atau data *seed*).

---

## 🖼️ Penanganan Jika Foto Sepeda Tidak Muncul

Jika setelah menjalankan aplikasi foto-foto sepeda belum muncul, ikuti langkah berikut untuk memperbaikinya:

1. **Bersihkan Folder Storage Lama:**
   Masuk ke folder `public/storage` dan hapus **semua folder** yang ada di dalamnya (sampai folder `storage` tersebut hilang atau hanya tersisa folder `css` dan `images` di dalam `public`).

2. **Download Aset Foto Sepeda:**
   Download file `sepeda.zip` melalui link Google Drive berikut:
   [Download sepeda.zip (Google Drive)](https://drive.google.com/file/d/1jcHOEf0jjwgleZYYowa7ZlXJuXNiQ2tL/view?usp=sharing)

3. **Ekstrak & Pindahkan Folder:**
   - Ekstrak file `sepeda.zip` yang sudah didownload.
   - Pindahkan/tempelkan folder `sepeda` hasil ekstrak ke dalam direktori:
     ```text
     goweslurmalangg\storage\app\public\
     ```
     Sehingga struktur path-nya menjadi: `goweslurmalangg\storage\app\public\sepeda`

4. **Tautkan Ulang Storage (Link):**
   Buka kembali terminal/CMD dan jalankan perintah:
   ```bash
   php artisan storage:link
   ```

---

🎉 **Selesai!** 
Hasilnya: Database Anda sudah terisi secara otomatis dan project lokal Anda sekarang akan sama persis (*up and running*)!
