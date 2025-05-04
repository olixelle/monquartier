<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Models\OfferCategory;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{

    public function index(Request $request)
    {
        try {
            $collection = Offer::where('neighborhood', '=', $request->user()->neighborhood_id)->with('user')->with('relatedCategory');

            return response()->json([
                'success' => true,
                'data' => [
                    OfferResource::collection($collection->get())
                ]
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

    public function getCategories(Request $request)
    {
        if (!$request->parent) {
            $collection = OfferCategory::orderBy('title')->get();
        }
        else
        {
            $collection = OfferCategory::where('parent', '=', $request->parent)->orderBy('title')->get();
        }

        return response()->json([
            'success' => true,
            'data' => [
                $collection
            ]
        ], 200);
    }
}
