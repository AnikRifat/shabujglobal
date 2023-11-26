## Demo login info

admin: admin@example.com | password: password

manager: manager@example.com | password: password

employee: employee@example.com | password: password

## Installation

```
git clone https://github.com/AnikRifat/curlware.git
cd blog
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed

```
