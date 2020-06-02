# Vscale PHP Api

Простой PHP-класс для работы с API vscale.io

## Установка


### Установка через Composer

Запустите

```
php composer.phar require benyazi/vscale-php-api
```

или добавьте

```js
"benyazi/vscale-php-api": "dev-master"
```

в секцию ```require``` вашего composer.json


## Использование


```php
$client = new \Benyazi\VscaleApi\Client(API_TOKEN);
```

Получение баланса:

```php
$balance = $client->getBillingBalance();
```

Получение ценников:

```php
$plans = $client->getBillingPrices()["default"];
```

Получение списка серверов:

```php
$scalets = $client->getScalets();
```


## Автор

[Sergey Klabukov](https://github.com/benyazi/), e-mail: [yo@benyazi.ru](mailto:yo@benyazi.ru)
