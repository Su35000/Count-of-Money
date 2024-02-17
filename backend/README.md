# Technos
- Symfony 6.3

# phpMyAdmin
##### Credentials
- **server** : mariadb
- **user** : user
- **password** : 

# Init
- `su bitnami`
- `composer install`
- `php bin/console doctrine:migrations:migrate --no-interaction`

### Fixtures

- Optionnal : `php bin/console d:d:d -f`
- Optionnal : `php bin/console d:d:c`
- Optionnal : `php bin/console d:s:u -f`
- `php bin/console d:f:l`

###### Default Users
- john@doe.com - azerty 

# JWT Config
- `php bin/console lexik:jwt:generate-keypair`