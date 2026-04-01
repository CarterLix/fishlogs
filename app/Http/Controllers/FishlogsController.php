<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFishlogsRequest;
use App\Http\Requests\UpdateFishlogsRequest;
use App\Models\Fishlogs;
use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class FishlogsController extends Controller
{
    public function index()
    {
        $fishlogs = Fishlogs::where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->get();

        return view('fishlog.index', compact('fishlogs'));
    }

    public function create()
    {
        $tags = Tag::all();

        return view('fishlog.create', compact('tags'));
    }

    public function store(StoreFishlogsRequest $request)
    {
        $fishlog = new Fishlogs([
            'date' => $request->input('date'),
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'species' => $request->input('species'),
            'method' => $request->input('method'),
            'rating' => $request->input('rating'),
        ]);

        $fishlog->user_id = auth()->id();
        $fishlog->save();

        $fishlog->tags()->sync($request->input('tags', []));

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photoFile) {
                $storedPath = $photoFile->store('photos', 'public');

                Photo::create([
                    'fishlog_id' => $fishlog->id,
                    'filePath' => $storedPath,
                ]);
            }
        }

        return redirect()
            ->route('fishlogs.index')
            ->with('success', 'Fish log created.');
    }

    public function show(Fishlogs $fishlogs)
    {
        $this->authorize('view', $fishlogs);

        $fishlogs->load('tags', 'photos');

        return view('fishlog.show', ['fishlog' => $fishlogs]);
    }

    public function edit(Fishlogs $fishlogs)
    {
        $this->authorize('update', $fishlogs);

        $fishlogs->load('tags', 'photos');
        $tags = Tag::all();

        return view('fishlog.edit', [
            'fishlog' => $fishlogs,
            'tags' => $tags,
        ]);
    }

    public function update(UpdateFishlogsRequest $request, Fishlogs $fishlogs)
    {
        $fishlogs->update([
            'date' => $request->input('date'),
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'species' => $request->input('species'),
            'method' => $request->input('method'),
            'rating' => $request->input('rating'),
        ]);

        $fishlogs->tags()->sync($request->input('tags', []));

        if ($request->filled('remove_photos')) {
            $photosToRemove = $fishlogs->photos()
                ->whereIn('id', $request->input('remove_photos'))
                ->get();

            foreach ($photosToRemove as $photo) {
                Storage::disk('public')->delete($photo->filePath);
                $photo->delete();
            }
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photoFile) {
                $storedPath = $photoFile->store('photos', 'public');

                Photo::create([
                    'fishlog_id' => $fishlogs->id,
                    'filePath' => $storedPath,
                ]);
            }
        }

        return redirect()
            ->route('fishlogs.show', $fishlogs->id)
            ->with('success', 'Fish log updated.');
    }

    public function destroy(Fishlogs $fishlogs)
    {
        $this->authorize('delete', $fishlogs);

        foreach ($fishlogs->photos as $photo) {
            Storage::disk('public')->delete($photo->filePath);
        }

        $fishlogs->delete();

        return redirect()
            ->route('fishlogs.index')
            ->with('success', 'Deleted');
    }
}