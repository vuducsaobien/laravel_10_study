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
        // $user = User::where('id', 1)->first();
        // echo '<pre style="color:red";>$user === '; print_r($user);echo '</pre>';
        echo '<h3>Die is Called - index</h3>';die;
        // return view('frontend.pages.home', compact('warning', 'visas', 'jsonProducts', 'jsonTimes', 'count', 'services', 'countries'));
    }

    public function oneToOneExample()
    {
        // 1. Tìm xem User này có Vân tay duy nhất là Vân tay nào ?
        // Lấy cha ở table User id = 1 và Vân tay duy nhất của nó (table Finger)
        // $user = User::where('id', 1)->with('finger')->first();
        // $finger = $user->finger;

        // $user = User::where('id', 1)->first();
        // $finger = $user->finger;

        // 2. Lấy con ở table 2 id = 1 và cha của nó ở table User
        $finger = Finger::where('id', 2)->first();

        $user = $finger->user;

        echo '<pre style="color:red";>$user === '; print_r($user);echo '</pre>';
        echo '<pre style="color:red";>$finger === '; print_r($finger);echo '</pre>';

        echo '<h3>Die is Called - 21w3</h3>';die;
    }

    public function oneToMany()
    {
        // 1. Tìm xem User này có những relationships nào ?
        // $user = User::where('id', 1)->first();
        // $finger = $user->finger; // Tìm xem User này có Vân tay duy nhất là Vân tay nào ?
        // $phones = $user->phones; // Tìm xem User này có những số điện thoại nào ?

        // 2. Tìm xem những mối quan hệ này thuộc về User nào ?
        // A. Finger
        // $finger = Finger::where('id', 2)->first();
        // $user = $finger->user;
        // B. Phones
        $phone = Phone::where('id', 3)->first();
        $user = $phone->user; // User có Phone id = 3
        $phones = $user->phones; // List các số đt của User có Phone id = 3

        echo '<pre style="color:red";>$phone === '; print_r($phone);echo '</pre>';
        // echo '<pre style="color:red";>$user === '; print_r($user);echo '</pre>';
        echo '<pre style="color:red";>$phones === '; print_r($phones);echo '</pre>';

        echo '<h3>Die is Called - 21w3</h3>';die;
    }

    public function manyToMany()
    {
        // 1. Tìm xem User này có những relationships nào ?
        // $user = User::find(1);
        // $products = $user->products;
        // echo '<pre style="color:red";>$user === '; print_r($user);echo '</pre>';
        // echo '<pre style="color:red";>$products === '; print_r($products);echo '</pre>';

        // 2. Tìm xem product_id = 1 thì có những user nào mua ?
        // $productId = 1;
        // $users = $this->__userProduct->getUniqueUsersByProductId($productId);
        // echo '<pre style="color:red";>$users === '; print_r($users);echo '</pre>';

        // 3. Tìm xem user_id = 1 thì có những mua những product nào ?       
        // $userId = 3;
        // $products = $this->__userProduct->getUniqueProductsByUserId($userId);
        // echo '<pre style="color:red";>$products === '; print_r($products);echo '</pre>';

        // 4. Lấy danh sách sản phẩm mà một user đã mua kèm thông tin pivot
        $user = User::find(3);
        $products = $user->products->toArray();
        echo '<pre style="color:red";>$products === '; print_r($products);echo '</pre>';

        foreach ($user->products as $product) {
            $productName = $product->name;
            $quantity = $product->pivot->quantity;
            echo '<pre style="color:red";>$productName === '; print_r($productName);echo '</pre>';
            echo '<pre style="color:red";>$quantity === '; print_r($quantity);echo '</pre>';
        }
        echo '<h3>Die is Called - 21w3</h3>';die;
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
}
