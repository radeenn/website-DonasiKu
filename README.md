# DonasiKu

Project Laravel untuk pengelolaan campaign donasi, data donatur, gambar campaign, serta dokumentasi file dan gambar.

## Fitur Utama

- Pengelolaan campaign donasi.
- Upload dan penggantian gambar campaign.
- Form donasi dan daftar donasi terbaru.
- Manajemen file dokumentasi.
- Preview gambar dan PDF.
- Penyimpanan file melalui Laravel public storage.
- Tampilan responsif tanpa emoji.

## Instalasi

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan optimize:clear
php artisan migrate
php artisan storage:link
npm install
```

Jalankan aplikasi pada dua terminal:

```bash
php artisan serve
```

```bash
npm run dev
```

## Perbaikan Migration Documentation Files

Migration sudah aman untuk dua kondisi:

1. Database baru yang belum memiliki tabel `documentation_files`.
2. Database lama yang sudah memiliki tabel tersebut, tetapi belum memiliki kolom `title`, `file_path`, atau `file_type`.

Migration perbaikan tidak menghapus data lama.
