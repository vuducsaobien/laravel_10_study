<?php

namespace App\Helpers;

class NumberHelper
{
    public static function isEvenNumber(int $x): bool
    {
        return $x % 2 == 0;
    }

    public static function isOddNumber(int $x): bool
    {
        return $x % 2 != 0;
    }

    public static function getMiddlePositionFromDigitLength(int $number): float
    {
        $length = strlen($number);
        if ($length < 2) {
            throw new \InvalidArgumentException("Độ dài tối thiểu là 2");
        }
    
        return ($length / 2) + 0.5;
    }

    public static function numberToArray(int $number): array
    {
        $array = [];
        $array = str_split($number);
        return $array;
    }

    public static function getOppositeNumber(int $number, int $position): int
    {
        $length = self::getLengthOfNumber($number);
        $opposite = $length - $position - 1;
        return $opposite;
    }

    public static function getLengthOfNumber(int $number): int
    {
        return strlen($number);
    }

    public static function getLastCharacterOfNumber(int $number): int
    {
        /*
            Lấy số cuối cùng của số nguyên
            Ví dụ: 12345 Lấy 5
            Ví dụ: 12 Lấy 2
            Vì Vì trong hệ thập phân (hệ 10), mỗi chữ số đều là bội số của 10:
            1234 = 1*1000 + 2*100 + 3*10 + 4
        //*/

        return $number % 10;
    }

    public static function getTwoLastCharacterOfNumber(int $number): int
    {
        // Lấy 2 số cuối cùng của số nguyên
        // Ví dụ: 12345 % 100 = 45
        // Ví dụ: 12357 % 100 = 57
        return $number % 100;
    }

    public static function getSecondLastDigit(int $number): int
    {
        // Ví dụ: 12345 => Lấy 4
        // Ví dụ: 12357 => Lấy 5
        $digit = floor($number / 10) % 10;
        return $digit;
    }
    
    public static function getNumberWithoutLastCharacter(int $number): int
    {
        return intdiv($number, 10);
    }
    
    // /* D. Kiểm tra số nguyên
        public static function isNonNegativeInt(int $number): bool {
            // Kiểm tra số nguyên không âm (>= 0)
            // Ví dụ: 12345 => true
            // Ví dụ: 0 => true
            // Ví dụ: -12345 => false
            return $number >= 0;
        }

        public static function isPositiveInt(int $number): bool {
            // Kiểm tra số nguyên dương (> 0)
            // Ví dụ: 12345 => true
            // Ví dụ: 0 => false
            // Ví dụ: -12345 => false
            return $number > 0;
        }

        public static function isNonPositiveInt(int $number): bool {
            // Kiểm tra số nguyên âm (<= 0)
            // Ví dụ: 12345 => false
            // Ví dụ: 0 => true
            // Ví dụ: -12345 => true
            return $number <= 0;
        }

        public static function isNegativeInt(int $number): bool {
            // Kiểm tra số nguyên âm (< 0)
            // Ví dụ: 12345 => false
            // Ví dụ: 0 => false
            // Ví dụ: -12345 => true
            return $number < 0;
        }

        public static function isZero(int $number): bool {
            // Kiểm tra số nguyên bằng 0
            // Ví dụ: 12345 => false
            // Ví dụ: 0 => true
            // Ví dụ: -12345 => false
            return $number === 0;
        }

        public static function isNonZero(int $number): bool {
            // Kiểm tra số nguyên khác 0
            // Ví dụ: 12345 => true
            // Ví dụ: 0 => false
            // Ví dụ: -12345 => true
            return $number != 0;
        }

        public static function isNonZeroPositiveInt(int $number): bool {
            // Kiểm tra số nguyên dương khác 0
            // Ví dụ: 12345 => true
            // Ví dụ: 0 => false
            // Ví dụ: -12345 => false
            return $number > 0 && $number != 0;
        }

        public static function isNonZeroNegativeInt(int $number): bool {
            // Kiểm tra số nguyên âm khác 0
            // Ví dụ: -12345 => true
            // Ví dụ: 0 => false
            // Ví dụ: 12345 => false
            return $number < 0 && $number != 0;
        }

        public static function endsWithZeroButNotZero(int $number): bool {
            // Kiểm tra số nguyên có kết thúc bằng 0 nhưng không phải là 0
            // Ví dụ: 12345 => false
            // Ví dụ: 0 => false
            // Ví dụ: 12340 => true
            // Ví dụ: -12340 => true
            return $number % 10 === 0 && $number !== 0;
        }
    
    //*/

    /**
     * Append a digit to the end of a reversed number
     *
     * @param int $reversed The reversed number
     * @param int $number The original number to get the last digit from
     * @return int The new reversed number with the digit appended
     */
    public static function appendDigitToReversedNumber(int $reversed, int $number): int
    {
        /*
            Ví dụ: $reversed = 123456789
            Ví dụ: $number = 12345
            Ví dụ: $reversed * 10 + self::getLastCharacterOfNumber($number) = 123456789 * 10 + 5 = 1234567895
        //*/
        return $reversed * 10 + self::getLastCharacterOfNumber($number);
    }

    // 1. Two Sum - Tổng hai số
    /**
     * @param int[] $nums
     * @param int $target
     * @return int[]
     */
    public static function twoSum(array $nums, int $target): array
    {
        $map = []; // key: số đã duyệt, value: index của nó
        foreach ($nums as $index => $num) {
            $diff = $target - $num;
            if (isset($map[$diff])) {
                return [$map[$diff], $index];
            }
            $map[$num] = $index;
        }
        return []; // Trường hợp không tìm thấy cặp số nào
    }
    
    /**
     * 13. Palindrome Number - Số đối xứng
     * Проверяет, является ли число палиндромом.
     * Checks if a number is a palindrome.
     * @param int $x
     * @return bool
     */
    public static function isPalindrome(int $x): bool
    {
        // Отрицательные числа не палиндромы
        // Negative numbers are not palindromes
        if ($x < 0) {
            return false;
        }

        $str = strval($x);
        return $str === strrev($str);
    }
}