# Geo IP Country Whois application

## Design decisions

### Lumen

### Database

In MySQL the INT type has an unsigned range of 0 to 4,294,967,295.  
According to https://dev.maxmind.com/geoip/legacy/csv/ the largest possible number for the IP address as integer field is also 4,294,967,295.  
Therefore we can use INT rather than BIGINT.

## Populating the database from the remote zip file
From the project folder, run 
```bash
php artisan app:populate-data
```
