# HelpSpot Help Desk Software

This is the PHP SDK to the HelpSpot API. The SDK can work with both the public and private (staff) API.

Please read the full documentation for each API method here:

* [API Overview](https://support.helpspot.com/index.php?pg=kb.page&id=161)
* [Public API Methods](https://support.helpspot.com/index.php?pg=kb.page&id=163) - Access as the customer
* [Private API Methods](https://support.helpspot.com/index.php?pg=kb.page&id=164) - Access as a staff person with a HelpSpot license

## Install

Via Composer

``` bash
$ composer require helpspot/helpspot
```

## Loading

If your framework handles autoloading you can simply use a **use** statement at the top of your php
file to access HelpSpot. If it doesn't, you can load in HelpSpot with the require statement shown below plus using the **use** statement at the top of the file you want to access HelpSpot in.

```php
require_once "vendor/autoload.php";

use helpspot\helpspot\helpspot;

// Access HelpSpot in your functions and methods in this file
```

## Usage

### Create a request using the private api

```php
$helpspot = new helpspot('https://company.helpspot.com', 'user@example.com', 'password');

$helpspot->post('private.request.create', [
    'sEmail' => 'customer@company.com',
    'tNote' => 'testing',
    'xCategory' => 1
]);
```

### Update a request using the private api

```php
$helpspot = new helpspot('https://company.helpspot.com', 'user@example.com', 'password');

$helpspot->post('private.request.update', [
    'xRequest' => 12400,
    'fNoteType' => 1, // A public note
    'tNote' => 'Update the request with this note.',
]);
```

### Get a request using the private api

```php
$helpspot = new helpspot('https://company.helpspot.com', 'user@example.com', 'password');

$request = $helpspot->get('private.request.get', [
    'xRequest' => 12400
]);

echo $request->sEmail;
```

### Create a request using the public api

```php
$helpspot = new helpspot('https://company.helpspot.com');

$helpspot->post('request.create', [
    'sEmail' => 'customer@company.com',
    'tNote' => 'testing'
]);
```

### Checking for errors

```php
$helpspot = new helpspot('https://company.helpspot.com', 'user@example.com', 'password');

$request = $helpspot->get('private.request.get', [
    'xRequest' => 12400
]);

if($helpspot->hasError())
{
    foreach($helpspot->getErrors() as $error)
    {
        echo $error->id .' '. $error->description;
    }
}
else
{
    echo $request->sEmail;
}
```

## Security

If you discover any security related issues, please email customer.service@userscape.com instead of using the issue tracker.

## Credits

- UserScape Inc.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
