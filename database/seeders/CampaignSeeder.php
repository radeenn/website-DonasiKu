<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $pendidikan = Category::firstOrCreate(['name' => 'Pendidikan']);
        $kesehatan = Category::firstOrCreate(['name' => 'Kesehatan']);
        $bencana = Category::firstOrCreate(['name' => 'Bencana Alam']);
        $panti = Category::firstOrCreate(['name' => 'Panti Asuhan']);
        $pangan = Category::firstOrCreate(['name' => 'Pangan']);

        $banjir = Campaign::firstOrCreate(
            ['title' => 'Bantu Korban Banjir'],
            [
                'description' => 'Donasi untuk membantu kebutuhan makanan, pakaian, dan obat-obatan bagi korban banjir.',
                'target_donation' => 10000000,
                'collected_donation' => 2500000,
                'deadline' => '2026-12-31',
            ]
        );
        $banjir->account()->updateOrCreate(
            ['campaign_id' => $banjir->id],
            ['bank_name' => 'BRI', 'account_number' => '1234567890', 'account_holder' => 'Yayasan DonasiKu']
        );
        $banjir->categories()->syncWithoutDetaching([$bencana->id, $pangan->id]);

        $beasiswa = Campaign::firstOrCreate(
            ['title' => 'Beasiswa Anak Yatim'],
            [
                'description' => 'Program bantuan biaya sekolah dan perlengkapan belajar untuk anak yatim dan kurang mampu.',
                'target_donation' => 20000000,
                'collected_donation' => 5000000,
                'deadline' => '2026-11-30',
            ]
        );
        $beasiswa->account()->updateOrCreate(
            ['campaign_id' => $beasiswa->id],
            ['bank_name' => 'BSI', 'account_number' => '9876543210', 'account_holder' => 'DonasiKu Peduli']
        );
        $beasiswa->categories()->syncWithoutDetaching([$pendidikan->id, $panti->id]);

        $pengobatan = Campaign::firstOrCreate(
            ['title' => 'Bantu Biaya Pengobatan'],
            [
                'description' => 'Meringankan biaya pengobatan warga yang membutuhkan bantuan medis darurat.',
                'target_donation' => 15000000,
                'collected_donation' => 4200000,
                'deadline' => '2026-10-15',
            ]
        );
        $pengobatan->account()->updateOrCreate(
            ['campaign_id' => $pengobatan->id],
            ['bank_name' => 'BCA', 'account_number' => '4455667788', 'account_holder' => 'DonasiKu Sehat']
        );
        $pengobatan->categories()->syncWithoutDetaching([$kesehatan->id]);

        $beasiswa->donations()->firstOrCreate(
            ['donor_name' => 'Angel', 'amount' => 50000],
            ['message' => 'Semoga bermanfaat untuk pendidikan.']
        );
    }
}
