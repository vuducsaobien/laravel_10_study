<?php

namespace App\Http\Controllers;

use App\Helpers\NumberHelper;

class PHPController extends Controller
{
    public function index()
    {
    }

    public function intdiv()
    {
        /*
            1. Cú pháp:
                intdiv($numerator, $divisor)
                Ví dụ: intdiv(3, 2) = 1

            2. Tham số:
                $numerator: Số bị chia
                $divisor: Số chia

            3. Giá trị trả về:
                Trả về kết quả phép chia dưới dạng số nguyên
                Làm tròn xuống (floor) kết quả nếu có phần thập phân
                Nếu $divisor là 0, sẽ ném ra ArithmeticError

            4. Ý nghĩa:
                Chia lấy phần nguyên của $numerator cho $divisor

            5. Ví dụ:
                intdiv(3, 2) = 1
                intdiv(4, 2) = 2
                intdiv(5, 2) = 2
                intdiv(6, 2) = 3
                intdiv(7, 2) = 3
                intdiv(8, 2) = 4
                intdiv(9, 2) = 4
                intdiv(10, 2) = 5
            6. So sánh với phép chia thông thường:
                $numerator = 3
                $divisor = 2
                $result = $numerator / $divisor = 1.5
                $result = intdiv($numerator, $divisor) = 1

                $numerator = 5
                $divisor = 2
                $result = $numerator / $divisor = 2.5
                $result = intdiv($numerator, $divisor) = 2
        //*/
    }
}
