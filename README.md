clone
composer install
cp .env.example .env
php artisan key:generate
php artisan config:clear
clear_laravel
# kotaku
- bikin route baru di routes/web.php : Route::get('/test', 'TestController@index');
- bikin controller nya + method nya
	app/Http/Controllers
- di controller manggil view nya
	resources\views
