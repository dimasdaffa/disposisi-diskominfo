# Menginstal semua dependensi, menyiapkan .env, membuat kunci aplikasi, dan membangun aset front-end.
setup:
	composer install
	npm install
	cp .env.example .env
	php artisan key:generate
	php artisan storage:link
	npm run build

# Menyiapkan database dengan data penting (users, config).
setup-db:
	php artisan migrate
	php artisan db:seed --class=UserSeeder
	php artisan db:seed --class=ConfigSeeder

# Menyiapkan database dengan data dummy untuk pengembangan.
setup-dummy:
	php artisan migrate --seed

# Menjalankan server pengembangan. Gunakan ini setelah menjalankan 'setup' dan 'setup-db'.
run:
	php artisan serve
