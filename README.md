# HelpSpot Help Desk Software

This is the PHP SDK to the HelpSpot API. The SDK can work with both the public and private (staff) API.

Please read the full documentation for each API method here:

* [API Overview](https://support.helpspot.com/index.php?pg=kb.page&id=161)
* [Public API Methods](https://support.helpspot.com/index.php?pg=kb.page&id=163)
* [Private API Methods](https://support.helpspot.com/index.php?pg=kb.page&id=164)

## Install

Via Composer

``` bash
$ composer require HelpSpot/HelpSpot
```

## Usage

### Create a request

``` php
require_once "vendor/autoload.php";

use HelpSpot\HelpSpot\HelpSpot;

$helpspot = new HelpSpot('https://company.helpspot.com/', 'user@example.com', 'password');

$helpspot->post('private.request.create', [
    'sEmail' => 'customer@company.com',
    'tNote' => 'testing',
    'xCategory' => 1
]);
```

### Update a request

``` php
require_once "vendor/autoload.php";

use HelpSpot\HelpSpot\HelpSpot;

$helpspot = new HelpSpot('https://company.helpspot.com/', 'user@example.com', 'password');

$helpspot->post('private.request.update', [
    'xRequest' => 12400,
    'fNoteType' => 1, // A public note
    'tNote' => 'Update the request with this note.',
]);
```

### Get a request

``` php
require_once "vendor/autoload.php";

use HelpSpot\HelpSpot\HelpSpot;

$helpspot = new HelpSpot('https://company.helpspot.com/', 'user@example.com', 'password');

$request = $helpspot->get('private.request.get', [
    'xRequest' => 12400
]);

echo $request->sEmail;
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ianlandsman@userscape.com instead of using the issue tracker.

## Credits

- UserScape

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
