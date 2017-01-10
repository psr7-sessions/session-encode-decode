:lock_with_ink_pen: PSR7Session encoder/decoder
============================

This library provides a way to encode and decode default session data.

### Installation

The suggested installation method is via [composer](https://getcomposer.org/):

```
composer require psr7-sessions/session-encode-decode
```

### Why this library?

PHP's native `session_encode()` and `session_decode()` functions has some limitations:

- session_decode()
    - Can't be used if there's no session active
    - Populates the super global `$_SESSION` variable automatically

- session_encode()
    - Do not accept parameters, so you can't use it to encode the content you want.
    - Depends on `$_SESSION` global state

### Encoding

```php
(new PSR7SessionEncodeDecode\Encoder())->__invoke(['counter' => 2]); // 'counter|i:2;'
```

### Decoding

```php
(new PSR7SessionEncodeDecode\Decoder())->__invoke('counter|i:2;'); // ['counter' => 2]
```
