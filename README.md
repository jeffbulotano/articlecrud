# Shorturl

Shorturl is a small web application built with Lumen and VueJS. 

## Installation
Clone the repo and enter the directory: 

```
git clone git@github.com:jeffbulotano/articlecrud.git articlecrud

cd articlecrud
```

Install packages:

```
composer install
```
or if you don't need dev dependencies:
```
composer install --no-dev
```

Copy sample environment file:
```
cp .env.example .env
```

Modify .env file with your preferred text editor:

*NOTE It is important that you change APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD for the application to work.

Run migration:
```
php artisan migrate
```

Your app is now ready!

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.