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

``` php
$skeleton = new HelpSpot\HelpSpot();
echo $skeleton->echoPhrase('Hello, League!');
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ianlandsman@userscape.com instead of using the issue tracker.

## Credits

- Ian Landsman

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
