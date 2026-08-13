<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Page;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class JensinaGroupSeeder extends Seeder
{
    /**
     * Ships with realistic starter content for Jensina Group so the site
     * is demoable / launchable immediately after migrate --seed. Swap the
     * image paths for real uploads (storage:link + admin panel or Tinker)
     * before going live.
     */
    public function run(): void
    {
        $this->seedSettings();
        $categories = $this->seedCategories();
        $this->seedProducts($categories);
        $this->seedClients();
        $this->seedPages();

        SiteSetting::forget();
    }

    private function seedSettings(): void
    {
        SiteSetting::query()->firstOrCreate([], [
            'site_name' => 'Jensina Group',
            'site_name_short' => 'Jensina Group',
            'tagline_id' => 'Konstruksi & Ekspedisi Alat Berat Terpercaya',
            'tagline_en' => 'Trusted Construction & Heavy-Equipment Expedition',

            'legal_entity_1' => 'CV Anugerah Jensina Sejahtera',
            'legal_entity_2' => 'PT Maju Jensina Jaya',

            'default_meta_title_id' => 'Jensina Group | Konstruksi & Ekspedisi Alat Berat Karanganyar',
            'default_meta_title_en' => 'Jensina Group | Construction & Heavy-Equipment Expedition',
            'default_meta_description_id' => 'Jensina Group menyediakan jasa konstruksi bangunan dan angkutan bahan bangunan / alat berat untuk proyek di Karanganyar dan sekitarnya, Jawa Tengah.',
            'default_meta_description_en' => 'Jensina Group provides building construction and hauling of materials / heavy equipment for projects in Karanganyar and across Central Java.',
            'default_og_image' => null,
            'canonical_domain' => 'https://jensina.id',

            'phone' => '081111130357',
            'whatsapp' => '6281111130357',
            'email' => 'info@jensina.id',
            'address' => 'Ngledok, RT. 003 RW. 008, Kel. Sroyo, Kec. Jaten, Kab. Karanganyar, Jawa Tengah',
            'map_lat' => -7.5729,
            'map_lng' => 110.9420,

            'logo_path' => null,
            'logo_alt_path' => null,
            'favicon_path' => null,
            'primary_color' => '#3EC6E0',

            'company_profile_pdf' => null,

            'instagram' => null,
            'facebook' => null,
            'youtube' => null,
            'linkedin' => null,

            'gtm_id' => null,
            'ga4_id' => null,
            'google_site_verification' => null,
        ]);
    }

    /** @return array<string, Category> */
    private function seedCategories(): array
    {
        $data = [
            [
                'slug' => 'konstruksi',
                'name_id' => 'Konstruksi Bangunan',
                'name_en' => 'Building Construction',
                'description_id' => 'Pembangunan dan renovasi gedung hunian, komersial, dan industri dengan standar mutu dan keselamatan kerja.',
                'description_en' => 'Construction and renovation of residential, commercial, and industrial buildings with quality and safety standards.',
                'sort_order' => 1,
            ],
            [
                'slug' => 'sewa-alat-berat',
                'name_id' => 'Sewa Alat Berat',
                'name_en' => 'Heavy Equipment Rental',
                'description_id' => 'Penyewaan alat berat untuk kebutuhan proyek konstruksi, pengurugan, dan pekerjaan lapangan lainnya.',
                'description_en' => 'Heavy equipment rental for construction, land-filling, and other on-site project needs.',
                'sort_order' => 2,
            ],
            [
                'slug' => 'ekspedisi-material',
                'name_id' => 'Ekspedisi Bahan Bangunan',
                'name_en' => 'Building Material Expedition',
                'description_id' => 'Jasa angkutan bahan bangunan dan alat berat menuju lokasi proyek, tepat waktu dan aman.',
                'description_en' => 'Hauling of building materials and heavy equipment to project sites, on time and safely.',
                'sort_order' => 3,
            ],
        ];

        $categories = [];
        foreach ($data as $row) {
            $categories[$row['slug']] = Category::updateOrCreate(['slug' => $row['slug']], $row);
        }

        return $categories;
    }

    /** @param array<string, Category> $categories */
    private function seedProducts(array $categories): void
    {
        $products = [
            [
                'category_id' => $categories['konstruksi']->id,
                'slug' => 'jasa-bangun-rumah-ruko',
                'name_id' => 'Jasa Bangun Rumah & Ruko',
                'name_en' => 'House & Shophouse Construction',
                'excerpt_id' => 'Konstruksi rumah tinggal dan ruko dari perencanaan hingga serah terima.',
                'excerpt_en' => 'Residential and shophouse construction from planning through handover.',
                'description_id' => '<p>Layanan konstruksi menyeluruh oleh CV Anugerah Jensina Sejahtera, mencakup perencanaan, pelaksanaan, hingga pengawasan mutu di lapangan untuk rumah tinggal dan ruko.</p>',
                'description_en' => '<p>End-to-end construction service by CV Anugerah Jensina Sejahtera, covering planning, execution, and on-site quality supervision for houses and shophouses.</p>',
                'specifications' => [
                    ['label_id' => 'Cakupan', 'label_en' => 'Scope', 'value' => 'Struktur, arsitektur, MEP dasar'],
                    ['label_id' => 'Area layanan', 'label_en' => 'Service area', 'value' => 'Karanganyar & Jawa Tengah'],
                ],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories['sewa-alat-berat']->id,
                'slug' => 'sewa-excavator',
                'name_id' => 'Sewa Excavator',
                'name_en' => 'Excavator Rental',
                'excerpt_id' => 'Penyewaan excavator untuk pengurugan, penggalian, dan pematangan lahan.',
                'excerpt_en' => 'Excavator rental for land-filling, digging, and site preparation.',
                'description_id' => '<p>Unit excavator dengan operator berpengalaman, siap untuk kebutuhan proyek harian maupun jangka panjang.</p>',
                'description_en' => '<p>Excavator units with experienced operators, available for daily or long-term project needs.</p>',
                'specifications' => [
                    ['label_id' => 'Ketersediaan operator', 'label_en' => 'Operator included', 'value' => 'Ya / Yes'],
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $categories['ekspedisi-material']->id,
                'slug' => 'angkutan-bahan-bangunan',
                'name_id' => 'Angkutan Bahan Bangunan',
                'name_en' => 'Building Material Hauling',
                'excerpt_id' => 'Pengangkutan pasir, batu, besi, dan material proyek lainnya tepat waktu.',
                'excerpt_en' => 'Timely hauling of sand, stone, steel, and other project materials.',
                'description_id' => '<p>Layanan ekspedisi oleh PT Maju Jensina Jaya untuk pengiriman material proyek ke lokasi konstruksi secara aman dan terjadwal.</p>',
                'description_en' => '<p>Expedition service by PT Maju Jensina Jaya for safe, scheduled delivery of project materials to construction sites.</p>',
                'specifications' => [
                    ['label_id' => 'Jenis muatan', 'label_en' => 'Cargo type', 'value' => 'Material bangunan, alat berat'],
                ],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $categories['ekspedisi-material']->id,
                'slug' => 'angkutan-alat-berat',
                'name_id' => 'Angkutan Alat Berat',
                'name_en' => 'Heavy Equipment Transport',
                'excerpt_id' => 'Mobilisasi alat berat antar lokasi proyek menggunakan trailer.',
                'excerpt_en' => 'Mobilization of heavy equipment between project sites using trailers.',
                'description_id' => '<p>Layanan mobilisasi dan demobilisasi alat berat yang aman dan sesuai jadwal proyek.</p>',
                'description_en' => '<p>Safe mobilization and demobilization of heavy equipment aligned to project schedules.</p>',
                'specifications' => [],
                'is_featured' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($products as $row) {
            Product::updateOrCreate(['slug' => $row['slug']], $row + ['is_active' => true]);
        }
    }

    private function seedClients(): void
    {
        // Placeholder rows — swap `logo` with real uploaded paths (storage/clients/xxx.png).
        $names = ['Mitra Proyek A', 'Mitra Proyek B', 'Mitra Proyek C', 'Mitra Proyek D'];
        foreach ($names as $i => $name) {
            Client::updateOrCreate(['name' => $name], [
                'logo' => 'clients/placeholder.png',
                'website' => null,
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }
    }

    private function seedPages(): void
    {
        Page::updateOrCreate(['slug' => 'about-us'], [
            'type' => 'about',
            'title_id' => 'Tentang Kami',
            'title_en' => 'About Us',
            'content_id' => '<p>Jensina Group hadir sebagai mitra konstruksi dan ekspedisi terpadu, menaungi dua badan usaha: CV Anugerah Jensina Sejahtera yang menangani pekerjaan konstruksi, dan PT Maju Jensina Jaya yang menangani angkutan bahan bangunan dan alat berat.</p><p>Berbasis di Karanganyar, Jawa Tengah, kami melayani proyek konstruksi gedung, rumah tinggal, hingga kebutuhan logistik alat berat dengan mengutamakan ketepatan waktu dan keandalan.</p>',
            'content_en' => '<p>Jensina Group is an integrated construction and expedition partner, housing two entities: CV Anugerah Jensina Sejahtera, which handles construction work, and PT Maju Jensina Jaya, which handles hauling of building materials and heavy equipment.</p><p>Based in Karanganyar, Central Java, we serve building and residential construction projects along with heavy-equipment logistics needs, prioritizing punctuality and reliability.</p>',
            'meta_title_id' => 'Tentang Jensina Group',
            'meta_title_en' => 'About Jensina Group',
            'show_in_menu' => true,
            'is_active' => true,
            'published_at' => now(),
        ]);

        Page::updateOrCreate(['slug' => 'privacy-policy'], [
            'type' => 'privacy',
            'title_id' => 'Kebijakan Privasi',
            'title_en' => 'Privacy Policy',
            'content_id' => '<p>Jensina Group menghargai privasi pengunjung situs ini. Data yang Anda kirimkan melalui formulir kontak — seperti nama, email, dan nomor telepon — hanya digunakan untuk menindaklanjuti pertanyaan atau permintaan penawaran Anda, dan tidak dibagikan kepada pihak ketiga tanpa izin.</p><h2>Data yang Kami Kumpulkan</h2><ul><li>Nama dan informasi kontak yang Anda berikan secara sukarela melalui formulir kontak.</li><li>Data teknis dasar (seperti alamat IP) untuk keperluan keamanan dan pencegahan spam.</li></ul><h2>Penggunaan Data</h2><p>Data digunakan semata-mata untuk merespons pertanyaan Anda dan meningkatkan layanan kami.</p>',
            'content_en' => '<p>Jensina Group respects the privacy of this site\'s visitors. Information you submit through the contact form — such as name, email, and phone number — is used only to follow up on your inquiry or quote request, and is not shared with third parties without consent.</p><h2>Data We Collect</h2><ul><li>Name and contact details you voluntarily provide via the contact form.</li><li>Basic technical data (such as IP address) for security and spam-prevention purposes.</li></ul><h2>Use of Data</h2><p>Data is used solely to respond to your inquiry and to improve our services.</p>',
            'meta_title_id' => 'Kebijakan Privasi | Jensina Group',
            'meta_title_en' => 'Privacy Policy | Jensina Group',
            'show_in_menu' => false,
            'is_active' => true,
            'published_at' => now(),
        ]);

        Page::updateOrCreate(['slug' => 'terms-condition'], [
            'type' => 'terms',
            'title_id' => 'Syarat & Ketentuan',
            'title_en' => 'Terms & Conditions',
            'content_id' => '<p>Dengan mengakses dan menggunakan situs jensina.id, Anda menyetujui syarat dan ketentuan berikut.</p><h2>Penggunaan Konten</h2><p>Seluruh konten pada situs ini, termasuk teks, gambar, dan logo, adalah milik Jensina Group dan tidak boleh digunakan kembali tanpa izin tertulis.</p><h2>Penawaran Harga</h2><p>Informasi produk dan layanan pada situs ini bersifat umum. Penawaran harga resmi hanya berlaku melalui komunikasi tertulis dengan tim Jensina Group.</p>',
            'content_en' => '<p>By accessing and using jensina.id, you agree to the following terms and conditions.</p><h2>Use of Content</h2><p>All content on this site, including text, images, and logos, belongs to Jensina Group and may not be reused without written permission.</p><h2>Pricing Offers</h2><p>Product and service information on this site is general in nature. Official price quotes are only valid through written communication with the Jensina Group team.</p>',
            'meta_title_id' => 'Syarat & Ketentuan | Jensina Group',
            'meta_title_en' => 'Terms & Conditions | Jensina Group',
            'show_in_menu' => false,
            'is_active' => true,
            'published_at' => now(),
        ]);

        Page::updateOrCreate(['slug' => 'jasa-sewa-alat-berat-karanganyar'], [
            'type' => 'custom',
            'title_id' => 'Jasa Sewa Alat Berat di Karanganyar',
            'title_en' => 'Heavy Equipment Rental Service in Karanganyar',
            'content_id' => '<p>Mencari jasa sewa alat berat di Karanganyar dan sekitarnya? Jensina Group menyediakan unit alat berat dengan operator berpengalaman untuk mendukung proyek konstruksi, pengurugan lahan, dan kebutuhan proyek lainnya di wilayah Jawa Tengah.</p>',
            'content_en' => '<p>Looking for heavy equipment rental in Karanganyar and surrounding areas? Jensina Group provides equipment units with experienced operators to support construction, land-filling, and other project needs across Central Java.</p>',
            'meta_title_id' => 'Jasa Sewa Alat Berat Karanganyar | Jensina Group',
            'meta_title_en' => 'Heavy Equipment Rental Karanganyar | Jensina Group',
            'show_in_menu' => false,
            'is_active' => true,
            'published_at' => now(),
        ]);
    }
}
