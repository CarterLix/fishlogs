<?php

namespace App\Http\Controllers;

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

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'method' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:10',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:25120',
        ]);

        $fishlog = new Fishlogs([
            'date' => $request->date,
            'name' => $request->name,
            'location' => $request->location,
            'species' => $request->species,
            'method' => $request->input('method'),
            'rating' => $request->rating,
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

        return redirect()->route('fishlogs.index')
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

    public function update(\Illuminate\Http\Request $request, Fishlogs $fishlogs)
    {
        $this->authorize('update', $fishlogs);

        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'method' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:10',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpg,jpeg,png,webp|max:25120',
        ]);

        $fishlogs->update([
            'date' => $request->date,
            'name' => $request->name,
            'location' => $request->location,
            'species' => $request->species,
            'method' => $request->input('method'),
            'rating' => $request->rating,
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

        return redirect()->route('fishlogs.show', $fishlogs->id)
            ->with('success', 'Fish log updated.');
    }

    public function destroy(Fishlogs $fishlogs)
    {
        $this->authorize('delete', $fishlogs);

        $fishlogs->delete();

        return redirect()->route('fishlogs.index')
            ->with('success', 'Deleted');
    }
}