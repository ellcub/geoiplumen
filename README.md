# Geo IP Country Whois application

## Installation
1. Clone the repo, eg. `git clone git@github.com:ellcub/geoiplumen.git`
2. In the project folder, copy .env.example to .env `cp .env.example .env`
3. Set up a database and add the details to the `.env`
4. Run `composer install` to install dependencies
5. Run the database migrations `php artisan migrate`
6. Populate the database (see below) `php artisan app:populate-data`
7. Serve the application using the built-in PHP development server `php -S localhost:8000 -t public`

## Usage
### Populating the database from the remote zip file
From the project folder, run 
```bash
php artisan app:populate-data
```
(See installation step 6)

### The API Endpoint
Using a web browser (or Postman), go to `http://localhost:8000/locationByIP?IP=2.20.183.200` 
and replace `2.20.183.200` with any IP address.


### Running unit tests
From the project folder, run 
```bash
vendor/bin/phpunit
```


## Design decisions

### Lumen
This tiny app doesn't require the full power of Laravel, so I decided to try Lumen.

### Database
#### Data types
In MySQL the INT type has an unsigned range of 0 to 4,294,967,295.  
According to https://dev.maxmind.com/geoip/legacy/csv/ the largest possible number for the IP address as integer field is also 4,294,967,295.  
Therefore we can use INT rather than BIGINT.

Other hints for appropriate data types are also at https://dev.maxmind.com/geoip/legacy/csv/

#### Data Population
MySQL's LOAD DATA INFILE is used.  This gives much faster loading than looping through the CSV line by line for example.

#### Indexes
Indexes have been added to the columns we search on for faster searches.

