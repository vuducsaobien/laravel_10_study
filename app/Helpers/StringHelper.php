<?php

namespace App\Helpers;

class StringHelper
{
    const ALPHABET = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    
    // Roman characters
    const ROMAN_CHARACTERS = ['I', 'V', 'X', 'L', 'C', 'D', 'M'];
    const ROMAN_CHARACTERS_VALUES = [1, 5, 10, 50, 100, 500, 1000];
    const ROMAN_CHARACTERS_VALUES_MAP = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    ];
    private static array $romanMap = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000,
    ];

    // Validate types
    const TYPE_EXACTLY_1_CHARACTER = 'exactly_1_character';
    const TYPE_GREATER_THAN_1_CHARACTER = 'greater_than_1_character';
    const TYPE_ALPHABET = 'alphabet';
    const TYPE_ROMAN = 'roman';
    const TYPE_ALL_IS_ROMAN_STRING = 'all_is_roman_string';

    public static function getLengthOfString(string $str): int
    {
        return strlen($str);
    }

    public static function getCharacterPosition(string $singleCharacter): int
    {
        self::__validateStringHelper($singleCharacter, [self::TYPE_EXACTLY_1_CHARACTER, self::TYPE_ALPHABET]);

        // Ví dụ: Trả về vị trí chữ cái trong bảng chữ cái (a/A = 0, z/Z = 25)
        $buocNhay = 0;
        return ord(strtolower($singleCharacter)) - ord('a') + $buocNhay;
    }

    public static function getCharacterValueFromRomanCharacters(string $singleCharacter): int
    {
        self::__validateStringHelper($singleCharacter, [self::TYPE_EXACTLY_1_CHARACTER, self::TYPE_ROMAN]);

        return self::ROMAN_CHARACTERS_VALUES_MAP[$singleCharacter];
    }

    public static function romanToInt(string $string)
    {
        /*
            1. MMCMXCIX → 2999
            M (1000) + M (1000) + CM (900) + XC (90) + IX (9)

            2. MMMCDLXXXIII → 3483
            MMM (3000) + CD (400) + L (50) + XXX (30) + III (3)

            3. MMMCMXXV → 3925
            MMM (3000) + CM (900) + XX (20) + V (5)

            4. MMMDCCLXXXVII → 3787
            MMM (3000) + D (500) + CC (200) + L (50) + XXX (30) + VII (7)

            5. MMMCDXCIII → 3493
            MMM (3000) + CD (400) + XC (90) + III (3)

            6. MMMDCCCXCIX → 3899
            MMM (3000) + D (500) + CCC (300) + XC (90) + IX (9)

            7. MMMCMXCIII → 3993
            MMM (3000) + CM (900) + XC (90) + III (3)

            Input: s = "MCMXCIV" => [1000, 100, 1000, 10, 100, 1, 5]
            Output: 1994
            Explanation: M = 1000, CM = 900, XC = 90 and IV = 4.

            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000

        //*/
        $string = "MCMXCIV";
        $length = strlen($string);
        // $romanCharacters = [];

        // $romanCharacters[] = self::getCharacterValueFromRomanCharacters($string[$i]);

        if ($length === 1) {
            return self::$romanMap[$string[0]];
        }

        if ($length === 2) {
            $c1 = self::$romanMap[$string[0]];
            $c2 = self::$romanMap[$string[1]];
            if ($c1 < $c2) {
                return $c2 - $c1;
            }
            return $c1 + $c2;
        }

        // [1000, 100, 1000, 10, 100, 1, 5]
        // echo '<pre style="color:red";>$romanCharacters === '; print_r($romanCharacters);echo '</pre>';
    }

    public static function validateRomanCharacters(string $string)
    {
        self::__validateStringHelper($string, [self::TYPE_GREATER_THAN_1_CHARACTER, self::TYPE_ALL_IS_ROMAN_STRING]);

        

        // return $romanCharacters;
    }

    private static function __validateStringHelper(string $str, array $types)
    {
        foreach ($types as $type) {
            switch ($type) {
                case self::TYPE_EXACTLY_1_CHARACTER:
                    if (strlen($str) !== 1) {
                        throw new \InvalidArgumentException('Input must be exactly 1 character.');
                    }
                    break;
                case self::TYPE_GREATER_THAN_1_CHARACTER:
                    if (strlen($str) <= 1) {
                        throw new \InvalidArgumentException('Input must be greater than 1 character.');
                    }
                    break;
                case self::TYPE_ALPHABET:
                    if (!ctype_alpha($str)) {
                        throw new \InvalidArgumentException('Input must be an alphabet character.');
                    }
                    break;
                case self::TYPE_ROMAN:
                    if (!in_array($str, self::ROMAN_CHARACTERS)) {
                        throw new \InvalidArgumentException('Input must be a Roman character.');
                    }
                    break;
                case self::TYPE_ALL_IS_ROMAN_STRING:
                    foreach (str_split($str) as $character) {
                        if (!in_array($character, self::ROMAN_CHARACTERS)) {
                            throw new \InvalidArgumentException('Input must be a Roman character List.');
                        }
                    }
                    break;
    
            }
        }
    }
}
