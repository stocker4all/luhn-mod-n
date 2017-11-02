# luhn-mod-n

[![Build Status](https://travis-ci.org/stocker4all/luhn-mod-n.svg?branch=master)](https://travis-ci.org/stocker4all/luhn-mod-n) [![Latest Stable Version](https://poser.pugx.org/stocker4all/luhn-mod-n/version)](https://packagist.org/packages/stocker4all/luhn-mod-n) [![License](https://poser.pugx.org/stocker4all/luhn-mod-n/license)](https://packagist.org/packages/stocker4all/luhn-mod-n) [![Total Downloads](https://poser.pugx.org/stocker4all/luhn-mod-n/downloads.png)](https://packagist.org/packages/stocker4all/luhn-mod-n)

`luhn-mod-n` is a very simple solution to generate and verify [luhn mod n](https://en.wikipedia.org/wiki/Luhn_mod_N_algorithm) checksums. Possible bases (value for n) are between 2 and 36.
Luhn mod 10 is well known from the credit card number checksum. But also in different bases it can be useful to have this checksum functionality.

**Example for base 2:**

Input
```
1001001100101100000001011010010
```

Output (number with checksum)

```
10010011001011000000010110100100
```

**Example for base 10:**

Input
```
1234567890
```

Output (number with checksum)

```
12345678903
```

**Example for base 16:**

Input
```
499602d2
```

Output (number with checksum)

```
499602d2f
```

**Example for base 36:**

Input
```
kf12oi
```

Output (number with checksum)

```
kf12ois
```

## Installing

You can use [Composer](http://getcomposer.org/) to add the [package](https://packagist.org/packages/stocker4all/luhn-mod-n) to your project:

```json
{
  "require": {
    "stocker4all/luhn-mod-n": "~0.1"
  }
}
```

## Usage example

```php
//Base 10 example

$luhnModN = new \S4A\LuhnModN();

$number = 1234567890;

// Generate checksum and return it concatenated to given number
$numberWithChecksum = $luhnModN->createChecksum($number, 10);

echo $numberWithChecksum . "\n";

// Generate checksum and return only checksum
$onlyChecksum = $luhnModN->createChecksum($number, 10, false);

echo $onlyChecksum . "\n";

// Verify the checksum
if($luhnModN->hasValidChecksum($numberWithChecksum, 10)){
    echo "Valid checksum\n";
}
```

This example will result in the following output:

```
12345678903
3
Valid checksum
```

## Tests

Some very basic tests are provided in the `tests/` directory. Run them with `composer install --dev && vendor/bin/phpunit`.

## License

`luhn-mod-n` is licensed under [MIT](LICENSE.md)