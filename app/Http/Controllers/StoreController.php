<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::paginate(6);;
        return view('store', compact('stores'));

        $stores = $query->paginate(6);
        $stores->appends($request->all());
        return view('store', compact('stores'));
    }
    
}
