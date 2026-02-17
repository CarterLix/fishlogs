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
        $fishlogs = Fishlogs::orderBy('date', 'desc')->get();
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
        $fishlogs = new Fishlogs($request->all());
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

        $fishlogs->update($request->all());

        return redirect()->route('fishlogs.show', $fishlogs->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fishlogs $fishlogs)
    {
        //
    }
}
