# Fast Laravel Testing

Festing is a very very great name made by combining the words fast and testing. Because that is what this package is for. Faster tests in Laravel. The package is inspired by a great article from [Nate Denlinger](https://natedenlinger.com/my-suggestions-to-speed-up-testing-with-laravel-and-phpunit/).

## Installation

Installation and setup time is estimated to be around 5 minutes in existing Laravel projects and 2 minutes in new projects. Install this package via composer.

```bash
composer require-dev dees040/festing
```

If you're using Laravel >= 5.5 this package will automatically be added to your providers list. If using a lower version, add the service provider to the `providers` array in `config/app.php`.

```php
dees040\Festing\ServiceProvider::class,
```

You're now ready for setup.

## Setup

First you should update the `config/database.php` config file. We should add a connection for testing. You can use the following array.

```php
'testing' => [
    'driver' => 'sqlite',
    'database' => database_path('testing.sqlite'),
    'prefix'   => '',
]
```

In the package config you can specify which connection to use while testing. By default it will use the `testing` connection, which we've just added to the `connections` array. You should also add or update this in `<php>` tag located in the `phpunit.xml` file.

```xml
<env name="DB_CONNECTION" value="testing"/>
```

Because Laravel don't have an option to boot your testing traits like the model traits we need to add a little bit of functionality to you're `tests/TestCase.php` file. If haven't overwritten the `setUpTraits()` method yet, you can add this to the `TestCase.php`.

```php
/**
 * Boot the testing helper traits.
 *
 * @return array
 */
protected function setUpTraits()
{
    $uses = parent::setUpTraits();
    
    if (isset($uses[\dees040\Festing\FestTheDatabase::class])) {
        $this->runFester();
    }
    
    return $uses;
}
```

If you already overwritten the `setUpTraits()` method just add the if statement to the method body.

### In test cases

You can use the trait like any other Laravel testing trait. It replaces the `RefreshDatabase` trait. So in your test case use the `FestTheDatabase` trait.

```php
<?php

namespace Tests\Unit;

use Tests\TestCase;
use dees040\Festing\FestTheDatabase;

class ExampleTest extends TestCase
{
    use FestTheDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
```

## Config

Check the [config file](https://github.com/dees040/festing/blob/master/src/config/festing.php) for descriptions about all the config.