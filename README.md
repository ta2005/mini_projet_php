# Good stuff
good PHP + PostgreSQL stuff
# how do I run good PHP stuff?
## PREPARE ENVIRONMENT
### Arch Bros
First, let us get our packages...
```bash
sudo pacman -Syu php php-pgsql postgresql
```
We then initialize and start database...
```bash
sudo -iu postgres initdb -D /var/lib/postgres/data
sudo systemctl enable --now postgresql
```
Let us enable PHP extensions
* Open config file: `sudo nano /etc/php/php.ini`
* Uncomment `extension=pdo_pgsql` and `extension=pgsql`
* Save and exit
### windows.
* Install PostgreSQL from PostgreSQL website
* Download the Thread Safe ZIP from windows.php.net. Extract it to `C:\php` and add that your system environment path variables.
* Rename `php.ini-development` to `php.ini` in that folder
* Inside this file, uncomment `extension=pdo_pgsql` and `extension=pgsql`
## DATABASE INITIALIZATION
### Arch Bros
```bash
# Create DB
sudo -u postgres psql -c "CREATE DATABASE gestion_etudiants;"

# Execute our sql.sql
sudo -u postgres psql -d gestion_etudiants -f /path/to/sql.sql
```
For execution, it may not work because it can be located deep inside your home directory. A quick fix is through:
```bash
# Execute our sql.sql
cat  /path/to/sql.sql | sudo -u postgres psql -d gestion_etudiants
```
### windows.
open the SQL shell `psql` then run these:
```sql
-- Create DB
CREATE DATABASE gestion_etudiants;

-- Use DB
\c gestion_etudiants

-- Execute our sql.sql
\i 'C:/path/tp/sql.sql'
```
## FIRE IT UP
Simply run:
```
php -S localhost:8000
```
