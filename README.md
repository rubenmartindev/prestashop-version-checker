# PrestaShop Version Checker

A lightweight library to check and compare PrestaShop versions with a fluent API.

## Installation

```bash
composer require rubenmartindev/prestashop-version-checker
```

## Requirements

- PHP >= 5.6.0
- PrestaShop (any version)

## Usage

### Using the helper function (recommended)

```php
// Check if PrestaShop version is less than 1.7
if (is_ps_version('<1.7')) {
    // PrestaShop 1.6.x code
}

// Check if PrestaShop version is greater than or equal to 1.7
if (is_ps_version('>=1.7')) {
    // PrestaShop 1.7+ code
}
```

### Using the class directly

```php
use RubenMartinDev\PrestaShopVersionChecker\PrestaShopVersionChecker;

if (PrestaShopVersionChecker::is('<1.7')) {
    // PrestaShop 1.6.x code
}
```

### Supported operators

| Operator | Description            |
|----------|------------------------|
| `<`      | Less than              |
| `<=`     | Less than or equal     |
| `>`      | Greater than           |
| `>=`     | Greater than or equal  |
| `==`     | Equal                  |
| `=`      | Equal (alias)          |
| `!=`     | Not equal              |
| `<>`     | Not equal (alias)      |
| `lt`     | Less than              |
| `le`     | Less than or equal     |
| `gt`     | Greater than           |
| `ge`     | Greater than or equal  |
| `eq`     | Equal                  |
| `ne`     | Not equal              |

### Shorthand methods

> [!WARNING]
> The shorthand methods are deprecated and will be removed in the next major release.

```php
use RubenMartinDev\PrestaShopVersionChecker\PrestaShopVersionChecker;

// Less than
PrestaShopVersionChecker::lt('1.7');    // Same as is('<1.7')

// Less than or equal
PrestaShopVersionChecker::lte('1.7');   // Same as is('<=1.7')

// Greater than
PrestaShopVersionChecker::gt('1.6');    // Same as is('>1.6')

// Greater than or equal
PrestaShopVersionChecker::gte('1.7');   // Same as is('>=1.7')

// Equal
PrestaShopVersionChecker::eq('1.7.8');  // Same as is('==1.7.8')

// Not equal
PrestaShopVersionChecker::neq('1.6');   // Same as is('!=1.6')
```

## Check if the `compare` is valid

```php
use RubenMartinDev\PrestaShopVersionChecker\PrestaShopVersionChecker;

PrestaShopVersionChecker::isCompareValid('<1.7');    // true
PrestaShopVersionChecker::isCompareValid('gt 1.7');  // true

PrestaShopVersionChecker::isCompareValid(1.7);       // false
PrestaShopVersionChecker::isCompareValid('foobar');  // false
```

## Real-world example

```php
class MyModule extends Module
{
    public function hookDisplayHeader()
    {
        if (is_ps_version('<1.7')) {
            return $this->display(__FILE__, 'views/templates/hook/header_16.tpl');
        }

        return $this->display(__FILE__, 'views/templates/hook/header.tpl');
    }
}
```
