Author: <a href="https://www.facebook.com/pham.v.trong.334">**Phạm Văn Trọng**</a>
##create file environment (.env)
run `cp .env.example .env` or `copy .env.example .env`

## Fill info connect to database on .env
>DB_DATABASE=your_database
> 
>DB_USERNAME=your_username
> 
>DB_PASSWORD=your_password
#Install composer
run `composer install`
#Generate app key
run `php artisan key:generate`
#Create tables database
run `php artisan migrate`
#Seeding data
`php artisan db:seed`
