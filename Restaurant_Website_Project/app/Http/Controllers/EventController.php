<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('events')
        ->join('users', 'events.user_id', '=', 'users.id')
        ->selectRaw('events.*, users.name as user_name')
        ->whereNull('events.deleted_at')
        ->get();
        
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = new Event($request->only(['title', 'description', 'event_time', 'start_time', 'end_time', 'num_of_people', 'price']));
        $event->user_id = Auth::id();

        if ($request->hasfile('event_image')) {
            $image = $request->file('event_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/event/', $filename);
            $event->event_image = $filename;
        }

        if ($event->save()) {
            return redirect()->route('index')
                    ->with('success', 'Event created successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to create event.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->whereNull('deleted_at')->first();
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::where('id', $id)->whereNull('deleted_at')->first();
        if (!$event) {
            return back()->withErrors([
                'error' => 'Event not found or has been deleted.',
            ]);
        }

        $event->fill($request->only(['title', 'description', 'event_time', 'start_time', 'end_time', 'num_of_people', 'price']));
        $event->user_id = Auth::id();

        if ($request->hasfile('event_image')) {
            $image = $request->file('event_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/images/event/', $filename);
            $event->event_image = $filename;
        }
        
        if ($event->update()) {
            return redirect()->route('index')
                    ->with('success', 'Event created successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Failed to create event.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('id', $id)->whereNull('deleted_at')->first();
        if (!$event) {
            return back()->withErrors([
                'error' => 'Event not found or has benn deleted.'
            ]);
        }

        $event->delete();

        if ($event->trashed()) {
            return redirect()->route('index')
                    ->with('success', 'Event deleted successfully.');
        } else {
            return back()->withErrors([
                'error' => 'Event not found or already deleted.'
            ]);
        }
    }
}
