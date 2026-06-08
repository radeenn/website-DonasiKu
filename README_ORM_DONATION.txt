Catatan pengerjaan ORM Donation - Pemrograman Web Lanjut

Yang sudah ditambahkan:
1. Model Eloquent:
   - Campaign
   - CampaignAccount
   - Category
   - Donation

2. Relasi Eloquent:
   - Campaign hasOne CampaignAccount
   - Campaign hasMany Donation
   - Campaign belongsToMany Category melalui tabel campaign_category
   - CampaignAccount belongsTo Campaign
   - Donation belongsTo Campaign
   - Category belongsToMany Campaign

3. Migration:
   - campaigns
   - campaign_accounts
   - categories
   - donations
   - campaign_category

4. Controller:
   - CampaignController sudah diperbarui untuk create/store/update campaign, rekening, kategori.
   - Ditambahkan halaman form donasi dan fungsi storeDonation untuk menyimpan donation.

5. View:
   - resources/views/campaign/create.blade.php
   - resources/views/campaign/edit.blade.php
   - resources/views/campaign/index.blade.php
   - resources/views/campaign/donation.blade.php
   - resources/views/donasi.blade.php

Cara menjalankan setelah extract zip:
1. composer install
2. copy .env.example .env
3. php artisan key:generate
4. php artisan migrate --seed
5. php artisan serve

Halaman utama tugas:
- http://127.0.0.1:8000/campaign
- http://127.0.0.1:8000/campaign/create
- http://127.0.0.1:8000/donasi
