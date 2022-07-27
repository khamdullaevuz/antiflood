# Anti-flood system in php with memcache

# Usage

## Require library

```shell
composer require khamdullaev/antiflood
```

## Usage in code
```php
<?php

require 'vendor/autoload.php';

use Khamdullaevuz\AntiFlood;

$flood = new AntiFlood();

if($flood->check("10", "200"))
    echo "Flood not detected";
else
    echo "Flood detected";
```

Author: [Elbek Khamdullaev](https://khamdullaev.uz)