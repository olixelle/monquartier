<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NeighborhoodController extends Controller
{

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                Neighborhood::get()
            ]
        ], 200);
    }
}
