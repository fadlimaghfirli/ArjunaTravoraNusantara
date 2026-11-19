<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->makeDirectory('blogs');

        $articles = [
            [
                'title' => 'Panduan Standar Infrastruktur Data Center Tier-3 untuk Instansi Pemerintah dan BUMN',
                'category' => 'Infrastruktur',
                'author' => 'Divisi Infrastruktur ATN',
                'tags' => 'Data Center, Server Rack, Fiber Optik, BUMN',
                'published_at' => '2026-11-16',
                'views' => 428,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Memahami komponen krusial mulai dari redundansi kelistrikan, pendinginan presisi, hingga manajemen kabel fiber optik agar layanan publik berjalan tanpa henti.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Keandalan layanan digital pada instansi pemerintah dan perusahaan BUMN sangat bergantung pada kesiapan ruang server atau <strong>Data Center</strong>. Gangguan listrik singkat maupun panas berlebih pada rak server dapat melumpuhkan operasional harian dalam hitungan menit.</p>
<h2>Mengapa Standar Tier-3 Menjadi Acuan Utama?</h2>
<p class="ql-align-justify">Berbeda dengan ruang server konvensional, arsitektur Tier-3 menerapkan prinsip <em>concurrently maintainable</em>. Artinya, setiap komponen pendukung—seperti UPS, sistem pendingin, maupun jalur jaringan—dapat dirawat atau diganti tanpa perlu mematikan sistem produksi utama.</p>
<blockquote>"Investasi pada arsitektur server yang terstruktur bukan sekadar biaya pengadaan perangkat, melainkan jaminan keberlangsungan layanan publik selama 24/7."</blockquote>
<h3>4 Pilar Utama Pembangunan Ruang Server Modern</h3>
<ol>
    <li><strong>Redundansi Daya (N+1):</strong> Penggunaan Dual Power Distribution Unit (PDU), UPS modular, dan integrasi genset otomatis untuk mencegah <em>downtime</em>.</li>
    <li><strong>Sistem Pendinginan Presisi:</strong> Pemisahan lorong panas dan dingin (<em>hot/cold aisle containment</em>) guna menjaga suhu perangkat tetap ideal di kisaran 20–24°C.</li>
    <li><strong>Kabel Terstruktur (Structured Cabling):</strong> Penataan jalur fiber optik dan UTP berkode warna agar proses pelacakan gangguan jauh lebih cepat.</li>
    <li><strong>Keamanan Fisik Berlapis:</strong> Kombinasi akses biometrik, kartu RFID, sensor suhu-kelembapan, dan pemantauan CCTV 24 jam.</li>
</ol>
<p class="ql-align-justify">Tim teknis <strong>PT. Arjuna Travora Nusantara</strong> mendampingi proses mulai dari survei lokasi, perancangan topologi, pengadaan rak dan perangkat keras resmi, hingga pengujian beban dan dukungan pemeliharaan SLA jangka panjang.</p>
HTML,
            ],
            [
                'title' => 'Strategi Integrasi SIMRS dan Rekam Medis Elektronik yang Siap Terhubung ke SatuSehat',
                'category' => 'Kesehatan',
                'author' => 'Tim Redaksi ATN',
                'tags' => 'SIMRS, SatuSehat, Healthcare, Rekam Medis Elektronik',
                'published_at' => '2026-11-12',
                'views' => 365,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Langkah praktis bagi rumah sakit dan klinik dalam memigrasikan catatan medis kertas ke sistem digital yang patuh regulasi Kemenkes tanpa menghambat antrean pasien.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Transformasi digital di fasilitas pelayanan kesehatan kini menjadi kewajiban regulasi sekaligus kebutuhan operasional. Melalui penerapan <strong>Rekam Medis Elektronik (RME)</strong> yang terintegrasi dengan platform SatuSehat, rumah sakit dapat memangkas waktu tunggu pasien secara signifikan.</p>
<h2>Tantangan Umum Saat Implementasi SIMRS</h2>
<p class="ql-align-justify">Banyak klinik dan rumah sakit menghadapi kendala bukan pada ketersediaan aplikasi, melainkan pada kesiapan jaringan lokal dan penyesuaian alur kerja tenaga medis di lapangan.</p>
<ul>
    <li>Koneksi internet tunggal tanpa <em>failover</em> sehingga pelayanan terhenti saat ISP mengalami gangguan.</li>
    <li>Format data antar poli (IGD, rawat jalan, farmasi, dan laboratorium) belum saling tersinkronisasi secara <em>real-time</em>.</li>
    <li>Kurangnya pendampingan teknis pada masa transisi dari pencatatan manual ke digital.</li>
</ul>
<h2>Pendekatan Implementasi Bertahap</h2>
<p class="ql-align-justify">Untuk meminimalkan hambatan operasional, proses digitalisasi sebaiknya dimulai dari pembenahan jaringan internal (Dual ISP + VLAN terpisah untuk perangkat medis), dilanjutkan dengan migrasi modul pendaftaran, farmasi, hingga integrasi API HL7 FHIR secara menyeluruh.</p>
<blockquote>"Sistem rumah sakit yang baik harus meringankan beban administratif dokter dan perawat, bukan menambah langkah kerja baru."</blockquote>
<p class="ql-align-justify">Dengan perpaduan pengembangan perangkat lunak khusus dan pengadaan infrastruktur jaringan yang stabil, fasilitas kesehatan dapat mencapai standar layanan modern yang aman dan akuntabel.</p>
HTML,
            ],
            [
                'title' => 'Memilih Sistem CCTV AI dan Kontrol Akses Terpadu untuk Keamanan Kawasan Industri',
                'category' => 'Keamanan',
                'author' => 'Divisi Security System ATN',
                'tags' => 'CCTV AI, Access Control, Keamanan Fisik, Industri',
                'published_at' => '2026-11-08',
                'views' => 294,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Peran analitik video pintar, deteksi perimeter otomatis, dan gerbang akses biometrik dalam menekan risiko insiden keamanan di pabrik serta pergudangan.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Sistem pengawasan konvensional yang hanya mengandalkan rekaman pasif sering kali baru berguna setelah insiden terjadi. Kini, kawasan industri, pergudangan logistik, hingga gedung perkantoran beralih ke <strong>CCTV berbasis AI</strong> yang mampu memberikan peringatan dini secara otomatis.</p>
<h2>Fitur Analitik yang Paling Dibutuhkan di Lapangan</h2>
<ul>
    <li><strong>Perimeter Intrusion Detection:</strong> Mengirim notifikasi instan ke ruang kontrol apabila ada pergerakan di zona terlarang pada jam non-operasional.</li>
    <li><strong>ANPR (Automatic Number Plate Recognition):</strong> Membaca pelat nomor kendaraan keluar-masuk area gudang secara otomatis dan mencatatnya ke dalam log logistik.</li>
    <li><strong>Deteksi APD (Alat Pelindung Diri):</strong> Memantau kepatuhan penggunaan helm keselamatan dan rompi di area produksi berisiko tinggi.</li>
</ul>
<h3>Integrasi dengan Access Control & NVR Terpusat</h3>
<p class="ql-align-justify">Kamera pengawas akan bekerja jauh lebih efektif bila digabungkan dengan sistem <u>Access Control</u> (kartu akses, sidik jari, atau pengenalan wajah) serta penyimpanan NVR berkapasitas besar dengan retensi minimal 30 hingga 90 hari.</p>
<p class="ql-align-justify">Perencanaan titik kamera sejak tahap awal memastikan tidak ada <em>blind spot</em>, sekaligus menjaga anggaran pengadaan tetap efisien sesuai luas area operasional Anda.</p>
HTML,
            ],
            [
                'title' => 'Tips Pengadaan Perangkat Keras IT Korporat agar Tepat Spesifikasi dan Bergaransi Resmi',
                'category' => 'Pengadaan',
                'author' => 'Tim Procurement ATN',
                'tags' => 'Hardware, Pengadaan IT, B2B, TKDN, Garansi Resmi',
                'published_at' => '2026-11-03',
                'views' => 512,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Hindari kesalahan spesifikasi berlebih maupun komponen non-resmi dalam pengadaan workstation, server, dan perangkat jaringan perusahaan.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Kesalahan paling sering dalam pengadaan perangkat keras (<em>hardware procurement</em>) adalah memilih perangkat semata-mata berdasarkan harga termurah tanpa memperhitungkan <strong>Total Cost of Ownership (TCO)</strong>, ketersediaan suku cadang, dan kejelasan garansi resmi distributor.</p>
<h2>Checklist Sebelum Melakukan Pengadaan Perangkat IT</h2>
<ol>
    <li><strong>Pemetaan Beban Kerja Nyata:</strong> Pisahkan spesifikasi untuk staf administrasi harian, tim desain/engineering, hingga kebutuhan komputasi server agar anggaran tidak terbuang sia-sia.</li>
    <li><strong>Keaslian Lisensi & Garansi Prinsipal:</strong> Pastikan setiap unit memiliki nomor seri resmi yang terdaftar di distributor Indonesia beserta opsi garansi <em>on-site</em>.</li>
    <li><strong>Kepatuhan Standar & TKDN:</strong> Khusus untuk instansi pemerintah dan BUMN, cek nilai TKDN dan sertifikasi ISO/IEC dari perangkat yang diajukan.</li>
    <li><strong>Kesiapan Layanan Purna Jual:</strong> Pilih mitra pengadaan yang juga menyediakan instalasi, konfigurasi awal, hingga dukungan penggantian unit sementara (<em>backup unit</em>).</li>
</ol>
<blockquote>"Perangkat kelas bisnis (enterprise-grade) mungkin terlihat sedikit lebih tinggi di awal, namun usia pakainya yang panjang dan minim gangguan menghemat biaya operasional hingga 40% dalam tiga tahun."</blockquote>
<p class="ql-align-justify">Melalui layanan terpadu, ATN membantu menyusun daftar spesifikasi teknis (BoQ) yang transparan, terukur, dan sesuai pagu anggaran organisasi Anda.</p>
HTML,
            ],
            [
                'title' => 'Digital Display dan Videotron Indoor: Solusi Modern Ruang Command Center & Lobby Instansi',
                'category' => 'Digital Display',
                'author' => 'Divisi Visual & Display ATN',
                'tags' => 'Videotron, Digital Signage, Command Center, Display',
                'published_at' => '2026-10-28',
                'views' => 238,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Mengenal perbedaan pixel pitch LED videotron, interactive flat panel, dan digital signage untuk komunikasi visual yang tajam dan informatif.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Penyajian data secara visual dalam rapat pimpinan, ruang <em>command center</em>, maupun area lobi pelayanan publik kini banyak memanfaatkan <strong>LED Videotron</strong> dan <strong>Digital Signage</strong>. Dibandingkan proyektor konvensional, layar LED modern menawarkan kecerahan stabil meski ruangan terang benderang.</p>
<h2>Memahami Pixel Pitch Sebelum Memasang Videotron</h2>
<p class="ql-align-justify">Istilah <em>pixel pitch</em> (misalnya P1.25, P1.5, P1.8, atau P2.5) menunjukkan jarak antar titik lampu LED dalam satuan milimeter. Semakin kecil angkanya, semakin rapat resolusinya dan semakin nyaman dilihat dari jarak dekat.</p>
<ul>
    <li><strong>P1.2 – P1.8 (Fine Pitch):</strong> Ideal untuk ruang rapat eksekutif dan <em>command center</em> dengan jarak pandang 2–4 meter.</li>
    <li><strong>P2.0 – P2.5 (Indoor Standard):</strong> Cocok untuk auditorium, aula konferensi, dan lobi utama perkantoran.</li>
    <li><strong>Interactive Flat Panel (IFP):</strong> Alternatif layar sentuh 65–86 inci untuk ruang diskusi kolaboratif dan kelas pintar.</li>
</ul>
<p class="ql-align-justify">Selain kualitas panel, penataan struktur rangka, sistem kontroler video (<em>video processor</em>), dan kalibrasi warna menjadi kunci agar tampilan tetap presisi dan awet digunakan bertahun-tahun.</p>
HTML,
            ],
            [
                'title' => 'Pengembangan Aplikasi Web Custom vs SaaS: Mana yang Lebih Efektif untuk Proses Bisnis B2B?',
                'category' => 'Software',
                'author' => 'Divisi Software ATN',
                'tags' => 'Software Development, ERP, Aplikasi Custom, B2B',
                'published_at' => '2026-10-21',
                'views' => 319,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Perbandingan objektif antara menyewa software berlangganan dan membangun sistem informasi custom yang menyesuaikan alur kerja unik perusahaan.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Saat perusahaan mulai berkembang, sistem pencatatan berbasis <em>spreadsheet</em> tidak lagi mampu mengimbangi volume transaksi dan kebutuhan laporan lintas divisi. Pertanyaan besarnya selalu sama: lebih baik berlangganan aplikasi siap pakai (<strong>SaaS</strong>) atau membangun <strong>software custom</strong>?</p>
<h2>Kapan SaaS Sudah Cukup?</h2>
<p class="ql-align-justify">Aplikasi siap pakai sangat cocok untuk kebutuhan generik yang alur kerjanya standar, seperti email perusahaan, akuntansi dasar, atau komunikasi internal tim skala kecil.</p>
<h2>Kapan Perusahaan Membutuhkan Software Custom?</h2>
<ol>
    <li><strong>Alur Persetujuan Khusus:</strong> Ketika struktur operasional memiliki alur <em>approval</em> berjenjang atau aturan bisnis spesifik yang tidak bisa diakomodasi aplikasi umum.</li>
    <li><strong>Integrasi Lintas Sistem:</strong> Membutuhkan sinkronisasi langsung dengan mesin absensi, timbangan pabrik, perangkat IoT, atau API instansi eksternal.</li>
    <li><strong>Kepemilikan Penuh atas Data:</strong> Data operasional sensitif dapat di-<em>hosting</em> di server internal (<em>on-premise</em>) tanpa ketergantungan biaya langganan per pengguna setiap bulan.</li>
</ol>
<blockquote>"Software custom dirancang mengikuti cara kerja terbaik tim Anda—bukan memaksa tim Anda berubah mengikuti keterbatasan aplikasi."</blockquote>
<p class="ql-align-justify">Tim pengembang ATN menerapkan arsitektur modular dan dokumentasi rapi sehingga aplikasi tetap mudah dikembangkan seiring pertumbuhan bisnis di masa depan.</p>
HTML,
            ],
            [
                'title' => 'Digitalisasi Kampus dan Sekolah Menuju Smart Campus: Dari Jaringan Wi-Fi hingga Laboratorium Digital',
                'category' => 'Pendidikan',
                'author' => 'Tim Redaksi ATN',
                'tags' => 'Smart Campus, Pendidikan, Wi-Fi Enterprise, Laboratorium',
                'published_at' => '2026-10-14',
                'views' => 276,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Membangun ekosistem pendidikan berbasis teknologi melalui konektivitas berkapasitas tinggi, sistem informasi akademik, dan ruang kelas interaktif.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Institusi pendidikan modern dituntut menyediakan lingkungan belajar yang kolaboratif sekaligus administrasi akademik yang transparan. Konsep <strong>Smart Campus</strong> menyatukan infrastruktur jaringan yang tangguh dengan perangkat lunak manajemen pendidikan yang mudah diakses.</p>
<h2>Komponen Utama Ekosistem Smart Campus</h2>
<ul>
    <li><strong>Jaringan Wi-Fi High-Density:</strong> Access point kelas enterprise yang mampu menampung ratusan perangkat siswa atau mahasiswa secara bersamaan di ruang kelas dan ujian berbasis komputer (CBT).</li>
    <li><strong>Sistem Informasi Akademik & Absensi:</strong> Pencatatan kehadiran terintegrasi kartu pintar atau biometrik yang langsung tersambung ke laporan akademik.</li>
    <li><strong>Laboratorium Komputer & Smart Classroom:</strong> Pengadaan PC performa stabil, papan tulis interaktif, serta sistem audio-visual yang mendukung pembelajaran hibrida.</li>
</ul>
<p class="ql-align-justify">Dengan perencanaan infrastruktur yang matang dari hulu ke hilir, sekolah dan perguruan tinggi dapat mengoptimalkan anggaran pendidikan untuk teknologi yang benar-benar berdampak pada kualitas pembelajaran.</p>
HTML,
            ],
            [
                'title' => '[Draft] Tren Keamanan Siber dan Backup Data Otomatis untuk Perusahaan Skala Menengah 2027',
                'category' => 'Keamanan',
                'author' => 'Divisi Security System ATN',
                'tags' => 'Cybersecurity, Backup 3-2-1, Ransomware, Enterprise',
                'published_at' => '2026-11-19',
                'views' => 0,
                'is_active' => false,
                'image_url' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Contoh artikel berstatus Draft untuk menguji pengelolaan naskah yang belum dipublikasikan ke halaman depan website.',
                'content' => <<<'HTML'
<p class="ql-align-justify">Ancaman <em>ransomware</em> dan kebocoran data kini tidak hanya menyasar perusahaan multinasional, melainkan juga perusahaan skala menengah yang menyimpan data transaksi pelanggan secara digital.</p>
<h2>Prinsip Backup 3-2-1</h2>
<ul>
    <li><strong>3 Salinan Data:</strong> 1 data utama dan 2 salinan cadangan.</li>
    <li><strong>2 Media Berbeda:</strong> Misalnya penyimpanan server lokal (NAS) dan media eksternal/cloud terenkripsi.</li>
    <li><strong>1 Salinan Off-Site:</strong> Disimpan terpisah dari lokasi kantor utama untuk mitigasi bencana fisik.</li>
</ul>
<p class="ql-align-justify">Artikel ini masih berstatus <strong>Draft</strong> sehingga hanya terlihat di Dasbor Admin dan belum tampil pada halaman publik.</p>
HTML,
            ],
        ];

        foreach ($articles as $index => $item) {
            $slug = Str::slug($item['title']);
            $imagePath = $this->prepareImage($item['image_url'], $index + 1, $item['category']);
            $wordCount = str_word_count(strip_tags($item['content']));
            $readingTime = max(1, (int) ceil($wordCount / 200));

            Blog::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $item['title'],
                    'category' => $item['category'],
                    'author' => $item['author'],
                    'tags' => $item['tags'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'image' => $imagePath,
                    'published_at' => $item['published_at'],
                    'reading_time' => $readingTime,
                    'views' => $item['views'],
                    'is_active' => $item['is_active'],
                    'sort_order' => $index,
                ]
            );
        }
    }

    /**
     * Mengunduh gambar cover ke storage lokal, dengan fallback SVG jika offline.
     */
    private function prepareImage(string $url, int $number, string $category): string
    {
        $jpgPath = "blogs/dummy-blog-{$number}.jpg";

        if (Storage::disk('public')->exists($jpgPath)) {
            return $jpgPath;
        }

        try {
            $response = Http::withoutVerifying()->timeout(15)->get($url);
            if ($response->successful() && strlen($response->body()) > 1000) {
                Storage::disk('public')->put($jpgPath, $response->body());
                return $jpgPath;
            }
        } catch (\Throwable $e) {
            // Lanjut ke fallback SVG lokal jika koneksi tidak tersedia
        }

        $svgPath = "blogs/dummy-blog-{$number}.svg";
        $safeCategory = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="750" viewBox="0 0 1200 750">
    <defs>
        <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#102238"/>
            <stop offset="100%" stop-color="#113883"/>
        </linearGradient>
    </defs>
    <rect width="1200" height="750" fill="url(#bg)"/>
    <circle cx="1040" cy="120" r="220" fill="#F8B41C" fill-opacity="0.12"/>
    <circle cx="160" cy="640" r="180" fill="#FFFFFF" fill-opacity="0.06"/>
    <text x="80" y="360" fill="#F8B41C" font-family="Arial, sans-serif" font-size="28" font-weight="bold" letter-spacing="4">ARJUNA TRAVORA NUSANTARA</text>
    <text x="80" y="425" fill="#FFFFFF" font-family="Arial, sans-serif" font-size="56" font-weight="bold">{$safeCategory}</text>
</svg>
SVG;

        Storage::disk('public')->put($svgPath, $svg);
        return $svgPath;
    }
}
