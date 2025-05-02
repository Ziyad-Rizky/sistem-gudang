# Sistem Gudang

## Persyaratan Sistem
- PHP 8.0 atau lebih baru
- Composer
- Node.js 16.x atau lebih baru
- SQLite (atau database lain yang didukung Laravel)
- Git (opsional)

## Instalasi
1. Clone repositori ini:
   ```bash
   git clone https://github.com/username/sistem-gudang.git
   ```
   Atau download sebagai ZIP dan ekstrak

2. Masuk ke direktori proyek:
   ```bash
   cd sistem-gudang
   ```

3. Install dependensi PHP:
   ```bash
   composer install
   ```

4. Install dependensi Node.js:
   ```bash
   npm install
   ```

5. Salin file .env.example menjadi .env:
   ```bash
   cp .env.example .env
   ```

6. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```

7. Konfigurasi database di file .env:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database.sqlite
   ```

8. Buat file database SQLite:
   ```bash
   touch database/database.sqlite
   ```

9. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

## Menjalankan Aplikasi

### Development Server
1. Jalankan server Laravel:
   ```bash
   php artisan serve
   ```

2. Jalankan Vite dev server (di terminal terpisah):
   ```bash
   npm run dev
   ```

3. Buka di browser:
   http://localhost:8000

### Production Build
1. Build assets untuk production:
   ```bash
   npm run build
   ```

2. Jalankan server Laravel:
   ```bash
   php artisan serve
   ```

## Testing
Jalankan test dengan perintah:
```bash
php artisan test
```

## Dokumentasi API
Lihat [API_DOCUMENTATION.md](API_DOCUMENTATION.md) untuk dokumentasi endpoint API.

https://ziyadazharurrizky.postman.co/workspace/Ziyad-Azharur-Rizky's-Workspace~8b473b3c-0a76-43ed-809d-3abc98a370c6/request/44623797-61baa9cc-67ea-46b6-9ca9-bde284725826?action=share&creator=44623797&ctx=documentation
