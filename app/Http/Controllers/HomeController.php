<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\SliderContent;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Brand;
use App\Models\Promo;
use App\Models\Review;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function register()
    {
        $str = NULL;
        return view('dianca.register', compact('str'));
    }
}
