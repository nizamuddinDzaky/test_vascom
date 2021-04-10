<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $view->with('categories', $categories);
    }
}