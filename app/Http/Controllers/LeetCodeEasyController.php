<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;

class LeetCodeEasyController extends Controller
{
    public function index()
    {
        /*
            // 1. Two Sum
            $nums = [2, 5, 7, 11, 15];
            $target = 9;
            $result = $this->__twoSum($nums, $target);
            echo '<pre style="color:red";>$result === '; print_r($result);echo '</pre>';
        //*/

        // /*
            // 2. Palindrome Number
            $x = 12345;
            $result = $this->__isPalindrome($x);
            echo '<pre style="color:red";>$result === '; print_r($result);echo '</pre>';
        //*/
    }

    public function draft()
    {
        // $map[2] = 0;
        // echo '<pre style="color:red";>$map === '; print_r($map);echo '</pre>';
        $number = 1;
        $reversed = 12;
        $number === intdiv($reversed, 10);
        var_dump($number);
    }

    // 1. Two Sum - Tổng hai số
    private function __twoSum($nums, $target)
    {
        // Cách 1:
        // foreach ($nums as $key => $value) {
        //     for ($i=$key+1; $i <= $count; $i++) { 
        //         if ($value + $nums[$i] == $target) {
        //             $result[] = $key;
        //             $result[] = $i;
        //         }
        //     }
        // }

        // Cách 2:
        // foreach ($nums as $key => $value) {
        //     $complement = $target - $value;
        //     if (in_array($complement, $nums)) {
        //         $result[] = $key;
        //         $result[] = array_search($complement, $nums);
        //     }
        // }

        $map = []; // key: số đã duyệt, value: index của nó
        foreach ($nums as $index => $num) {
            $diff = $target - $num;
            if (isset($map[$diff])) {
                return [$map[$diff], $index];
            }
            $map[$num] = $index;
        }

        /*
                    index   num    diff    isset($map[$diff])   map
            Lượt 1   0      2      7       $map[7] : false      [2 => 0]
            Lượt 2   1      5      4       $map[4] : false      [2 => 0, 5 => 1]
            Lượt 3   2      7      2       $map[2] : true       return [0, 2]
        */
    }

    // 2. Palindrome Number - Số đối xứng
    private function __isPalindrome($number)
    {
        // Cách 1: So sánh từng cặp số (Đầu - Cuối đến chạy vào giữa)
        // $length = NumberHelper::getLengthOfNumber($number);
        // if ($length < 2) return true;
        // $middlePosition = NumberHelper::getMiddlePositionFromDigitLength($number);
        // $arrayNumber = NumberHelper::numberToArray($number);
        // $result = true;
        // for ($i=0; $i < $middlePosition; $i++) {
        //     $opposite = $length - $i - 1;
        //     if ($arrayNumber[$i] != $arrayNumber[$opposite]) {
        //         $result = false;
        //         break;
        //     }
        // }
        // return $result;

        // Cách 2: Lật ngược số
        // if ($number < 0 || ($number % 10 === 0 && $number !== 0)) return false;
        if (NumberHelper::isNegativeInt($number) || (
            NumberHelper::isZero($number) && NumberHelper::endsWithZeroButNotZero($number)
        )) return false;

        // $number = 1221; // isPalindrome = true - Số chẵn chữ số - Ví dụ A
        // $number = 121; // isPalindrome = true - Số lẻ chữ số - Ví dụ B
        $number = 12345; // isPalindrome = false - Ví dụ C

        $reversed = 0;
        while ($number > $reversed) {
            $reversed = NumberHelper::appendDigitToReversedNumber($reversed, $number); 
            // $reversed = $reversed * 10 + self::getLastCharacterOfNumber($number)
            // $reversed = $reversed * 10 + $number % 10 ;
            echo '<pre style="color:red";>$reversed === '; print_r($reversed);echo '</pre>';

            $number = NumberHelper::getNumberWithoutLastCharacter($number); // $number = intdiv($number, 10);
            echo '<pre style="color:red";>$number === '; print_r($number);echo '</pre>';
        }

        /*
            Mục đích: 
                1. Tạo ra số đảo ngược. Ví dụ: 12321 => 12 & 123 ; 1221 => 12 & 21
                2. Để kiểm tra số đảo ngược có bằng số ban đầu không. Ví dụ: 121 == 121

            Ví dụ A. - Số đối xứng - Palindrome: 1221 - Số chẵn chữ số - 4 chữ số
            
                            Trước vòng lặp                  Tính toán Trong vòng lặp                Sau vòng lặp

                Lượt 1:     $reversed = 0                   $reversed = 0 * 10 + 1221 % 10 = 1      $reversed = 1
                            $number = 1221                  $number = intdiv(1221, 10) = 122        $number = 122

                Lượt 2:     $reversed = 1                   $reversed = 1 * 10 + 122 % 10 = 12      $reversed = 12
                            $number = 122                   $number = intdiv(122, 10) = 12          $number = 12

                Lượt 3:     $reversed = 12                 Dừng vòng lặp vì $number = 12 > $reversed = 12 là SAI 
                            $number = 12                     

                => $number === $reversed <=> 12 === 12 => TRUE

            Ví dụ B. - Số đối xứng - Palindrome: 121 - Số lẻ chữ số - 3 chữ số
            
                            Trước vòng lặp                  Tính toán Trong vòng lặp                Sau vòng lặp

                Lượt 1:     $reversed = 0                   $reversed = 0 * 10 + 121 % 10 = 1       $reversed = 1
                            $number = 121                   $number = intdiv(121, 10) = 12          $number = 12

                Lượt 2:     $reversed = 1                   $reversed = 1 * 10 + 12 % 10 = 12       $reversed = 12
                            $number = 12                    $number = intdiv(12, 10) = 1            $number = 1

                Lượt 3:     $reversed = 12                  Dừng vòng lặp vì $number = 1 > $reversed = 12 là SAI 
                            $number = 1                     

                => $number === intdiv($reversed, 10) <=> 1 === intdiv(12, 10) <=> 1 = 1 => TRUE


            Ví dụ C. - Không phải số đối xứng - Palindrome: 12345

                            Trước vòng lặp                  Tính toán Trong vòng lặp                Sau vòng lặp

                Lượt 1:     $reversed = 0                   $reversed = 0 * 10 + 12345 % 10 = 5     $reversed = 5
                            $number = 12345                 $number = intdiv(12345, 10) = 1234      $number = 1234

                Lượt 2:     $reversed = 5                   $reversed = 5 * 10 + 1234 % 10 = 54     $reversed = 54
                            $number = 1234                  $number = intdiv(1234, 10) = 123        $number = 123

                Lượt 3:     $reversed = 54                  $reversed = 54 * 10 + 123 % 10 = 543    $reversed = 543
                            $number = 123                   $number = intdiv(123, 10) = 12          $number = 12

                Lượt 4:     $reversed = 543                 Dừng vòng lặp vì $number = 12 > $reversed = 543 là SAI 
                            $number = 12
        //*/

        // Ví dụ A - Số chẵn chữ số: $x == $reversed           Ví dụ B - Số lẻ chữ số: $x == intdiv($reversed, 10)
        // 1221 => $x = 12 = $reversed = 12             ||      121 => $x = 1 = $reversed = 12 => $x === intdiv(12, 10) = 1
        return $number === $reversed                   ||      $number === intdiv($reversed, 10);
    }
}
