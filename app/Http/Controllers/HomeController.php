<?php

namespace App\Http\Controllers;

use App\Models\Finger;
use App\Models\Phone;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserProduct;
use App\Models\Supplier;
use App\Models\Table_1;
use App\Models\Table_2;
use App\Models\Table_4;

class HomeController extends Controller
{
    private $__userProduct = null;

    public function __construct(UserProduct $userProduct)
    {
        $this->__userProduct = $userProduct;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', 1)->first();
        echo '<pre style="color:red";>$user === '; print_r($user);echo '</pre>';
        echo '<h3>Die is Called - index</h3>';die;
        // return view('frontend.pages.home', compact('warning', 'visas', 'jsonProducts', 'jsonTimes', 'count', 'services', 'countries'));
    }

    public function oneToOneExample()
    {
        // Cách 1: Lấy cha ở table 1 và con ở table 2
        // $table_1 = Table_1::where('id', 1)->first();
        // $table_2 = $table_1->table_2;
        // echo '<pre style="color:red";>Cách 1 - $table_1 === '; print_r($table_1);echo '</pre>';
        // echo '<pre style="color:red";>Cách 1 - $table_2 === '; print_r($table_2);echo '</pre>';

        // Cách 2: Lấy con ở table 2 với eager loading từ table 1
        // $table_2_via_table_1 = Table_1::where('id', 3)->with('table_2')->first();
        // echo '<pre style="color:red";>Cách 2 - $table_2_via_table_1 === '; print_r($table_2_via_table_1);echo '</pre>';

        // Cách 3: Lấy con (Table_2) và truy cập ngược lên cha (Table_1)
        // $table_2 = Table_2::where('id', 1)->first();
        // $table_1_via_table_2 = $table_2->table_1;
        // echo '<pre style="color:red";>Cách 3 - $table_1_via_table_2 === '; print_r($table_1_via_table_2);echo '</pre>';

        // Cách 4: Sử dụng eager loading với with() từ Table_2
        // $table_2_with_parent = Table_2::where('id', 1)->with('table_1')->first();
        // echo '<pre style="color:red";>Cách 4 - $table_2_with_parent === '; print_r($table_2_with_parent);echo '</pre>';

        // Cách 5: Sử dụng whereHas() để lọc theo điều kiện của relationship
        // $like_1 = 'table 1'; // (Table 1 : id = 1 : name = table 1 - id 1 - name)
        // $like_1 = 'NOT LIKE'; // NULL (Table 1 : id = 3 ; name - NOT LIKE)
        // $table_1_has_table_2 = Table_1::whereHas('table_2', function($query) use ($like_1) {
        //     $query->where('name', 'like', '%'.$like_1.'%');
        // })->get();
        // echo '<pre style="color:red";>Cách 5 - $table_1_has_table_2 === '; print_r($table_1_has_table_2);echo '</pre>';

        // Cách 6: Sử dụng has() để kiểm tra sự tồn tại của relationship (Table 1 : id =1)
        // $table_1_with_table_2 = Table_1::has('table_2')->get(); // (Table 1 : id = 1 : name = table 1 - id 1 - name)
        // echo '<pre style="color:red";>Cách 6 - $table_1_with_table_2 === '; print_r($table_1_with_table_2);echo '</pre>';

        // Cách 7: Sử dụng doesntHave() để lấy những bản ghi không có relationship
        $table_1_without_table_2 = Table_1::doesntHave('table_2')->get(); // (Record đối ngược của 6: has)
        echo '<pre style="color:red";>Cách 7 - $table_1_without_table_2 === '; print_r($table_1_without_table_2);echo '</pre>';

        echo '<h3>Die is Called - One To One Example</h3>';die;
    }

    public function oneToMany()
    {
        // Cách 1.1: Lấy cha ở table 1 và con ở table 3
        // $table_1_id = 1; // Table 3 : id = 1 & 2
        // $table_1_id = 2; // Table 3 : id = 3
        // $table_1_id = 3; // Table 3 : NULL

        // $table_1 = Table_1::where('id', $table_1_id)->first();
        // $table_3 = $table_1->table_3;
        // echo '<pre style="color:red";>$table_3 === '; print_r($table_3);echo '</pre>';

        // Cách 1.2: Lấy cha ở table 1 và con ở table 3 = Eager Loading
        $table_1_id = 1; // Table 3 : id = 1 & 2
        $table_1 = Table_1::where('id', $table_1_id)->first();
        $table_1_with_table_3 = $table_1->table_3;
        echo '<pre style="color:red";>$table_1_with_table_3 === '; print_r($table_1_with_table_3);echo '</pre>';

        // Cách 2: Lấy con ở table 3 với eager loading từ table 1
        $table_3_via_table_1 = Table_1::where('id', 1)->with('table_3')->first();
        echo '<pre style="color:red";>$table_3_via_table_1 === '; print_r($table_3_via_table_1);echo '</pre>';

        // Cách 2: Lấy con ở table 3 với eager loading từ table 1
        // $table_3_via_table_1 = Table_1::where('id', 1)->with('table_3')->first();
        // echo '<pre style="color:red";>$table_3_via_table_1 === '; print_r($table_3_via_table_1);echo '</pre>';

        echo '<h3>Die is Called - 21w3</h3>';die;
    }

