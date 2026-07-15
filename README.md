# Sistem Informasi Perpustakaan

Sistem Informasi Perpustakaan adalah aplikasi web berbasis Laravel yang digunakan untuk mengelola proses utama perpustakaan, mulai dari data buku, anggota, eksemplar buku, peminjaman, pengembalian, admin, hingga pencatatan pengunjung.

Project ini digunakan sebagai studi kasus untuk sertifikasi Database Programmer Supervisor.

## Fitur Utama

- Login admin atau pustakawan.
- Manajemen data admin.
- Manajemen data anggota perpustakaan.
- Manajemen data buku.
- Manajemen data eksemplar buku.
- Transaksi peminjaman dan pengembalian buku.
- Pencatatan data pengunjung perpustakaan.
- Dashboard statistik buku, eksemplar, peminjaman, dan kunjungan.

## Teknologi

- PHP 8
- Laravel 9
- MySQL
- Blade Template
- Laravel Mix
- PHPUnit

## Struktur Project

- `app/Http/Controllers`: controller untuk proses bisnis aplikasi.
- `routes/web.php`: daftar route halaman dan aksi aplikasi.
- `resources/views`: tampilan aplikasi menggunakan Blade.
- `database/migrations`: migration Laravel.
- `perpustakaan.sql`: struktur dan data awal database.
- `public/images`: penyimpanan gambar buku.

## Database

Nama database yang digunakan:

```text
perpustakaan
```

File SQL:

```text
perpustakaan.sql
```

Tabel utama:

- `admin`
- `anggota`
- `buku`
- `eksemplar`
- `peminjaman`
- `pengunjung`

Relasi logis:

- Satu `buku` memiliki banyak `eksemplar`.
- Satu `anggota` dapat memiliki banyak `peminjaman`.
- Satu `eksemplar` dapat digunakan pada data `peminjaman`.
- `admin` digunakan untuk autentikasi dan pengelolaan data.
- `pengunjung` digunakan untuk mencatat kunjungan perpustakaan.

Foreign key:

- `eksemplar.buku_id` mengacu ke `buku.id`.
- `peminjaman.anggota_id` mengacu ke `anggota.id`.
- `peminjaman.eksemplar_id` mengacu ke `eksemplar.id`.

## Instalasi

1. Clone repository.
2. Jalankan instalasi dependency PHP.

```bash
composer install
```

3. Salin file environment.

```bash
copy .env.example .env
```

4. Generate application key.

```bash
php artisan key:generate
```

5. Buat database MySQL dengan nama `perpustakaan`.
6. Import file `perpustakaan.sql` melalui phpMyAdmin atau MySQL client.
7. Jalankan aplikasi.

```bash
php artisan serve
```

## Pengujian

Pengujian dapat dijalankan dengan perintah:

```bash
php artisan test
```

Hasil pengujian terakhir:

```text
2 tests passed
```

## Bukti Implementasi Sertifikasi

Project ini mendukung pembuktian unit kompetensi berikut:

- Analisis tools pengembangan aplikasi database.
- Identifikasi library, framework, dan komponen pendukung.
- Penggunaan struktur data.
- Implementasi rancangan entitas dan relasi.
- Organisasi fungsi, file, dan sumber daya program.
- Penulisan kode sesuai struktur MVC Laravel.
- Penggunaan SQL untuk CRUD dan laporan.
- Akses basis data menggunakan Laravel DB Facade.
- Implementasi algoritma proses peminjaman dan pengembalian.
- Dokumentasi kode program dan penggunaan aplikasi.
- Debugging, source code versioning, profiling, dan code review.
