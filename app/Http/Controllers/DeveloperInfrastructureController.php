<?php

namespace App\Http\Controllers;

use App\Models\Metro;
use App\Models\University;
use Illuminate\Http\Request;

class DeveloperInfrastructureController extends Controller
{
    /**
     * Display a listing of the metros and universities.
     */
    public function index()
    {
        $metros = Metro::latest()->get();
        $universities = University::latest()->get();

        return view('developer.infrastructure.index', compact('metros', 'universities'));
    }
}
