<?php

namespace App\Helpers;

class LeetCodeEasyHelper
{
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

        // Convert number to string
        $str = strval($x);
        // Compare string with its reverse
        return $str === strrev($str);
    }

    /**
     * @param string $s
     * @return int
     */
    public static function romanToInt(string $s): int
    {
        /*
            13. Roman to Integer
            https://leetcode.com/problems/roman-to-integer/description/
            Roman numerals are usually written largest to smallest from left to right. 
            However, the numeral for four is not IIII. 
            Instead, the number four is written as IV. 
            Because the one is before the five we subtract it making four. 
            The same principle applies to the number nine, 
            which is written as IX. There are six instances where subtraction is used:
                I can be placed before V (5) and X (10) to make 4 and 9. 
                X can be placed before L (50) and C (100) to make 40 and 90. 
                C can be placed before D (500) and M (1000) to make 400 and 900.
            Given a roman numeral, convert it to an integer.

            Example 1:
                Input: s = "III"
                Output: 3
                Explanation: III = 3.
            Example 2:
                Input: s = "LVIII"
                Output: 58
                Explanation: L = 50, V= 5, III = 3.
            Example 3:
                Input: s = "MCMXCIV"
                Output: 1994
                Explanation: M = 1000, CM = 900, XC = 90 and IV = 4.

            Constraints:
                1 <= s.length <= 15
                s contains only the characters ('I', 'V', 'X', 'L', 'C', 'D', 'M').
                It is guaranteed that s is a valid roman numeral in the range [1, 3999].
        //*/
        $maps = ['I' => 1, 'V' => 5, 'X' => 10, 'L' => 50, 'C' => 100, 'D' => 500, 'M' => 1000];
        $s = "MCMXCIV"; // 1994
        $total = 0;
        $prev = 0;
        //         6                 5
        for($i = strlen($s)-1; $i >= 0; $i--){
            $current = $maps[$s[$i]]; 
 
            // Compare current and previous
            if($current < $prev){
                $total -= $current;
            }else {
                $total += $current;
            }
            // Update previous
            $prev = $current;
        }
        
        /*
            Cách làm:
                Thường thường chạy từ Left sang Right
                Nhưng cách nhanh nhất là chạy từ Right sang Left
                Nếu số hiện tại nhỏ hơn số trước đó thì trừ đi
                Ngược lại thì cộng vào
            
                Ex: MCMXCIV => V I C X M C M

                        $i   $s[$i]   $current  $curent < $prev?     $total   $prev
                init:                                                  0       0
                1:      6    V        5              FALSE             5       5
                2:      5    I        1              TRUE              4       1
                3:      4    C        100            FALSE             104     100
                4:      3    X        10             TRUE              94      10
                5:      2    M        1000           FALSE             1094    1000
                6:      1    C        100            TRUE              994     100
                7:      0    M        1000           FALSE             1994    1000
        //*/

        return $total;
    }

}