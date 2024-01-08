# SprykerProject code for Symfony's DependencyInjection container

License: [MIT](LICENSE)

This package integrates Symfony's DependencyInjection component into Spryker.

### Installation

```
composer require spryker-project/di
```

### Configuration

To enable the code you need to update your config_default.php file:

```php
$config[KernelConstants::CORE_NAMESPACES] = [
    'SprykerProject',
    'Spryker',
];
```

This will enable the code in your project. SprykerProject files will now be loaded before Spryker files.
