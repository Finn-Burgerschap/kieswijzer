## Installation
1. To start using this project you should clone the repo.
```bash
git clone git@github.com:F1nnG/kieswijzer.git
```
2. Run the composer install command.
```bash
composer install
```
3. Run the npm install command.
```bash
npm install
```
4. Run the npm run build command.
```bash
npm run build
```
5. Copy the .env.example to .env, and configure the .env file to your liking.
```bash
cp .env.example .env
```
6. Generate a Laravel key.
```bash
php artisan key:generate
```
7. Run the migration & seeder.
```bash
php artisan migrate:fresh --seed
```

## Running a Laravel server
After you followed the installation steps you can start running a Laravel server. and access the [localhost:8000](http://localhost:8000) route.
```bash
php artisan serve
```