<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class AdminTokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::all();
        return view('admin', compact('tokos'));
    }
}

