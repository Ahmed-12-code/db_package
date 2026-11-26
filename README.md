# createivo/db

A small PHP query builder for MySQL, built on `mysqli`. Published on Packagist as [`createivo/db`](https://packagist.org/packages/createivo/db).

This is a learning project. Methods build an SQL string and run it with `mysqli_query`. Values are not escaped and prepared statements are not used, so do not pass untrusted input (such as raw user input) to it.

## Install

```bash
composer require createivo/db
```

Requires PHP with the `mysqli` extension.

## Usage

```php
<?php
require 'vendor/autoload.php';

use Createivo\Db\dp;

// host, user, password, database, table
$db = new dp('localhost', 'root', '', 'shop', 'products');

// select: all() prints the rows
$db->select('id, name, price')->condition('price > 100')->all();

// insert: execute() prints the number of affected rows
$db->insert(['name' => 'Keyboard', 'price' => 250])->execute();

// update
$db->update(['price' => 200])->condition('id = 1')->execute();

// delete
$db->delete()->condition('id = 1')->execute();
```

## Methods

| Method | What it does |
| --- | --- |
| `select($columns = '*')` | Starts a `select` query. |
| `insert(array $data)` | Starts an `insert` query from a column => value array. |
| `update(array $data)` | Starts an `update` query from a column => value array. |
| `delete()` | Starts a `delete` query. |
| `condition($cond)` | Adds a `where` clause (a raw SQL string). |
| `execute()` | Runs the query and prints the affected row count. |
| `all()` | Runs the query and prints all rows with `print_r`. |

## Notes

- Methods are chained, and each query is built on one table, set in the constructor.
- `execute()` and `all()` print their result instead of returning it.
- Namespace: `Createivo\Db`, class: `dp`, autoloaded with PSR-4 from `src/`.
