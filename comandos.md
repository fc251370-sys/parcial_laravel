spatie permios

composer require spatie/laravel-permission

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

---------------------------------------------------------------------------------

git remote add origin https://github.com/fc251370-sys/parcial_laravel.git
git branch -M main
git push -u origin main


-------------------------------------------------------------------------------

php artisan make:seeder RoleAndPermissionSeeder

-----------------------------------------------------------

php artisan make:model NombreDelModelo

--------------------------------------------------

php artisan make:controller NombreController --api