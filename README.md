# Yattaqi Ahmad Faza 2311216 TP MVP

## Tentang Framework
Framework ini mengimplementasikan pola arsitektur Model-View-Presenter (MVP) untuk membangun aplikasi CRUD (Create, Read, Update, Delete) yang terstruktur dan mudah dipelihara. MVP memisahkan tanggung jawab pengembangan menjadi:

- **Model**: Penanganan data dan logika bisnis
- **View**: Tampilan antarmuka pengguna
- **Presenter**: Perantara antara Model dan View

## Struktur Direktori

```
MVP_PHP/
├── model/
│   ├── DB.class.php             # Class dasar untuk koneksi database
│   ├── Mahasiswa.class.php      # Entity class untuk mahasiswa
│   ├── TabelMahasiswa.class.php # Model untuk operasi CRUD mahasiswa
│   └── Template.class.php       # Class untuk mengolah template HTML
├── presenter/
│   ├── KontrakPresenter.php     # Interface untuk presenter
│   └── ProsesMahasiswa.php      # Presenter untuk data mahasiswa
├── templates/
│   ├── editjir.html             # Template form edit mahasiswa
│   ├── skin.html                # Template tampilan utama
│   └── tambahjir.html           # Template form tambah mahasiswa
├── view/
│   ├── KontrakView.php          # Interface untuk view
│   └── TampilMahasiswa.php      # View untuk menampilkan data mahasiswa
├── index.php                    # File utama aplikasi
└── mvp_php.sql                  # SQL untuk membuat database dan tabel
```

## Komponen Framework

### Model

1. **DB.class.php**
   - Kelas dasar untuk koneksi dan operasi database
   - Menyediakan metode `open()`, `execute()`, `getResult()`, dan `close()`

2. **Mahasiswa.class.php**
   - Entity class yang merepresentasikan objek mahasiswa
   - Berisi properti dan setter/getter untuk atribut mahasiswa

3. **TabelMahasiswa.class.php**
   - Berisi query dan operasi CRUD untuk tabel mahasiswa
   - Mewarisi kelas DB untuk mengakses database

4. **Template.class.php**
   - Menangani templating HTML
   - Menyediakan metode untuk mengganti placeholder dengan data dinamis

### Presenter

1. **KontrakPresenter.php**
   - Interface yang mendefinisikan kontrak untuk presenter
   - Memastikan konsistensi metode di semua presenter

2. **ProsesMahasiswa.php**
   - Mengimplementasi KontrakPresenter
   - Menghubungkan Model dan View
   - Memproses data dari Model sebelum dikirim ke View
   - Menangani request dari View untuk diteruskan ke Model

### View

1. **KontrakView.php**
   - Interface untuk semua kelas View
   - Mendefinisikan metode untuk menampilkan data

2. **TampilMahasiswa.php**
   - Mengimplementasi KontrakView
   - Bertanggung jawab untuk menampilkan data dalam format HTML
   - Menggunakan Template untuk merender tampilan

### Templates

1. **skin.html**
   - Template untuk tampilan utama daftar mahasiswa
   - Berisi placeholder "DATA_TABEL" yang akan diganti dengan data aktual

2. **tambahjir.html**
   - Template form untuk menambah data mahasiswa baru

3. **editjir.html**
   - Template form untuk mengedit data mahasiswa yang sudah ada

## Alur Kerja Framework

1. **Alur baca data (Read)**:
   - `index.php` memanggil `TampilMahasiswa->tampil()`
   - View meminta data ke Presenter (`ProsesMahasiswa->prosesDataMahasiswa()`)
   - Presenter meminta data ke Model (`TabelMahasiswa->getMahasiswa()`)
   - Model mengembalikan hasil query ke Presenter
   - Presenter memproses data sebelum dikirim ke View
   - View merender data menggunakan template

2. **Alur tambah data (Create)**:
   - User mengisi form tambah mahasiswa
   - Data form dikirim ke `index.php`
   - `index.php` memanggil `TampilMahasiswa->add()`
   - View meneruskan data ke Presenter (`ProsesMahasiswa->add()`)
   - Presenter meminta Model untuk menyimpan data (`TabelMahasiswa->add()`)
   - Redirect ke halaman utama

3. **Alur edit data (Update)**:
   - User memilih mahasiswa yang akan diedit
   - `index.php` memanggil `TampilMahasiswa->Tampilformedit()`
   - View meminta data ke Presenter (`ProsesMahasiswa->formEdit()`)
   - Presenter meminta data ke Model (`TabelMahasiswa->getMahasiswaByID()`)
   - Form edit ditampilkan dengan data yang sudah ada
   - User mengedit dan submit form
   - Data dikirim ke `index.php` yang memanggil `TampilMahasiswa->edit()`
   - Presenter meminta Model untuk update data (`TabelMahasiswa->edit()`)
   - Redirect ke halaman utama

4. **Alur hapus data (Delete)**:
   - User memilih mahasiswa yang akan dihapus
   - `index.php` memanggil `TampilMahasiswa->delete()`
   - View meneruskan ID ke Presenter (`ProsesMahasiswa->delete()`)
   - Presenter meminta Model untuk menghapus data (`TabelMahasiswa->delete()`)
   - Redirect ke halaman utama

## Database

Database menggunakan struktur berikut:

```sql
CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `tl` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
);
```

## Cara Instalasi

1. Buat database baru dengan nama "mvp_php"
2. Import file "mvp_php.sql" ke database
3. Sesuaikan kredensial database di file "presenter/ProsesMahasiswa.php"
4. Letakkan semua file dan folder di direktori web server
5. Akses aplikasi melalui browser

## Troubleshooting CRUD

Jika operasi CRUD tidak berfungsi, periksa hal-hal berikut:

1. **Koneksi Database**
   - Pastikan kredensial database (username, password) benar
   - Database dan tabel sudah dibuat dengan struktur yang sesuai

2. **Form Input**
   - Pastikan semua input memiliki atribut `name` yang sesuai dengan field database
   - Validasi form berfungsi dengan baik

3. **Query SQL**
   - Periksa query di TabelMahasiswa.class.php untuk kesalahan sintaks
   - Hindari koma tambahan pada akhir daftar SET dalam query UPDATE

4. **Pemrosesan ID**
   - Pastikan pengambilan ID dari parameter URL dilakukan dengan benar
   - Tipe data ID sesuai dengan tipe data di database

5. **Template HTML**
   - Placeholder untuk penggantian data ditulis dengan benar
   - Form action mengarah ke URL yang benar

## Best Practices

1. **Validasi Input**
   - Selalu validasi dan sanitasi input dari user untuk menghindari SQL Injection

2. **Penanganan Error**
   - Implementasi try-catch untuk menangkap exception
   - Tampilkan pesan error yang informatif tetapi aman

3. **Pemeliharaan Kode**
   - Ikuti struktur MVP untuk memisahkan tanggung jawab
   - Berikan komentar pada kode-kode yang kompleks
   - Gunakan penamaan yang konsisten dan deskriptif

---

Framework MVP PHP ini dibuat sebagai contoh implementasi pola arsitektur MVP dalam pengembangan aplikasi web PHP. Framework ini cocok untuk proyek kecil hingga menengah yang membutuhkan struktur yang rapi dan terorganisir.