    public function manyToMany()
    {
        // Cách 1: Lấy tất cả Table_4 của một Table_1
        // $table_1 = Table_1::where('id', 1)->first();
        // $table_1 = Table_1::where('id', 2)->first();

        // $table_4s = $table_1->table_4;
        // echo '<pre style="color:red";>Cách 1 - $table_4s === '; print_r($table_4s);echo '</pre>';

        // // Cách 2: Lấy tất cả Table_4 của một Table_1 với eager loading
        // $table_1_with_table_4 = Table_1::where('id', 1)->with('table_4')->first();
        // echo '<pre style="color:red";>Cách 2 - $table_1_with_table_4 === '; print_r($table_1_with_table_4);echo '</pre>';

        // // Cách 3: Lấy tất cả Table_1 của một Table_4
        // $table_4 = Table_4::where('id', 1)->first();
        // $table_1s = $table_4->table_1;
        // echo '<pre style="color:red";>Cách 3 - $table_1s === '; print_r($table_1s);echo '</pre>';

        // // Cách 4: Lấy tất cả Table_1 của một Table_4 với eager loading
        // $table_4_with_table_1 = Table_4::where('id', 1)->with('table_1')->first();
        // echo '<pre style="color:red";>Cách 4 - $table_4_with_table_1 === '; print_r($table_4_with_table_1);echo '</pre>';

        // // Cách 5: Lọc Table_1 dựa trên điều kiện của Table_4
        // $table_1_has_table_4 = Table_1::whereHas('table_4', function($query) {
        //     $query->where('name', 'like', '%something%');
        // })->get();
        // echo '<pre style="color:red";>Cách 5 - $table_1_has_table_4 === '; print_r($table_1_has_table_4);echo '</pre>';

        // // Cách 6: Lấy Table_1 có ít nhất một Table_4
        // $table_1_with_table_4 = Table_1::has('table_4')->get();
        // echo '<pre style="color:red";>Cách 6 - $table_1_with_table_4 === '; print_r($table_1_with_table_4);echo '</pre>';

        // // Cách 7: Lấy Table_1 không có Table_4 nào
        $table_1_without_table_4 = Table_1::doesntHave('table_4')->get();
        echo '<pre style="color:red";>Cách 7 - $table_1_without_table_4 === '; print_r($table_1_without_table_4);echo '</pre>';

        echo '<h3>Die is Called - Many To Many Example</h3>';die;
    }

    public function hasManyThrough()
    {
        // Kiểm tra user có plan hay không
        $user = User::find(1); // has plan
        // $user = User::find(2); // has not plan

        if ($user->plans()->exists()) {
            $availablePlans = $user->availablePlans;
            $latestPlan = $user->latestPlan();
            $uniquePlans = $user->uniquePlans;

            echo '<pre style="color:red";>latestPlan === '; print_r($latestPlan);echo '</pre>';
            echo '<pre style="color:red";>availablePlans === '; print_r($availablePlans);echo '</pre>';
            echo '<pre style="color:red";>uniquePlans === '; print_r($uniquePlans);echo '</pre>';
        }
    }

    public function hasOneThrough()
    {
        // A. Kiểm tra Supplier
        $supplier = Supplier::find(1); // has record
        // $supplier = Supplier::find(2); // has not record

        if (!empty($supplier->userHistory)) {
            $history = $supplier->userHistory;
            echo '<pre style="color:red";>history === '; print_r($history->detail);echo '</pre>';    
        }


        // $user = U::find(1);
        // $history = $supplier->userHistory; // Lấy lịch sử của user thông qua supplier
        // echo '<pre style="color:red";>history === '; print_r($history);echo '</pre>';

        // B. Kiểm tra user có plan hay không
        // $user = User::find(1); // has history_order
        // $user = User::find(2); // has not history_order
        // if ($user->history()->exists()) {
        //     // $supplierName = $user->supplier->name;
        //     // echo '<pre style="color:red";>supplierName === '; print_r($supplierName);echo '</pre>';

        //     $history = $user->history;
        //     echo '<pre style="color:red";>history === '; print_r($history->detail);echo '</pre>';

        //     echo '<h3>Die is Called - history</h3>';die;
        // }
    }

    public function oneToOneExampleNew()
    {
        $table_2 = Table_2::where('id', 1)->first();
        $table_1 = $table_2->table_1;
        echo '<pre style="color:red";>$table_1 === '; print_r($table_1);echo '</pre>';
        echo '<h3>Die is Called - 21w3</h3>';die;
    }
}
