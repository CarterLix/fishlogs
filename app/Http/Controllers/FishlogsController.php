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
        return view('fishlogs', compact('fishlogs'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFishlogsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fishlogs $fishlogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fishlogs $fishlogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFishlogsRequest $request, Fishlogs $fishlogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fishlogs $fishlogs)
    {
        //
    }
}
