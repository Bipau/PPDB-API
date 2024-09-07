<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;

class CalonSiswaController extends Controller
{
    //
    public function index()
    {
        $calonSiswa = CalonSiswa::all();
        return response()->json(['data' => $calonSiswa], 200);
    }
}
