# Juragan Event - Platform Tiket untuk Semua Jenis Acara 🎫

**Juragan Event** adalah platform berbasis web yang dirancang untuk mempermudah proses penyelenggaraan acara dan penjualan tiket. Baik Anda mengadakan konser, seminar, atau workshop, Juragan Event menyediakan solusi lengkap untuk penyelenggara dan peserta acara.


1. **Pengaturan Kategori Event yang Fleksibel**  
   Memungkinkan admin untuk membuat dan mengatur berbagai kategori event sesuai kebutuhan. Fitur ini memberi kebebasan dalam mengelompokkan acara berdasarkan tema, jenis acara, atau audiens target.

2. **Kelola Blog atau Postingan**  
   Admin dapat membuat, mengedit, dan mengelola postingan blog terkait acara. Fitur ini berguna untuk membagikan informasi penting atau berita terbaru terkait event yang akan datang.

3. **Kelola Galeri Event**  
   Dokumentasikan acara yang telah diselenggarakan dengan fitur galeri yang memungkinkan admin untuk mengunggah dan mengelola foto dari event sebelumnya, memberikan gambaran visual kepada pengguna tentang acara-acara yang diadakan.

4. **Pengaturan Metode Pembayaran yang Bisa Disesuaikan**  
   Integrasi dengan berbagai gateway pembayaran memberikan fleksibilitas dalam memilih metode pembayaran yang diinginkan oleh penyelenggara acara, baik melalui transfer bank, kartu kredit, atau pembayaran digital lainnya.

5. **Kelola Event atau Acara**  
   Penyelenggara dapat mengelola setiap detail dari event, termasuk nama acara, deskripsi, tanggal, waktu, dan status acara. Semua informasi ini bisa disesuaikan berdasarkan kebutuhan penyelenggara.

6. **Kelola Alamat Event**  
   Admin bisa dengan mudah mengatur dan memperbarui lokasi event, dengan integrasi Google Maps untuk kemudahan penentuan alamat yang tepat dan mudah diakses oleh peserta.

7. **Kelola Tiket dengan Opsi Pembayaran Gratis atau Berbayar**  
   Menyediakan fleksibilitas dalam mengelola tiket, baik yang berbayar maupun gratis. Admin dapat menentukan jumlah tiket, harga, dan jenis pembayaran sesuai dengan event yang diadakan.

8. **Fitur Refund**  
   Admin dapat mengelola pengembalian dana (refund) tiket sesuai dengan kebijakan yang berlaku, memastikan kenyamanan dan keamanan bagi peserta yang memerlukan pengembalian tiket.

9. **Fitur Catatan Transaksi**  
   Mencatat semua transaksi tiket yang terjadi, baik itu pembelian atau refund, memberikan visibilitas penuh terhadap aliran dana dalam platform.

10. **Fitur Kelola Hak Akses (Role & Permission Management)**  
    Memungkinkan admin utama untuk mengatur siapa saja yang dapat mengakses dan mengelola berbagai bagian dari sistem. Pengaturan berbasis peran dan izin ini memberikan kontrol penuh atas aksesibilitas tiap pengguna.

## Teknologi yang Digunakan 🛠️
- **Backend**: Laravel
- **Frontend**: Laravel, Bootstrap
- **Database**: MySQL

## Cara Memulai 🚀

Untuk menjalankan project ini di lokal, ikuti langkah-langkah berikut:

### Persyaratan
Pastikan kamu sudah menginstal software berikut:
- PHP 8.x
- Composer
- Node.js & NPM
- MySQL

### Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/username/Juragan-Event.git

2. Masuk ke direktori project:
   ```bash 
   cd Juragan-Event

3. Install dependencies:
   ```bash 
   composer install

4. Atur file environment:
   ```bash
   - Duplikat file .env.example menjadi .env.
   - Ubah detail konfigurasi di file .env sesuai dengan pengaturan database dan konfigurasi lainnya.

5. Jalankan migrasi database:
   ```bash 
   php artisan migrate --seed

6. Jalankan server development:
   ```bash 
   php artisan serve
