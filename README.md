# Magento 2 Module Db Connection Manager

    k911k/module-db-connection-manager

## Main Functionalities
This module brings easy possibility to switch between connections from master to slave (replica) db.

You can use master and slave connection even inside one method. Zero performance impact.

## Trick or Treat!
If you want say thanks - please feel free to do it:
- Send any token, any amount on Solana network to address: AkLa9Dgkb1PSE6kESsAAtdakGMQvjRgU9rtwVAgJz9pC
- Also, you can see all the donations on https://solscan.io/account/AkLa9Dgkb1PSE6kESsAAtdakGMQvjRgU9rtwVAgJz9pC

## Usage
- add connection to slave (replica) db in app/etc/env.php, can be copied and updated from the default
```php
'slave' => [
    'host' => 'localhost',
    'dbname' => 'magento',
    'username' => 'magento',
    'password' => 'magento',
    'model' => 'mysql4',
    'engine' => 'innodb',
    'initStatements' => 'SET NAMES utf8;',
    'active' => '1'
 ],
```
- In place where you want to switch connection to replica db just use:
```php
   \K911K\DbConnectionManager\Service\SwitchDbConnection::switch('slave');
```

and starting from this point all queries will be performed on slave (replica) db.

- You can have multiple replicas - so just switch to any of them: switch('slave-2'). Just do not forget to add it to app/etc/env.php db configuration.
- Multiple switch in one method:
```php
// switch to replica db to retrieve data
\K911K\DbConnectionManager\Service\SwitchDbConnection::switch('slave');
$quote = $this->quoteRepository->get($quoteId);
if (!$quote || !$quote->getIsActive()) {
    return;
}
$quote->setIsActive(false);
// switch to default (master) db to save data
\K911K\DbConnectionManager\Service\SwitchDbConnection::switch('default');
$this->cartRepository->save($quote); 
```
             
## Options to use
- On graphql queries switch to replica as all queries only retrieves data from the db.
- At the beginning (before plugin) on any Controller that only retrieves data from the db.
- Example: before plugin for \Magento\Catalog\Controller\Product\View::execute to read product details only from the replica db.


## Warning
1. If you have switched the connection to the slave (replica) but a write query is somewhere inside, 
it will not be processed, and an exception will be thrown. Inside exception.log you will see such error:
`main.CRITICAL: PDOException: SQLSTATE[HY000]: General error: 1290 The MySQL server is running 
with the --read-only option so it cannot execute this statement` and exactly which request tried to be
performed.

2. If you have connection to master db and load customer with the repository->get and after - switch connection and try
to load customer by the same email - you will get customer entity from the first get request as magento repositories
caches entities to not load it multiple times if it wasn't changed.

## Installation

### Type 1: Zip file

 - Unzip the zip file inside `app/code/K911K/`
 - Enable the module by running `php bin/magento module:enable K911K_DbConnectionManager`
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Add the composer repository to the configuration by running
   `composer config repositories.k911k git https://github.com/K911K/magento2-switch-db-connection.git`
 - Install the module composer by running `composer require k911k/module-db-connection-manager`
 - enable the module by running `php bin/magento module:enable K911K_DbConnectionManager`
 - Flush the cache by running `php bin/magento cache:flush`

## Trick or Treat!
If you want to buy me a coffee or tea - please feel free to do it:
- Send any token, any amount on Solana network to address: AkLa9Dgkb1PSE6kESsAAtdakGMQvjRgU9rtwVAgJz9pC
- Also you can see all the donations https://solscan.io/account/AkLa9Dgkb1PSE6kESsAAtdakGMQvjRgU9rtwVAgJz9pC

#### Easter Egg
- Do you know the answer to the question in the second commit message? :) ? 