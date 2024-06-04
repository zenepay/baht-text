<?php

namespace Zenepay\BahtText\tests;

use Exception;
use Tests\TestCase;
use Zenepay\BahtText\BahtText;

class BahtTextTest extends TestCase
{

    public function test_validate_comma_place_format(): void
    {
        $inValidNumber1 = '2001,000.25';
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid number format');
        $this->assertNull(BahtText::validate($inValidNumber1));
    }

    public function test_validate_invalid_number(): void
    {

        $inValidNumber2 = 'a2001,000.2';
        $this->expectException(Exception::class);
        $this->assertNull(BahtText::validate($inValidNumber2));
    }
    public function test_validate_and_format_with_comma(): void
    {
        $validNumber1 = '2,001,000.5';
        $this->assertSame(BahtText::validate($validNumber1), '2001000.50');
    }

    public function test_validate_negative_number(): void
    {
        $this->assertSame(BahtText::validate('-2,001,000.5'), '-2001000.50');
        $this->assertSame(BahtText::validate('-0.5'), '-0.50');
    }

    public function test_validate_leading_zero(): void
    {
        $this->assertSame(BahtText::validate('000.58'), '0.58');
    }

    public function test_zero_at_front_wording(): void
    {
        $this->assertSame(BahtText::make('0.55'), 'ห้าสิบห้าสตางค์');
        $this->assertSame(BahtText::make('002000.5'), 'สองพันบาทห้าสิบสตางค์');
    }

    public function test_spell_wordings(): void
    {
        $this->assertSame(BahtText::make('25.25'), 'ยี่สิบห้าบาทยี่สิบห้าสตางค์');
        $this->assertSame(BahtText::make('2,110.5'), 'สองพันหนึ่งร้อยสิบบาทห้าสิบสตางค์');
        $this->assertSame(BahtText::make('10,002,120'), 'สิบล้านสองพันหนึ่งร้อยยี่สิบบาทถ้วน');
        $this->assertSame(BahtText::make('2,102,120.00'), 'สองล้านหนึ่งแสนสองพันหนึ่งร้อยยี่สิบบาทถ้วน');
        $this->assertSame(BahtText::make('-2,821.27'), 'ลบสองพันแปดร้อยยี่สิบเอ็ดบาทยี่สิบเจ็ดสตางค์');
    }
}
