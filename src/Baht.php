<?php

namespace Zenepay\BahtText;

class Baht
{

    const NUM_WORDS = ['ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
    const PLACE_VALUES = ['ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน'];
    const CURRENCY_UNIT = 'บาท';
    const CURRENCY_SUB_UNIT = 'สตางค์';

    public static function toText(mixed $number): ?string
    {
        if ($number === null || $number === '') {
            return '';
        }

        $number = static::validate($number); // return as string

        list($bahts, $stangs) = explode('.', $number, 2);
        if (intval($bahts) == 0 && intval($stangs) != 0) {
            $bahtWords = '';
        } else {
            $bahtWords = static::spell($bahts) . static::CURRENCY_UNIT;
        }
        if (intval($stangs) == 0) {
            $stangWords  = 'ถ้วน';
        } else {
            $stangWords = static::spell($stangs) . static::CURRENCY_SUB_UNIT;
        }
        return $bahtWords . $stangWords;
    }


    public static function validate(mixed $number): ?string
    {
        // 2,001,000.25
        $number = is_numeric($number) ? sprintf('%01.2F', $number) : trim($number);
        if (filter_var($number, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_THOUSAND) === false) {
            throw new \Exception('Invalid number format');
        }
        $number = str_replace(',', '', $number); // remove comma
        $strNumber = sprintf('%01.2F', floatval($number));

        return $strNumber;
    }

    /**
     * @param string $number
     *
     * @return string $numText in Thai currency reading
     */

    private static function spell(string|int $number): string
    {
        $word = '';
        $prefix = '';
        $number = sprintf('%d', $number); // convert to string

        // handles negative value
        if (intval($number) < 0) {
            $prefix = 'ลบ';
            $number = substr($number, 1);
        }

        $pos = (strlen($number) - 1) % 6;

        $digits = str_split($number);
        $numbers = '';
        $numText = '';
        foreach ($digits as $key => $value) {
            $numbers .= $value;
            $value = intval($value);

            $word = ($value === 0) ? '' : static::NUM_WORDS[$value];
            // After million position repeat reading the same word
            $pos = $pos < 0 ? 5 : $pos;
            if ($pos === 0) {       //oneth & millionth
                $word = ($value === 1 && intval($numbers) > 1) ? 'เอ็ด' : $word;
            } elseif ($pos === 1) { //tenths
                $word = ($value === 1) ? '' : $word;
                $word = ($value === 2) ? 'ยี่' : $word;
            }

            $placeValue = static::PLACE_VALUES[$pos];
            if (($value === 0 && $pos !== 0) || $key === strlen($number) - 1) {
                $placeValue = '';
            }

            $numText .= $word . $placeValue;
            $pos--;
        }

        return $prefix . $numText;
    }
}
