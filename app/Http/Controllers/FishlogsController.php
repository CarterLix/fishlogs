<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFishlogsRequest;
use App\Http\Requests\UpdateFishlogsRequest;
use App\Models\Fishlogs;

class FishlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fishlogs = Fishlogs::where('user_id', auth()->id())->orderBy('date', 'desc')->get();
        return view('fishlog.index', compact('fishlogs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fishlog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFishlogsRequest $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string',
            'location' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'method' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:10'
        ]);
        $fishlogs = new Fishlogs($request->all());
        $fishlogs->user_id = auth()->id();
        $fishlogs->save();

        return redirect()->route('fishlogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fishlogs $fishlogs)
    {
        return view('fishlog.show', ['fishlog' => $fishlogs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fishlogs $fishlogs)
    {
        return view('fishlog.edit', ['fishlog' => $fishlogs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFishlogsRequest $request, Fishlogs $fishlogs)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string',
            'location' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'method' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:10'
        ]);
        $fishlogs->update($request->all());

        return redirect()->route('fishlogs.show', $fishlogs->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fishlogs $fishlogs)
    {
       try {
            $fishlogs->delete();
            return redirect()->route('fishlogs.index')->with('success', 'Deleted');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
