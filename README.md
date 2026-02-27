<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

1. Clone repository
```
git clone https://github.com/Orlandd/mediatama-manajemen-video.git
```

2. Masuk ke folder project
```
cd nama-repo
```

3. Install dependency backend
```
composer install
```

4. Install dependency frontend
```
npm install
```

5. Copy file environment
```
cp .env.example .env
```

6. Generate application key
```
php artisan key:generate
```

7. Konfigurasi database di file .env
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

8. Jalankan migrasi database
```
php artisan migrate
```

9. Jalankan seeder database (jika ada)
```
php artisan db:seed
```

10. Buat symbolic link storage
```
php artisan storage:link
```

11. Jalankan server Laravel
```
php artisan serve
```

12. Jalankan frontend 
```
npm run dev
```

13. Buka aplikasi di browser
```
http://127.0.0.1:8000
```

14. Akun default (jika menggunakan seeder)
```
Admin
email: admin@example.com
password: password
```
15. Jika terjadi error
```
php artisan optimize:clear
composer dump-autoload
```

