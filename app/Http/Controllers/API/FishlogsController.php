<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFishlogsRequest;
use App\Http\Requests\UpdateFishlogsRequest;
use App\Http\Resources\FishlogCollection;
use App\Http\Resources\FishlogResource;
use App\Models\Fishlogs;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FishlogsController extends Controller
{
    public function index(Request $request)
    {
        $query = Fishlogs::where('user_id', $request->user()->id)
            ->with('tags', 'photos');

        if ($request->has('sort')) {
            $columns = explode(',', $request->query('sort'));

            foreach ($columns as $column) {
                $column = trim($column);

                if (substr($column, 0, 1) === '-') {
                    $query->orderBy(ltrim($column, '-'), 'desc');
                } else {
                    $query->orderBy($column, 'asc');
                }
            }
        } else {
            $query->orderBy('id', 'asc');
        }

        if ($request->has('page')) {
            return FishlogResource::collection($query->paginate(2));
        }

        return FishlogResource::collection($query->get());
    }

    public function store(StoreFishlogsRequest $request)
    {
        $validated = $request->validated();

        $fishlog = Fishlogs::create([
            'user_id' => $request->user()->id,
            'date' => $validated['date'],
            'name' => $validated['name'],
            'location' => $validated['location'],
            'species' => $validated['species'],
            'method' => $validated['method'],
            'rating' => $validated['rating'],
        ]);

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

        $fishlog->load('tags', 'photos');

        return (new FishlogResource($fishlog))
            ->additional([
                'message' => 'Fishlog Created',
            ])
            ->response()
            ->setStatusCode(201);
    }

    public function show(Request $request, Fishlogs $fishlog)
    {
        $this->authorize('view', $fishlog);

        $fishlog->load('tags', 'photos');

        return new FishlogResource($fishlog);
    }

    public function update(UpdateFishlogsRequest $request, Fishlogs $fishlog)
    {
        $this->authorize('update', $fishlog);

        $validated = $request->validated();

        $fishlog->update([
            'date' => $validated['date'],
            'name' => $validated['name'],
            'location' => $validated['location'],
            'species' => $validated['species'],
            'method' => $validated['method'],
            'rating' => $validated['rating'],
        ]);

        $fishlog->tags()->sync($request->input('tags', []));

        if ($request->filled('remove_photos')) {
            $photosToRemove = $fishlog->photos()
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
                    'fishlog_id' => $fishlog->id,
                    'filePath' => $storedPath,
                ]);
            }
        }

        $fishlog->load('tags', 'photos');

        return (new FishlogResource($fishlog))
            ->additional([
                'message' => 'Fishlog Updated',
            ])
            ->response()
            ->setStatusCode(200);
    }

    public function destroy(Fishlogs $fishlog)
    {
        $this->authorize('delete', $fishlog);

        foreach ($fishlog->photos as $photo) {
            Storage::disk('public')->delete($photo->filePath);
        }

        $fishlog->delete();

        return response()->json([
            'message' => 'Fish log deleted.',
        ], 202);
    }
}