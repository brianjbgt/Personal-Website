# Personal-Website
A resume maker built on Laravel 6 and VueJs 2.

To Run app in Development:
1. Run DB.sql
2. Install composer and node in your machine
3. Go to your repo and install the dependencies by running:
		- "composer install"
		- "npm install"
4. Rename ".env.example" to ".env" then make the necessary modifications:
	DB_DATABASE=personal
	DB_USERNAME=root <- Change these to your respective usename and password
	DB_PASSWORD=

5. Run the command to generate a key "php artisan key:generate"
6. "npm run dev" to compile the javascript and css files or
	"npm run watch" to compile javascript and css files for every modification done
7. Start the server by typing "php artisan serve"

Dummy account for login:
Username: admin
Password: 12345678

Project Application is still a work in progress
