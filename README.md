<div align="center">
  <img src="https://capsule-render.vercel.app/api?type=waving&color=4285F4&height=120&section=header&text=GowesLurMalang&fontSize=50&fontAlignY=35&fontColor=ffffff" width="100%"/>
  
  <p align="center">
    <i>Panduan Instalasi & Clone Terlengkap</i>
  </p>
  
  <div>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  </div>
  <br>

  <a href="https://drive.google.com/drive/folders/1DdlkrOSLtXefJsGf8nNHyNyeczEKtqzp?usp=drive_link" target="_blank">
    <img src="https://img.shields.io/badge/📚_Dokumen_Kerja-Akses_via_Google_Drive-4285F4?style=for-the-badge&logo=googledrive&logoColor=white&boxShadow=true" alt="Google Drive - Dokumen Kerja" />
  </a>
</div>

---

<br>

## 🛠️ Persyaratan Sistem (Prerequisites)

Pastikan sistem lokal Anda telah dilengkapi dengan *tools* berikut sebelum memulai instalasi:

| Alat | Deskripsi & Fungsi |
| :---: | :--- |
| **<img src="https://img.shields.io/badge/Git-F05032?style=flat-square&logo=git&logoColor=white"/>** | Untuk melakukan *clone repository* proyek ini. |
| **<img src="https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white"/>** | *Dependency manager* untuk PHP (wajib untuk Laravel). |
| **<img src="https://img.shields.io/badge/XAMPP-F37623?style=flat-square&logo=xampp&logoColor=white"/>** | *Environment server* lokal (Apache & MySQL). |

<br>

---

## 🚀 Panduan Instalasi (Step-by-Step)

### 1️⃣ Clone & Install Dependencies
Buka **Terminal** atau **Command Prompt**, lalu salin dan jalankan perintah berikut secara berurutan:

```bash
git clone https://github.com/sakhiasyam18/goweslurmalangg.git
cd goweslurmalangg
composer install
```

### 2️⃣ Siapkan Database Lokal
1. Buka aplikasi **XAMPP Control Panel** dan tekan tombol **Start** pada modul `Apache` dan `MySQL`.
2. Buka web browser Anda dan akses halaman admin database: **[`http://localhost/phpmyadmin`](http://localhost/phpmyadmin)**
3. Buat sebuah **Database Baru** (kosongan) dengan nama persis seperti di bawah ini:
   ```text
   iniajagoweslurmalangoktober
   ```

### 3️⃣ Konfigurasi *Environment*
1. *Copy* file konfigurasi bawaan dengan menjalankan perintah berikut di terminal:
   ```bash
   cp .env.example .env
   ```
   *(Atau secara manual duplikat file `.env.example` dan ubah namanya menjadi `.env`)*
2. Buka file `.env` di **VS Code** (atau *code editor* pilihan Anda).
3. Sesuaikan *block* pengaturan database menjadi seperti ini:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=iniajagoweslurmalangoktober
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### 4️⃣ Generate Key, Migrasi, & Jalankan Server
Kembali ke **Terminal** dan jalankan perintah final berikut:

```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

> 💡 **Info:** Perintah `migrate:fresh --seed` tidak hanya membuat tabel, tetapi juga otomatis **mengisi database Anda** dengan *dummy data* bawaan (*seeder*).

<br>

---

## 🖼️ Penanganan Eror (Troubleshooting)

<details>
<summary><b>Klik disini jika foto/gambar sepeda tidak muncul di aplikasi! ⚠️</b></summary>
<br>

Jika aplikasi sudah berjalan namun aset gambar gagal dimuat, Anda perlu melakukan *setup* folder *storage* secara manual:

1. **Hapus Storage Lama**  
   Buka folder `public/storage` lalu hapus *seluruh isinya* (atau hapus saja folder `storage` tersebut sampai hilang). Pastikan di dalam folder `public` hanya tersisa direktori bawaan (seperti `css` atau `images` jika ada).

2. **Download Aset Tambahan**  
   Unduh file zip berisi gambar sepeda melalui tautan berikut:  
   <br>
   <a href="https://drive.google.com/file/d/1jcHOEf0jjwgleZYYowa7ZlXJuXNiQ2tL/view?usp=sharing" target="_blank">
     <img src="https://img.shields.io/badge/⬇️_Download-sepeda.zip-109D59?style=for-the-badge&logo=google-drive&logoColor=white" alt="Download sepeda.zip" />
   </a>
   <br><br>

3. **Ekstrak & Posisikan**  
   - Ekstrak file `sepeda.zip` yang baru saja diunduh.
   - Pindahkan folder hasil ekstraksi (`sepeda`) ke direktori berikut pada proyek Anda:  
     ```text
     goweslurmalangg\storage\app\public\
     ```
   - *Struktur akhir harus menjadi seperti ini:* `goweslurmalangg\storage\app\public\sepeda`

4. **Re-link Storage**  
   Buka terminal/CMD kembali, dan jalankan perintah berikut:
   ```bash
   php artisan storage:link
   ```

</details>

<br>

---

<div align="center">
  <h3>🎉 Voila! Selesai! 🎉</h3>
  <p>Proyek lokal Anda sekarang 100% <i>up and running</i> dan datanya sama persis dengan yang ada di <i>repository</i> utama.</p>
  <img src="https://capsule-render.vercel.app/api?type=waving&color=4285F4&height=70&section=footer" width="100%"/>
</div>
