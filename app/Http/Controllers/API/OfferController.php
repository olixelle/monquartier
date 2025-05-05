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
    public function update($id, Request $request) {

        try {
            $offer = \App\Models\Offer::findOrFail($id);
            $service = new \App\Services\Offer();
            $offer = $service->update($offer, $request);

            return response()->json([
                'success' => true,
                'message' => 'Offer updated',
                'date' => $offer
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }


    }

    public function delete($id) {

        try {
            $offer = \App\Models\Offer::findOrFail($id);
            $offer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Offer deleted'
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }


    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'category' => 'required|exists:offer_categories,id',
                'type' => 'required|in:offer,request',
                'status' => 'required|in:enabled,disabled',
                'price' => 'required|numeric',
                'description' => 'required|string',
            ]);

            $service = new \App\Services\Offer();
            $offer = $service->create($request);

            return response()->json([
                'success' => true,
                'data' => [
                    $offer
                ]
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

    public function index(Request $request)
    {
        try {
            $collection = Offer::where('neighborhood', '=', $request->user()->neighborhood_id)->with('user')->with('relatedCategory');

            if ($request->owner) {
                $collection->where('owner', '=', $request->owner);
            }
            if ($request->category) {
                $collection->where('category', '=', $request->category);
            }

            $collection->orderByDesc('created_at');

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
