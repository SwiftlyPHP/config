# Swiftly - Config
## About

The Swiftly Config component is a very simple, small and low footprint config
management utility that tries to make working with custom configuration files as
straightforward as possible.

## Usage
### Basics

If your application makes use of files to store named configuration values,
(saved for example as json) it is highly likely you will have had to write code
like the following at one point or another:

```php
$json = file_get_contents( 'path/to/file.json' );
$json = json_decode( $json, true );

if ( json_last_error() !== JSON_ERROR_NONE ) {
    // Handle errors...
}

// Get named value
if ( isset( $json['value'] ) ) {
    $value = $json['value'];
} else {
    $value = 'default';
}
```

To help make this flow somewhat more naturally - and to provide a helpful
abstraction - the Config component can be used instead.

```php
// Import config namespace
use Swiftly\Config\Store;

$json = file_get_contents( 'path/to/file.json' );
$json = json_decode( $json, true );

if ( json_last_error() !== JSON_ERROR_NONE ) {
    // Handle errors...
}

// Wrap values
$config = new Store( $json );

// Get named value (or return default)
$value = $config->get( 'value', 'default' );
```

Now we can simply access values using the `get()` method, optionally returning
a default value if the named key doesn't exist.

To further reduce the amount of boilerplate code, we've also provided loaders
for some of the more commonly used file formats.

```php
// Import config namespace
use Swiftly\Config\Store;
use Swiftly\Config\Loader\JsonLoader;

// Prepare file for loading
$json_file = new JsonLoader( 'path/to/file.json' );

// Create value store
$config = new Store();
$config->load( $json_file );

// Get named value (or return default)
$value = $config->get( 'value', 'default' );
```

If you want to be really terse, you can condense it down even further!

```php
// Import config namespace
use Swiftly\Config\Store;
use Swiftly\Config\Loader\JsonLoader;

// Load file into config store
$config = ( new Store() )->load(
    new JsonLoader( 'path/to/file.json' );
);

// Get named value (or return default)
$value = $config->get( 'value', 'default' );
```

### Hierarchy

It is not uncommon for config values to be nested under one (or several) groups.
A good example of this is the `php.ini` config file, which contains identifiers
such as 

// TODO

## Reference

// TODO
