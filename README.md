# Hopix - Web Frameworks Project

Hopix is a beer rating website.
Users can discover, rate and review beers from all over Belgium. Site admins can add, edit and remove beers in a backoffice.


## API

### Link (local): https://hopix.test 

### Technologies used:
- Laravel
- MySQL
- Apache web server

### Available languages:
- English
- Dutch

### Available endpoints

The server provides endpoints for:
- Beers
- Breweries
- Aromas
- Languages
- Reviews
- Translations
- Accounts

### How to deploy locally:
1. Git pull this repository to your IDE
2. Install the used technologies
3. Install Laragon OR Herd
4. Make .env and add your database credentials
5. Run the command `composer install` to install all the required dependencies
6. Run the command `php artisan app:init` to generate the tables and insert the initial data
