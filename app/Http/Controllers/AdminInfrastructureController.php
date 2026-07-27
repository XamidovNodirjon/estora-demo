<?php

namespace App\Http\Controllers;

use App\Models\Metro;
use App\Models\University;
use App\Models\ProductItem;

class AdminInfrastructureController extends Controller
{
    /**
     * Display a listing of the metros and universities.
     */
    public function index()
    {
        $metros = Metro::latest()->get();
        $universities = University::latest()->get();
        $productItems = ProductItem::whereNull('product_id')->latest()->get();

        return view('admin.infrastructure.index', compact('metros', 'universities', 'productItems'));
    }
}
