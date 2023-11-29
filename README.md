## Demo login info

admin: admin@sge.com | password: password

teacher: teacher@sge.com | password: password

student: student@sge.com | password: password

## Installation

```
git clone https://github.com/AnikRifat/curlware.git
cd blog
composer install
cp .env.sge .env
php artisan key:generate
php artisan migrate:fresh --seed

```
