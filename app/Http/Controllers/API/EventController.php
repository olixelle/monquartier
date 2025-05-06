<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventMessageResource;
use App\Http\Resources\EventSubscriptionResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function details($id) {

        try {
            $event = \App\Models\Event::findOrFail($id);

            return response()->json([
                'success' => true,
                'date' => new EventResource($event)
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

    public function update($id, Request $request) {

        try {
            $event = \App\Models\Event::findOrFail($id);
            $service = new \App\Services\Event();
            $event = $service->update($event, $request);

            return response()->json([
                'success' => true,
                'message' => 'Event updated',
                'date' => new EventResource($event)
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
            $event = \App\Models\Event::findOrFail($id);
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event deleted'
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
                'description' => 'required|string',
                'location' => 'required|string',
                'image' => 'required|string',
                'starts_at' => 'required|date',
                'ends_at' => 'date',
                'duration' => 'integer',
                'duration_unit' => 'string',
                'requires_reservation' => 'integer',
                'seats_total' => 'integer',
            ]);

            $service = new \App\Services\Event();
            $event = $service->create($request);

            return response()->json([
                'success' => true,
                'data' => [
                    new EventResource($event)
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
            $collection = Event::where('neighborhood', '=', $request->user()->neighborhood_id)->with('user');

            if ($request->from) {
                $collection->where('id', '>=', $request->from);
            }

            $collection->orderByDesc('created_at');

            return response()->json([
                'success' => true,
                'data' => [
                    EventResource::collection($collection->get())
                ]
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

    public function subscribe($id) {

        try {
            $event = \App\Models\Event::findOrFail($id);
            $service = new \App\Services\Event();
            $event = $service->subscribe($event);

            return response()->json([
                'success' => true,
                'message' => 'You suscribed to the event'
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }


    public function unsubscribe($id) {

        try {
            $event = \App\Models\Event::findOrFail($id);
            $service = new \App\Services\Event();
            $event = $service->unsubscribe($event);

            return response()->json([
                'success' => true,
                'message' => 'You unsuscribed to the event'
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

    public function postMessage($id, Request $request) {

        try {
            $event = \App\Models\Event::findOrFail($id);
            $service = new \App\Services\Event();
            $message = $service->addMessage($event, $request);

            return response()->json([
                'success' => true,
                'message' => 'Message posted'
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

    public function getMessages($id) {

        try {
            $event = \App\Models\Event::findOrFail($id);

            $collection = \App\Models\Event\Message::where('event', '=', $id)->with('user');
            $collection->orderByDesc('created_at');

            return response()->json([
                'success' => true,
                'data' => EventMessageResource::collection($collection->get())
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

    public function getSubscriptions($id) {

        try {
            $event = \App\Models\Event::findOrFail($id);

            $collection = \App\Models\Event\Subscription::where('event', '=', $id)->with('subscriber');
            $collection->orderByDesc('created_at');

            return response()->json([
                'success' => true,
                'data' => EventSubscriptionResource::collection($collection->get())
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage()
            ], 400);

        }

    }

}
