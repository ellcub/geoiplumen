# Geo IP Country Whois application

## Installation
1. Clone the repo
2. Set up a database and add the details to the `.env`
3. Set up your host / webserver.  I used Homestead and called this geoiplumen.test, so in my  `.env` I have `APP_URL=http://geoipapp.test/`
4. Run `composer install` to install dependencies

## Usage
### Populating the database from the remote zip file
From the project folder, run 
```bash
php artisan app:populate-data
```

### The API Endpoint
Using Postman or a web browser, go to `http://geoiplumen.test/locationByIP?IP=2.20.183.200` where `http://geoiplumen.test`
is you APP_URL, and replace `2.20.183.200` with any IP address.


### Running unit tests
From the project folder, run 
```bash
phpunit
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
Indexes have been added to the columns we search on for faster searches

