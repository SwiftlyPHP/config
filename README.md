# Swiftly - Config
## About

The Swiftly Config component is a very simple, small and low footprint config
management utility that tries to make working with custom configuration files as
straightforward as possible.

## Usage

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
// Import config value store
use Swiftly\Config\Store;

$json = file_get_contents( 'path/to/file.json' );
$json = json_decode( $json, true );

if ( json_last_error() !== JSON_ERROR_NONE ) {
    // Handle errors...
}

// Wrap values
$config = new Store( $json );

// Get named value
$value = $config->get( 'value', 'default' );
```


// TODO

## Reference

// TODO
