# Baht Text: spell baht money from number to text

[![Latest Stable Version](http://poser.pugx.org/zenepay/baht-text/v)](https://packagist.org/packages/zenepay/baht-text)
[![Total Downloads](http://poser.pugx.org/zenepay/baht-text/downloads)](https://packagist.org/packages/zenepay/baht-text) 
[![License](http://poser.pugx.org/zenepay/baht-text/license)](https://packagist.org/packages/zenepay/baht-text) 
[![PHP Version Require](http://poser.pugx.org/zenepay/baht-text/require/php)](https://packagist.org/packages/zenepay/baht-text)

This package helps to translate baht amount to text. This should be useful for Invoice, Receipts in Thai baht<br>


## Installation

You can install the package via composer:

```bash
composer require zenepay/baht-text
```

## Usage
### Just directly call make function statically
Support input of valid money format without symbol eg. 1,000,20.50

```php
use Zenepay\BahtText;

$totalAmount = '2,010,025.25';
echo BahtText::make($totalAmount); // 'สองล้านหนึ่งหมื่นยี่สิบห้าบาทยี่สิบห้าสตางค์'
```
# validate input format with 

filter_var($number, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND)
So, it should accept string, float value with thousand comma and negative number

## Demo & Show Case

- [Water Billing](https://demo.zoploen.com/demo/meterbill)
- user login: demo@example.com
- password: demo1234

## Credits
s
- [zenepay](https://github.com/zenepay)
- [All Contributors](../../contributors)

## License

The MIT License (MIT)


# Baht Text: ใช้เพื่อแปลงตัวเลขเงินบาท ให้เป็นข้อความอ่าน 
เช่น  '2,010,025.25' ==> 'สองล้านหนึ่งหมื่นยี่สิบห้าบาทยี่สิบห้าสตางค์'

## การติดตั้ง
ติดตั้งผ่าน composer

```bash
composer require zenepay/baht-text
```

## การใช้งาน
```php
use Zenepay\BahtText;

$totalAmount = '2,010,025.25';
echo BahtText::make($totalAmount); // 'สองล้านหนึ่งหมื่นยี่สิบห้าบาทยี่สิบห้าสตางค์'
```
รองรับค่า input ที่เป็นจำนวนเงินที่ถูกต้อง มีคอมม่าหรือไม่มีก็ได้ ได้ทั้ง ติดลบและบวก
## ดูตัวอย่างในบิล

- [Water Billing](https://demo.zoploen.com/meterbill)
- user login: demo@example.com
- password: demo1234

## Credits

- [zenepay](https://github.com/zenepay)
- [All Contributors](../../contributors)

## License

The MIT License (MIT)
