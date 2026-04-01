@php
  $isEdit = isset($fishlog);
@endphp

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="hero-card p-4 p-md-5">

    <div class="mb-4">
        <div class="hero-kicker mb-2">
            {{ $isEdit ? 'Edit fish log' : 'New fish log' }}
        </div>

        <h1 class="hero-title mb-0" style="font-size: clamp(1.8rem, 3vw, 2.5rem);">
            {{ $isEdit ? $fishlog->name : 'Create a new trip' }}
        </h1>
    </div>

    <div class="hero-divider mb-4"></div>

    {{-- Trip Info --}}
    <div class="mb-4">
        <h5 class="mb-3">Trip Info</h5>

        <div class="row g-3">

            <div class="col-12 col-md-6">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control bg-dark text-light border-secondary"
                       value="{{ old('date', $isEdit ? \Carbon\Carbon::parse($fishlog->date)->format('Y-m-d') : '') }}">
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Rating (1–10)</label>
                <input type="number" name="rating" min="1" max="10"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ old('rating', $isEdit ? $fishlog->rating : '') }}">
            </div>

            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" name="name"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ old('name', $isEdit ? $fishlog->name : '') }}">
            </div>

            <div class="col-12">
                <label class="form-label">Location</label>
                <input type="text" name="location"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ old('location', $isEdit ? $fishlog->location : '') }}">
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Species</label>
                <input type="text" name="species"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ old('species', $isEdit ? $fishlog->species : '') }}">
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Method</label>
                <input type="text" name="method"
                       class="form-control bg-dark text-light border-secondary"
                       value="{{ old('method', $isEdit ? $fishlog->method : '') }}">
            </div>

        </div>
    </div>

    <div class="hero-divider mb-4"></div>

    {{-- Tags --}}
    <div class="mb-4">
        <h5 class="mb-3">Tags</h5>

        <div class="row g-2">
            @foreach ($tags as $tag)
                <div class="col-12 col-md-6">
                    <div class="form-check p-3 rounded-3 h-100"
                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            id="tag{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', $isEdit ? $fishlog->tags->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                        >

                        <label class="form-check-label ms-2" for="tag{{ $tag->id }}">
                            {{ ucfirst($tag->name) }}
                        </label>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="hero-divider mb-4"></div>

    {{-- Existing Photos --}}
    @if ($isEdit && $fishlog->photos->count())
        <div class="mb-4">
            <h5 class="mb-3">Current Photos</h5>

            <div class="row g-3">
                @foreach ($fishlog->photos as $photo)
                    <div class="col-12 col-md-6">
                        <div class="p-3 rounded-3"
                             style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);">

                            <img src="{{ asset('storage/' . $photo->filePath) }}"
                                 class="img-fluid rounded mb-3"
                                 style="max-height: 220px; width: 100%; object-fit: cover;">

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="remove_photos[]"
                                       value="{{ $photo->id }}"
                                       id="remove_photo_{{ $photo->id }}">

                                <label class="form-check-label" for="remove_photo_{{ $photo->id }}">
                                    Remove photo
                                </label>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="hero-divider mb-4"></div>
    @endif

    {{-- Upload --}}
    <div class="mb-4">
        <h5 class="mb-3">Upload Photos</h5>

        <div class="p-3 rounded-3"
             style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);">

            <input
                type="file"
                name="photos[]"
                class="form-control bg-dark text-light border-secondary"
                accept="image/*"
                multiple
            >

            <div class="form-text text-secondary mt-2">
                Upload one or more photos for this trip.
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="d-flex flex-column flex-sm-row gap-3">
        <button class="btn btn-soft btn-soft-primary">
            {{ $isEdit ? 'Update Fish Log' : 'Add Fish Log' }}
        </button>

        <a href="{{ route('fishlogs.index') }}" class="btn btn-outline-light">
            Cancel
        </a>
    </div>

</div>
