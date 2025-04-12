<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;

class LeetCodeEasyController extends Controller
{
    public function draft()
    {
        // $map[2] = 0;
        // echo '<pre style="color:red";>$map === '; print_r($map);echo '</pre>';
        // $number = 1;
        // $reversed = 12;
        // $number === intdiv($reversed, 10);
        // var_dump($number);
    }

    public function index()
    {
        // /*
            // 1. Two Sum
            // $nums = [2, 5, 7, 11, 15];
            // $target = 9;
            // $result = $this->__twoSum($nums, $target);
            // echo '<pre style="color:red";>$result === '; print_r($result);echo '</pre>';
        //*/

        // /*
            // 2. Palindrome Number
            // $x = 12345;
            // $result = $this->__isPalindrome($x);
            // echo '<pre style="color:red";>$result === '; print_r($result);echo '</pre>';
        //*/
    }

    // 1. Two Sum - Tổng hai số
    // https://leetcode.com/problems/two-sum/
    private function __twoSum($nums, $target)
    {
        return NumberHelper::twoSum($nums, $target);
    }

    // 2. Palindrome Number - Số đối xứng
    // https://leetcode.com/problems/palindrome-number/
    private function __isPalindrome($x)
    {
        return NumberHelper::isPalindrome($x);
    }
}
