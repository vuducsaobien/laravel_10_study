<?php

namespace App\Http\Controllers;

use App\Models\Finger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $warning = Table1::all();
        // echo '<pre style="color:red";>$warning === '; print_r($warning);echo '</pre>';
        // echo '<h3>Die is Called - 21w3</h3>';die;
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

}
