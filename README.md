<h1 align="center">Welcome to SightSeeing app 👋</h1>
<p>
</p>

> Search for sights around you and buy tickets to visit them.

## Install

-   Clone this repository locally with `git clone git@github.com:antoniyadev/sightseeing.git`
-   Copy the .env.example file to .env
-   Install the PHP dependencies with `composer install`
-   Generate a new app key with `php artisan key:generate`
-   Prepare the database by running `php artisan migrate`
-   (Optional) Seed the database by running:
    `php artisan db:seed --class=WorldSeeder && php artisan db:seed --class=DatabaseSeeder`
-   Install and compile the front-end dependencies with `npm install && npm run dev`
-   Set a valid APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD value in your .env file
-   Serve the website locally by running `php artisan serve`

## Author

👤 **Antoniya**

-   Website: https://antoniyadev.github.io
-   Github: [@antoniyadev](https://github.com/antoniyadev)

## Show your support

Give a ⭐️ if this project helped you!

---

_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
