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
     * Ships with realistic, launch-ready content for Jensina Group so the
     * site is demoable / launchable immediately after migrate --seed.
     * Replace `company_profile_pdf` with a real upload before going live.
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

            // Real logos, uploaded by the client and copied into storage.
            'logo_path' => 'branding/logo-pt-maju-jensina-jaya.jpg',
            'logo_alt_path' => 'branding/logo-cv-anugerah-jensina-sejahtera.jpg',
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
                'description_id' => 'Pembangunan dan renovasi gedung hunian, komersial, dan industri dengan standar mutu dan keselamatan kerja, dikerjakan oleh CV Anugerah Jensina Sejahtera.',
                'description_en' => 'Construction and renovation of residential, commercial, and industrial buildings with quality and safety standards, carried out by CV Anugerah Jensina Sejahtera.',
                'image' => 'categories/konstruksi.jpg',
                'sort_order' => 1,
            ],
            [
                'slug' => 'sewa-alat-berat',
                'name_id' => 'Sewa Alat Berat',
                'name_en' => 'Heavy Equipment Rental',
                'description_id' => 'Penyewaan alat berat untuk kebutuhan proyek konstruksi, pengurugan, dan pekerjaan lapangan lainnya, lengkap dengan operator berpengalaman.',
                'description_en' => 'Heavy equipment rental for construction, land-filling, and other on-site project needs, complete with experienced operators.',
                'image' => 'categories/sewa-alat-berat.jpg',
                'sort_order' => 2,
            ],
            [
                'slug' => 'ekspedisi-material',
                'name_id' => 'Ekspedisi & Angkutan',
                'name_en' => 'Expedition & Hauling',
                'description_id' => 'Jasa angkutan bahan bangunan, alat berat, dan kontainer menuju lokasi proyek maupun pelabuhan, tepat waktu dan aman, oleh PT Maju Jensina Jaya.',
                'description_en' => 'Hauling of building materials, heavy equipment, and containers to project sites or ports, on time and safely, by PT Maju Jensina Jaya.',
                'image' => 'categories/ekspedisi-material.jpg',
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
                'description_id' => '<p>Layanan konstruksi menyeluruh oleh CV Anugerah Jensina Sejahtera, mencakup perencanaan, pelaksanaan, hingga pengawasan mutu di lapangan untuk rumah tinggal dan ruko.</p>'
                    . '<p>Tim kami menangani proses dari awal hingga akhir: koordinasi desain dengan pemilik/arsitek, perhitungan struktur, pengadaan material, pelaksanaan di lapangan oleh tukang dan mandor berpengalaman, hingga pengawasan mutu berkala oleh penanggung jawab proyek. Setiap tahap pekerjaan didokumentasikan agar pemilik dapat memantau progres secara transparan.</p>'
                    . '<p>Kami terbiasa bekerja sama dengan pemasok bahan bangunan dan alat berat dari unit ekspedisi Jensina Group sendiri (PT Maju Jensina Jaya), sehingga jadwal pengiriman material dapat diselaraskan langsung dengan jadwal pelaksanaan di lapangan — mengurangi risiko keterlambatan akibat masalah logistik.</p>',
                'description_en' => '<p>End-to-end construction service by CV Anugerah Jensina Sejahtera, covering planning, execution, and on-site quality supervision for houses and shophouses.</p>'
                    . '<p>Our team manages the process from start to finish: design coordination with the owner/architect, structural calculation, material procurement, on-site execution by experienced crews and foremen, and periodic quality supervision by a dedicated project lead. Every stage is documented so owners can track progress transparently.</p>'
                    . '<p>We routinely coordinate with Jensina Group\'s own expedition unit (PT Maju Jensina Jaya) for material and heavy-equipment delivery, aligning logistics schedules directly with on-site work plans — reducing the risk of delays caused by supply issues.</p>',
                'specifications' => [
                    ['label_id' => 'Cakupan', 'label_en' => 'Scope', 'value' => 'Struktur, arsitektur, MEP dasar'],
                    ['label_id' => 'Tahapan', 'label_en' => 'Process', 'value' => 'Perencanaan → pelaksanaan → pengawasan mutu → serah terima'],
                    ['label_id' => 'Area layanan', 'label_en' => 'Service area', 'value' => 'Karanganyar & Jawa Tengah'],
                ],
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $categories['konstruksi']->id,
                'slug' => 'renovasi-gedung-komersial',
                'name_id' => 'Renovasi Gedung Komersial & Industri',
                'name_en' => 'Commercial & Industrial Building Renovation',
                'excerpt_id' => 'Renovasi dan pengembangan gedung komersial, gudang, dan fasilitas industri.',
                'excerpt_en' => 'Renovation and expansion of commercial buildings, warehouses, and industrial facilities.',
                'description_id' => '<p>CV Anugerah Jensina Sejahtera menangani pekerjaan renovasi dan pengembangan untuk gedung komersial, gudang, dan fasilitas industri milik korporasi maupun UMKM, termasuk pekerjaan struktur, perkuatan, dan perluasan area produksi/penyimpanan.</p>'
                    . '<p>Karena banyak pekerjaan renovasi berlangsung di lokasi yang masih beroperasi, kami menyusun metode kerja yang meminimalkan gangguan terhadap aktivitas klien, termasuk pengaturan jam kerja dan jalur mobilisasi material.</p>',
                'description_en' => '<p>CV Anugerah Jensina Sejahtera handles renovation and expansion work for commercial buildings, warehouses, and industrial facilities for both corporations and SMEs, including structural work, reinforcement, and expansion of production/storage areas.</p>'
                    . '<p>Because much renovation work takes place at sites that remain operational, we plan work methods that minimize disruption to the client\'s activities, including adjusted working hours and material-mobilization routes.</p>',
                'specifications' => [
                    ['label_id' => 'Cakupan', 'label_en' => 'Scope', 'value' => 'Renovasi struktur, perkuatan, perluasan area'],
                    ['label_id' => 'Klien tipikal', 'label_en' => 'Typical clients', 'value' => 'Perusahaan konstruksi, manufaktur, pergudangan'],
                ],
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $categories['sewa-alat-berat']->id,
                'slug' => 'sewa-excavator',
                'name_id' => 'Sewa Excavator',
                'name_en' => 'Excavator Rental',
                'excerpt_id' => 'Penyewaan excavator untuk pengurugan, penggalian, dan pematangan lahan.',
                'excerpt_en' => 'Excavator rental for land-filling, digging, and site preparation.',
                'description_id' => '<p>Unit excavator dengan operator berpengalaman, siap untuk kebutuhan proyek harian maupun jangka panjang — pengurugan lahan, penggalian saluran, pematangan lahan sebelum konstruksi, hingga pekerjaan pendukung proyek infrastruktur.</p>'
                    . '<p>Setiap unit menjalani pengecekan kondisi sebelum dikirim ke lokasi, dan operator kami memahami standar keselamatan kerja di area proyek aktif, termasuk koordinasi dengan tim K3 di lokasi klien bila diperlukan.</p>',
                'description_en' => '<p>Excavator units with experienced operators, available for daily or long-term project needs — land-filling, trench digging, site preparation ahead of construction, and supporting work for infrastructure projects.</p>'
                    . '<p>Every unit is inspected before dispatch, and our operators follow standard site-safety practices, coordinating with the client\'s own safety (K3) team on active project sites when required.</p>',
                'specifications' => [
                    ['label_id' => 'Ketersediaan operator', 'label_en' => 'Operator included', 'value' => 'Ya / Yes'],
                    ['label_id' => 'Durasi sewa', 'label_en' => 'Rental terms', 'value' => 'Harian & jangka panjang / Daily & long-term'],
                ],
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $categories['ekspedisi-material']->id,
                'slug' => 'angkutan-bahan-bangunan',
                'name_id' => 'Angkutan Bahan Bangunan',
                'name_en' => 'Building Material Hauling',
                'excerpt_id' => 'Pengangkutan pasir, batu, besi, dan material proyek lainnya tepat waktu.',
                'excerpt_en' => 'Timely hauling of sand, stone, steel, and other project materials.',
                'description_id' => '<p>Layanan ekspedisi oleh PT Maju Jensina Jaya untuk pengiriman material proyek — pasir, batu split, besi beton, semen, hingga material prafabrikasi — ke lokasi konstruksi secara aman dan terjadwal.</p>'
                    . '<p>Karena berada dalam satu grup dengan unit konstruksi (CV Anugerah Jensina Sejahtera), jadwal pengiriman material dapat disinkronkan langsung dengan progres pekerjaan di lapangan, mengurangi waktu tunggu material dan risiko penumpukan di lokasi proyek yang sempit.</p>',
                'description_en' => '<p>Expedition service by PT Maju Jensina Jaya for the delivery of project materials — sand, split stone, reinforcement steel, cement, through to prefabricated materials — to construction sites, safely and on schedule.</p>'
                    . '<p>Because we operate under the same group as the construction unit (CV Anugerah Jensina Sejahtera), delivery schedules can be synchronized directly with on-site progress, cutting material wait times and reducing clutter at tight project sites.</p>',
                'specifications' => [
                    ['label_id' => 'Jenis muatan', 'label_en' => 'Cargo type', 'value' => 'Material bangunan (pasir, batu, besi, semen, dll.)'],
                    ['label_id' => 'Area layanan', 'label_en' => 'Service area', 'value' => 'Jawa Tengah & sekitarnya'],
                ],
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'category_id' => $categories['ekspedisi-material']->id,
                'slug' => 'angkutan-alat-berat',
                'name_id' => 'Angkutan Alat Berat',
                'name_en' => 'Heavy Equipment Transport',
                'excerpt_id' => 'Mobilisasi alat berat antar lokasi proyek menggunakan trailer.',
                'excerpt_en' => 'Mobilization of heavy equipment between project sites using trailers.',
                'description_id' => '<p>Layanan mobilisasi dan demobilisasi alat berat (excavator, crane, dump truck, dll.) menggunakan trailer, dikerjakan sesuai jadwal proyek dan mengikuti prosedur pengamanan muatan standar untuk angkutan alat berat di jalan umum.</p>',
                'description_en' => '<p>Mobilization and demobilization service for heavy equipment (excavators, cranes, dump trucks, etc.) using trailers, scheduled to match project timelines and following standard load-securing procedures for heavy-equipment transport on public roads.</p>',
                'specifications' => [
                    ['label_id' => 'Jenis alat', 'label_en' => 'Equipment type', 'value' => 'Excavator, crane, dump truck, dan alat berat lainnya'],
                ],
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'category_id' => $categories['ekspedisi-material']->id,
                'slug' => 'angkutan-kontainer',
                'name_id' => 'Angkutan Kontainer',
                'name_en' => 'Container Trucking',
                'excerpt_id' => 'Pengangkutan kontainer dari dan menuju pelabuhan untuk kebutuhan logistik proyek maupun industri.',
                'excerpt_en' => 'Container hauling to and from the port for project and industrial logistics needs.',
                'description_id' => '<p>PT Maju Jensina Jaya melayani pengangkutan kontainer dari dan menuju pelabuhan, mendukung kebutuhan logistik klien di sektor pelayaran dan industri yang memerlukan penanganan kontainer yang andal dan tepat waktu.</p>',
                'description_en' => '<p>PT Maju Jensina Jaya provides container trucking to and from the port, supporting the logistics needs of clients in the shipping and industrial sectors who require reliable, on-time container handling.</p>',
                'specifications' => [
                    ['label_id' => 'Jenis muatan', 'label_en' => 'Cargo type', 'value' => 'Kontainer 20ft / 40ft'],
                ],
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($products as $row) {
            Product::updateOrCreate(['slug' => $row['slug']], $row + ['is_active' => true]);
        }
    }

    private function seedClients(): void
    {
        // Real client names as provided by Jensina Group. Logos below are
        // placeholder wordmarks generated locally — swap each `logo` path
        // for the client's actual logo file (with permission to display
        // it) via storage/app/public/clients/ before launch.
        $clients = [
            ['name' => 'PT PP (Persero) Tbk', 'logo' => 'clients/pt-pp.png'],
            ['name' => 'PT Hutama Karya (Persero)', 'logo' => 'clients/pt-hk.png'],
            ['name' => 'PT Adhi Karya (Persero) Tbk', 'logo' => 'clients/pt-adhi-karya.png'],
            ['name' => 'PT Penta', 'logo' => 'clients/pt-penta.png'],
            ['name' => 'PT Arkonin', 'logo' => 'clients/pt-arkonin.png'],
            ['name' => 'PT KCC Glass Indonesia', 'logo' => 'clients/pt-kcc-glass-indonesia.png'],
            ['name' => 'PT OTSU Putra Andalas', 'logo' => 'clients/pt-otsu-putra-andalas.png'],
            ['name' => 'PT Qisut Anugerah Mandiri', 'logo' => 'clients/pt-qisut-anugerah-mandiri.png'],
            ['name' => 'PT Temas Line', 'logo' => 'clients/pt-temas-line.png'],
            ['name' => 'PT Tanto Intim Line', 'logo' => 'clients/pt-tanto.png'],
            ['name' => 'PT Meratus Line', 'logo' => 'clients/pt-maratus.png'],
        ];

        foreach ($clients as $i => $client) {
            Client::updateOrCreate(['name' => $client['name']], [
                'logo' => $client['logo'],
                'website' => null,
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }
    }

    private function seedPages(): void
    {
        $this->seedAboutPage();
        $this->seedPrivacyPage();
        $this->seedTermsPage();
        $this->seedCustomArticlePage();
    }

    private function seedAboutPage(): void
    {
        Page::updateOrCreate(['slug' => 'about-us'], [
            'type' => 'about',
            'title_id' => 'Tentang Kami',
            'title_en' => 'About Us',
            'content_id' => <<<'HTML'
<p>Jensina Group adalah grup usaha yang menaungi dua badan usaha di bidang konstruksi dan logistik proyek: <strong>CV Anugerah Jensina Sejahtera</strong>, yang menangani pekerjaan konstruksi bangunan, dan <strong>PT Maju Jensina Jaya</strong>, yang menangani sewa alat berat serta angkutan bahan bangunan, alat berat, dan kontainer. Kami berbasis di Karanganyar, Jawa Tengah, dan melayani proyek di seluruh wilayah Jawa Tengah dan sekitarnya.</p>

<h2>Mengapa Dua Badan Usaha dalam Satu Grup?</h2>
<p>Banyak proyek konstruksi tertunda bukan karena masalah teknis pembangunan, melainkan karena masalah logistik: material terlambat sampai, alat berat tidak tersedia tepat waktu, atau koordinasi antara kontraktor dan penyedia jasa angkutan yang berbelit. Dengan menyatukan unit konstruksi dan unit ekspedisi dalam satu grup, Jensina Group dapat menyelaraskan jadwal pengiriman material dan mobilisasi alat berat langsung dengan progres pekerjaan di lapangan — sehingga klien mendapatkan satu titik koordinasi untuk kebutuhan pembangunan maupun logistiknya.</p>

<h2>Pengalaman &amp; Cakupan Kerja</h2>
<p>Tim kami telah menangani berbagai pekerjaan konstruksi mulai dari rumah tinggal, ruko, hingga renovasi dan perluasan fasilitas komersial serta industri. Di sisi logistik, PT Maju Jensina Jaya melayani kebutuhan angkutan bahan bangunan dan alat berat antar-proyek, termasuk pengangkutan kontainer untuk mendukung kebutuhan klien di sektor pelayaran dan industri. Daftar mitra dan klien yang telah bekerja sama dengan kami dapat dilihat pada halaman <a href="/klien-kami">Klien Kami</a>.</p>

<h2>Cara Kami Bekerja</h2>
<ul>
<li><strong>Konsultasi kebutuhan</strong> — kami memahami dulu lingkup pekerjaan, lokasi, dan target waktu sebelum menyusun rencana kerja.</li>
<li><strong>Perencanaan &amp; penjadwalan</strong> — rencana pelaksanaan disusun bersama, termasuk penjadwalan pengiriman material/alat berat bila diperlukan.</li>
<li><strong>Pelaksanaan &amp; pengawasan mutu</strong> — pekerjaan diawasi oleh penanggung jawab proyek dengan perhatian pada standar mutu dan keselamatan kerja di lapangan.</li>
<li><strong>Serah terima &amp; tindak lanjut</strong> — hasil pekerjaan diserahterimakan dengan dokumentasi, dan kami tetap terbuka untuk konsultasi purnajual.</li>
</ul>

<h2>Komitmen Kami</h2>
<p>Kami mengutamakan ketepatan waktu, komunikasi yang jelas dengan klien, dan kepatuhan terhadap standar keselamatan kerja pada setiap proyek yang kami tangani — baik untuk klien perorangan, UMKM, maupun perusahaan berskala nasional.</p>
HTML,
            'content_en' => <<<'HTML'
<p>Jensina Group is a business group housing two entities in construction and project logistics: <strong>CV Anugerah Jensina Sejahtera</strong>, which handles building construction, and <strong>PT Maju Jensina Jaya</strong>, which handles heavy-equipment rental and the hauling of building materials, heavy equipment, and containers. We are based in Karanganyar, Central Java, and serve projects across Central Java and surrounding areas.</p>

<h2>Why Two Entities Under One Group?</h2>
<p>Many construction projects are delayed not by construction work itself, but by logistics — materials arriving late, equipment unavailable when needed, or clumsy coordination between contractors and hauling providers. By bringing our construction unit and expedition unit together under one group, Jensina Group can align material delivery and equipment mobilization schedules directly with on-site progress — giving clients a single point of coordination for both their construction and logistics needs.</p>

<h2>Experience &amp; Scope of Work</h2>
<p>Our team has handled construction work ranging from residential homes and shophouses to the renovation and expansion of commercial and industrial facilities. On the logistics side, PT Maju Jensina Jaya handles building-material and heavy-equipment hauling between project sites, including container trucking supporting clients in the shipping and industrial sectors. Partners and clients we have worked with are listed on our <a href="/en/klien-kami">Our Clients</a> page.</p>

<h2>How We Work</h2>
<ul>
<li><strong>Needs consultation</strong> — we first understand the scope of work, location, and timeline before drawing up a work plan.</li>
<li><strong>Planning &amp; scheduling</strong> — an execution plan is developed together with the client, including material/equipment delivery scheduling where relevant.</li>
<li><strong>Execution &amp; quality supervision</strong> — work is supervised by a dedicated project lead with attention to quality and on-site safety standards.</li>
<li><strong>Handover &amp; follow-up</strong> — completed work is handed over with documentation, and we remain available for after-project consultation.</li>
</ul>

<h2>Our Commitment</h2>
<p>We prioritize punctuality, clear communication with clients, and adherence to workplace-safety standards on every project we take on — for individual clients, SMEs, and national-scale companies alike.</p>
HTML,
            'meta_title_id' => 'Tentang Jensina Group | Konstruksi & Ekspedisi Karanganyar',
            'meta_title_en' => 'About Jensina Group | Construction & Expedition, Karanganyar',
            'meta_description_id' => 'Jensina Group menaungi CV Anugerah Jensina Sejahtera (konstruksi) dan PT Maju Jensina Jaya (sewa alat berat & ekspedisi). Kenali pengalaman dan cara kerja kami.',
            'meta_description_en' => 'Jensina Group houses CV Anugerah Jensina Sejahtera (construction) and PT Maju Jensina Jaya (equipment rental & expedition). Learn about our experience and how we work.',
            'show_in_menu' => true,
            'is_active' => true,
            'published_at' => now(),
        ]);
    }

    private function seedPrivacyPage(): void
    {
        Page::updateOrCreate(['slug' => 'privacy-policy'], [
            'type' => 'privacy',
            'title_id' => 'Kebijakan Privasi',
            'title_en' => 'Privacy Policy',
            'content_id' => <<<'HTML'
<p>Kebijakan privasi ini menjelaskan bagaimana Jensina Group (CV Anugerah Jensina Sejahtera dan PT Maju Jensina Jaya) mengumpulkan, menggunakan, dan melindungi informasi yang Anda berikan saat mengunjungi atau menggunakan situs jensina.id.</p>

<h2>Data yang Kami Kumpulkan</h2>
<ul>
<li><strong>Data yang Anda berikan secara langsung</strong> — nama, alamat email, nomor telepon/WhatsApp, dan isi pesan yang Anda kirimkan melalui formulir kontak.</li>
<li><strong>Data teknis dasar</strong> — alamat IP dan informasi perangkat/browser, dikumpulkan secara otomatis untuk keperluan keamanan situs dan pencegahan spam pada formulir.</li>
<li><strong>Data analitik</strong> — apabila Google Analytics/Google Tag Manager aktif pada situs ini, data kunjungan anonim (seperti halaman yang dilihat dan durasi kunjungan) dapat dikumpulkan untuk memahami penggunaan situs secara agregat.</li>
</ul>

<h2>Bagaimana Kami Menggunakan Data</h2>
<ul>
<li>Menindaklanjuti pertanyaan, permintaan penawaran, atau kebutuhan konsultasi proyek yang Anda ajukan.</li>
<li>Menghubungi Anda kembali melalui telepon, WhatsApp, atau email terkait pesan yang Anda kirimkan.</li>
<li>Meningkatkan kualitas konten dan kegunaan situs berdasarkan pola penggunaan secara umum (bukan data individu).</li>
<li>Menjaga keamanan situs, termasuk mendeteksi dan mencegah penyalahgunaan formulir kontak.</li>
</ul>

<h2>Berbagi Data dengan Pihak Ketiga</h2>
<p>Kami tidak menjual atau menyewakan data pribadi Anda kepada pihak ketiga mana pun. Data hanya dapat dibagikan kepada penyedia layanan yang mendukung operasional situs (misalnya penyedia hosting atau layanan analitik), sejauh diperlukan untuk menjalankan fungsi tersebut, dan tunduk pada kewajiban kerahasiaan yang setara.</p>

<h2>Penyimpanan &amp; Keamanan Data</h2>
<p>Data yang Anda kirimkan melalui formulir kontak disimpan pada basis data situs kami dan digunakan hanya untuk keperluan menindaklanjuti komunikasi dengan Anda. Kami menerapkan langkah-langkah wajar untuk menjaga keamanan data tersebut dari akses yang tidak sah.</p>

<h2>Hak Anda</h2>
<p>Anda berhak meminta informasi mengenai data yang kami simpan terkait Anda, meminta koreksi atas data yang tidak akurat, atau meminta penghapusan data tersebut, dengan menghubungi kami melalui kontak di bawah.</p>

<h2>Perubahan Kebijakan</h2>
<p>Kebijakan privasi ini dapat diperbarui dari waktu ke waktu. Perubahan akan dipublikasikan pada halaman ini.</p>

<h2>Hubungi Kami</h2>
<p>Untuk pertanyaan terkait kebijakan privasi ini, silakan hubungi kami melalui email info@jensina.id atau nomor telepon 081111130357.</p>
HTML,
            'content_en' => <<<'HTML'
<p>This privacy policy explains how Jensina Group (CV Anugerah Jensina Sejahtera and PT Maju Jensina Jaya) collects, uses, and protects information you provide when visiting or using jensina.id.</p>

<h2>Data We Collect</h2>
<ul>
<li><strong>Data you provide directly</strong> — name, email address, phone/WhatsApp number, and message content submitted via the contact form.</li>
<li><strong>Basic technical data</strong> — IP address and device/browser information, collected automatically for site security and contact-form spam prevention.</li>
<li><strong>Analytics data</strong> — if Google Analytics/Google Tag Manager is active on this site, anonymized visit data (such as pages viewed and time on site) may be collected to understand aggregate site usage.</li>
</ul>

<h2>How We Use Your Data</h2>
<ul>
<li>To follow up on inquiries, quote requests, or project consultation needs you submit.</li>
<li>To contact you back by phone, WhatsApp, or email regarding a message you sent.</li>
<li>To improve site content and usability based on general usage patterns (not individual data).</li>
<li>To maintain site security, including detecting and preventing contact-form abuse.</li>
</ul>

<h2>Sharing Data with Third Parties</h2>
<p>We do not sell or rent your personal data to any third party. Data may only be shared with service providers that support site operations (such as hosting or analytics providers), to the extent necessary for those functions, and subject to equivalent confidentiality obligations.</p>

<h2>Data Storage &amp; Security</h2>
<p>Data you submit via the contact form is stored in our site's database and used solely to follow up on communication with you. We take reasonable measures to protect that data from unauthorized access.</p>

<h2>Your Rights</h2>
<p>You have the right to request information about data we hold about you, request correction of inaccurate data, or request its deletion, by contacting us using the details below.</p>

<h2>Policy Changes</h2>
<p>This privacy policy may be updated from time to time. Changes will be published on this page.</p>

<h2>Contact Us</h2>
<p>For questions regarding this privacy policy, please contact us at info@jensina.id or 081111130357.</p>
HTML,
            'meta_title_id' => 'Kebijakan Privasi | Jensina Group',
            'meta_title_en' => 'Privacy Policy | Jensina Group',
            'meta_description_id' => 'Bagaimana Jensina Group mengumpulkan, menggunakan, dan melindungi data pengunjung situs jensina.id.',
            'meta_description_en' => 'How Jensina Group collects, uses, and protects visitor data on jensina.id.',
            'show_in_menu' => false,
            'is_active' => true,
            'published_at' => now(),
        ]);
    }

    private function seedTermsPage(): void
    {
        Page::updateOrCreate(['slug' => 'terms-condition'], [
            'type' => 'terms',
            'title_id' => 'Syarat & Ketentuan',
            'title_en' => 'Terms & Conditions',
            'content_id' => <<<'HTML'
<p>Dengan mengakses dan menggunakan situs jensina.id, Anda menyetujui syarat dan ketentuan berikut. Mohon dibaca dengan saksama.</p>

<h2>Penggunaan Situs</h2>
<p>Situs ini disediakan untuk memberikan informasi mengenai layanan konstruksi, sewa alat berat, dan ekspedisi Jensina Group. Anda setuju untuk menggunakan situs ini hanya untuk tujuan yang sah dan tidak menyalahgunakan formulir kontak atau fitur situs lainnya.</p>

<h2>Sifat Informasi &amp; Penawaran Harga</h2>
<p>Informasi produk, layanan, dan deskripsi pekerjaan pada situs ini bersifat umum dan dapat berubah sewaktu-waktu tanpa pemberitahuan. Situs ini <strong>tidak</strong> memuat daftar harga resmi. Penawaran harga, estimasi biaya, dan kesepakatan kerja hanya berlaku setelah dikonfirmasi secara tertulis oleh tim Jensina Group, umumnya setelah survei atau diskusi kebutuhan proyek.</p>

<h2>Kepemilikan Konten</h2>
<p>Seluruh konten pada situs ini — termasuk teks, foto, logo, dan tata letak — adalah milik Jensina Group atau digunakan dengan izin, dan dilindungi oleh hukum hak cipta yang berlaku. Konten tidak boleh disalin, direproduksi, atau digunakan kembali untuk tujuan komersial tanpa izin tertulis dari kami.</p>

<h2>Tanggung Jawab &amp; Batasan</h2>
<p>Kami berupaya menjaga akurasi informasi pada situs ini, namun tidak menjamin bahwa seluruh informasi selalu bebas dari kesalahan atau selalu terkini. Segala keputusan yang diambil berdasarkan informasi pada situs ini merupakan tanggung jawab pengguna; untuk keputusan terkait proyek atau kontrak kerja, mohon selalu mengonfirmasi langsung dengan tim kami.</p>

<h2>Tautan ke Situs Lain</h2>
<p>Situs ini dapat memuat tautan ke situs pihak ketiga. Jensina Group tidak bertanggung jawab atas konten atau kebijakan privasi situs pihak ketiga tersebut.</p>

<h2>Hukum yang Berlaku</h2>
<p>Syarat dan ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia.</p>

<h2>Perubahan Ketentuan</h2>
<p>Kami dapat memperbarui syarat dan ketentuan ini dari waktu ke waktu. Perubahan berlaku sejak dipublikasikan pada halaman ini.</p>

<h2>Hubungi Kami</h2>
<p>Pertanyaan mengenai syarat dan ketentuan ini dapat disampaikan melalui email info@jensina.id atau nomor telepon 081111130357.</p>
HTML,
            'content_en' => <<<'HTML'
<p>By accessing and using jensina.id, you agree to the following terms and conditions. Please read them carefully.</p>

<h2>Use of the Site</h2>
<p>This site is provided to share information about Jensina Group's construction, heavy-equipment rental, and expedition services. You agree to use this site only for lawful purposes and not to misuse the contact form or other site features.</p>

<h2>Nature of Information &amp; Pricing</h2>
<p>Product, service, and work-scope information on this site is general in nature and subject to change without notice. This site does <strong>not</strong> publish official price lists. Quotes, cost estimates, and work agreements are only valid once confirmed in writing by the Jensina Group team, typically following a site survey or project-needs discussion.</p>

<h2>Content Ownership</h2>
<p>All content on this site — including text, photos, logos, and layout — belongs to Jensina Group or is used with permission, and is protected under applicable copyright law. Content may not be copied, reproduced, or reused for commercial purposes without our written permission.</p>

<h2>Liability &amp; Limitations</h2>
<p>We strive to keep information on this site accurate, but do not guarantee that all information is always error-free or fully up to date. Decisions made based on information on this site are the user's responsibility; for decisions related to a project or work contract, please always confirm directly with our team.</p>

<h2>Links to Other Sites</h2>
<p>This site may contain links to third-party sites. Jensina Group is not responsible for the content or privacy practices of those third-party sites.</p>

<h2>Governing Law</h2>
<p>These terms and conditions are governed by and construed in accordance with the laws of the Republic of Indonesia.</p>

<h2>Changes to These Terms</h2>
<p>We may update these terms and conditions from time to time. Changes take effect once published on this page.</p>

<h2>Contact Us</h2>
<p>Questions regarding these terms and conditions can be directed to info@jensina.id or 081111130357.</p>
HTML,
            'meta_title_id' => 'Syarat & Ketentuan | Jensina Group',
            'meta_title_en' => 'Terms & Conditions | Jensina Group',
            'meta_description_id' => 'Syarat dan ketentuan penggunaan situs jensina.id, termasuk sifat informasi harga dan kepemilikan konten.',
            'meta_description_en' => 'Terms and conditions for using jensina.id, including the nature of pricing information and content ownership.',
            'show_in_menu' => false,
            'is_active' => true,
            'published_at' => now(),
        ]);
    }

    private function seedCustomArticlePage(): void
    {
        Page::updateOrCreate(['slug' => 'jasa-sewa-alat-berat-karanganyar'], [
            'type' => 'custom',
            'title_id' => 'Jasa Sewa Alat Berat di Karanganyar',
            'title_en' => 'Heavy Equipment Rental Service in Karanganyar',
            'content_id' => <<<'HTML'
<p>Mencari jasa sewa alat berat di Karanganyar dan sekitarnya? Jensina Group, melalui PT Maju Jensina Jaya, menyediakan unit alat berat dengan operator berpengalaman untuk mendukung proyek konstruksi, pengurugan lahan, dan kebutuhan proyek lainnya di wilayah Jawa Tengah.</p>

<h2>Kapan Anda Membutuhkan Sewa Alat Berat?</h2>
<p>Beberapa situasi umum di mana kontraktor maupun pemilik proyek membutuhkan jasa sewa alat berat antara lain:</p>
<ul>
<li>Pematangan lahan sebelum pembangunan dimulai (pengurugan, perataan tanah).</li>
<li>Penggalian untuk pondasi, saluran drainase, atau instalasi utilitas bawah tanah.</li>
<li>Proyek jangka pendek yang tidak sepadan secara biaya jika harus membeli unit sendiri.</li>
<li>Kebutuhan alat berat tambahan saat unit milik kontraktor sedang digunakan di proyek lain.</li>
</ul>

<h2>Kenapa Menyewa, Bukan Membeli?</h2>
<p>Bagi banyak kontraktor skala menengah, menyewa alat berat lebih efisien dibanding membeli unit baru: tidak ada beban perawatan rutin, biaya penyimpanan, atau risiko penyusutan nilai aset saat alat tidak digunakan. Menyewa juga memberi fleksibilitas untuk menyesuaikan jenis dan jumlah alat dengan kebutuhan tiap fase proyek.</p>

<h2>Yang Kami Perhatikan Saat Menyediakan Alat Berat</h2>
<ul>
<li><strong>Kondisi unit</strong> — setiap unit dicek kondisinya sebelum dikirim ke lokasi proyek.</li>
<li><strong>Operator berpengalaman</strong> — unit disertai operator yang memahami standar keselamatan kerja di lokasi proyek aktif.</li>
<li><strong>Kesesuaian jadwal</strong> — pengiriman dan penarikan unit disesuaikan dengan timeline proyek Anda.</li>
<li><strong>Koordinasi dengan kebutuhan material</strong> — karena Jensina Group juga menangani angkutan bahan bangunan, kebutuhan alat berat dan material dapat dikoordinasikan dalam satu komunikasi.</li>
</ul>

<h2>Area Layanan</h2>
<p>Kami melayani proyek di Karanganyar dan wilayah sekitarnya di Jawa Tengah. Untuk kebutuhan di luar area tersebut, silakan hubungi kami terlebih dahulu untuk memastikan ketersediaan unit dan estimasi biaya mobilisasi.</p>

<h2>Cara Memulai</h2>
<p>Hubungi kami melalui halaman <a href="/kontak">Kontak</a> atau WhatsApp dengan menyebutkan jenis alat berat, perkiraan durasi penggunaan, dan lokasi proyek. Tim kami akan menindaklanjuti dengan estimasi ketersediaan dan biaya.</p>
HTML,
            'content_en' => <<<'HTML'
<p>Looking for heavy equipment rental in Karanganyar and surrounding areas? Jensina Group, through PT Maju Jensina Jaya, provides equipment units with experienced operators to support construction, land-filling, and other project needs across Central Java.</p>

<h2>When Do You Need Heavy Equipment Rental?</h2>
<p>Common situations where contractors and project owners need heavy-equipment rental include:</p>
<ul>
<li>Site preparation before construction begins (land-filling, grading).</li>
<li>Excavation for foundations, drainage channels, or underground utility installation.</li>
<li>Short-term projects where purchasing a dedicated unit isn't cost-effective.</li>
<li>Additional equipment needs when a contractor's own units are deployed on another project.</li>
</ul>

<h2>Why Rent Instead of Buy?</h2>
<p>For many mid-sized contractors, renting heavy equipment is more efficient than buying new units: no routine maintenance burden, storage costs, or asset-depreciation risk while equipment sits idle. Renting also offers flexibility to match equipment type and quantity to each project phase's needs.</p>

<h2>What We Focus On When Providing Equipment</h2>
<ul>
<li><strong>Unit condition</strong> — every unit is inspected before dispatch to the project site.</li>
<li><strong>Experienced operators</strong> — units come with operators who understand safety standards on active project sites.</li>
<li><strong>Schedule fit</strong> — delivery and pickup are aligned with your project timeline.</li>
<li><strong>Coordination with material needs</strong> — since Jensina Group also handles building-material hauling, equipment and material needs can be coordinated in a single conversation.</li>
</ul>

<h2>Service Area</h2>
<p>We serve projects in Karanganyar and the surrounding areas of Central Java. For needs outside this area, please contact us first to confirm unit availability and mobilization cost estimates.</p>

<h2>How to Get Started</h2>
<p>Contact us via the <a href="/en/kontak">Contact</a> page or WhatsApp, mentioning the equipment type, estimated duration of use, and project location. Our team will follow up with availability and cost estimates.</p>
HTML,
            'meta_title_id' => 'Jasa Sewa Alat Berat Karanganyar | Jensina Group',
            'meta_title_en' => 'Heavy Equipment Rental Karanganyar | Jensina Group',
            'meta_description_id' => 'Sewa alat berat di Karanganyar dengan operator berpengalaman dari Jensina Group. Cocok untuk pematangan lahan, penggalian, dan proyek konstruksi lainnya.',
            'meta_description_en' => 'Heavy equipment rental in Karanganyar with experienced operators from Jensina Group. Suited for site prep, excavation, and other construction projects.',
            'show_in_menu' => false,
            'is_active' => true,
            'published_at' => now(),
        ]);
    }
}
