<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Table;
use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::whereNull('deleted_at')->get();
        return view('admin.booking.table.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.book-a-table');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTableRequest $request)
    {
        $table = new Table($request->all());
        $table->num_of_people = $request->people;
        $table->user_id = Auth::id();

        if ($table->save()) {
            return redirect()->route('booking')->with('success', 'Table reservation has been created successfully.');
        } else {
            return back()->withErrors([
                'error' => 'An error occurred while creating the table reservation. Please try again later.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservation = Table::where('id', $id)->whereNull('deleted_at')->first();
        return view('admin.booking.table.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTableRequest $request, $id)
    {
        $data = Table::where('id', $id)->whereNull('deleted_at')->first();
        if (!$data) {
            return back()->withErrors([
                'error' => 'This reservation for the table does not exist or has been deleted.',
            ]);
        }

        $data->fill($request->all());
        $data->user_id = Auth::id();

        if ($data->save()) {
            return redirect()->route('booking.index')
                    ->with('success', 'This reservation for the table has been updated successfully.');
        } else {
            return back()->withErrors([
                'error' => 'This reservation failed to update',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Table::where('id', $id)->whereNull('deleted_at')->first();
        $data->delete();

        if (!$data) {
            return redirect()->route('booking.index')
                    ->with('success', 'This reservation has been successfully deleted.');
        } else {
            return back()->withErrors([
                'error' => 'This reservation does not exist or has already been deleted.',
            ]);
        }
    }
}
