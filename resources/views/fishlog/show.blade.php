@extends('layouts.app')

@section('title', 'Fish Log Details')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            @if (session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="hero-card p-4 p-md-5 mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                    <div>
                        <div class="hero-kicker mb-2">Fishing log details</div>
                        <h1 class="hero-title mb-0" style="font-size: clamp(2rem, 4vw, 3rem);">
                            {{ $fishlog->name }}
                        </h1>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <a href="{{ route('fishlogs.edit', $fishlog->id) }}" class="btn btn-soft btn-soft-primary">
                            Edit Log
                        </a>
                        <a href="{{ route('fishlogs.index') }}" class="btn btn-outline-light">
                            Back to Logs
                        </a>
                    </div>
                </div>

                <div class="hero-divider mb-4"></div>

                <div class="row g-4">
                    <div class="col-12 col-lg-7">
                        <div class="rounded-4 p-4 h-100"
                             style="background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);">
                            <h3 class="mb-4" style="font-size: 1.25rem;">Trip Info</h3>

                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <div class="rounded-3 p-3 h-100"
                                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);">
                                        <div class="text-secondary small mb-1">Date</div>
                                        <div class="fw-semibold">
                                            {{ \Carbon\Carbon::parse($fishlog->date)->format('F j, Y') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="rounded-3 p-3 h-100"
                                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);">
                                        <div class="text-secondary small mb-1">Rating</div>
                                        <div class="fw-semibold">{{ $fishlog->rating }}/10</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="rounded-3 p-3 h-100"
                                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);">
                                        <div class="text-secondary small mb-1">Location</div>
                                        <div class="fw-semibold">{{ $fishlog->location }}</div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="rounded-3 p-3 h-100"
                                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);">
                                        <div class="text-secondary small mb-1">Species</div>
                                        <div class="fw-semibold">{{ $fishlog->species }}</div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="rounded-3 p-3 h-100"
                                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.06);">
                                        <div class="text-secondary small mb-1">Method</div>
                                        <div class="fw-semibold">{{ $fishlog->method }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-5">
                        <div class="rounded-4 p-4 h-100"
                             style="background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);">
                            <h3 class="mb-4" style="font-size: 1.25rem;">Tags</h3>

                            @forelse ($fishlog->tags as $tag)
                                <span class="badge rounded-pill me-2 mb-2 px-3 py-2"
                                      style="background: rgba(13,110,253,.18); color: #dbeafe; border: 1px solid rgba(13,110,253,.35); font-weight: 600;">
                                    {{ ucfirst($tag->name) }}
                                </span>
                            @empty
                                <p class="text-secondary mb-0">No tags selected for this fish log.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-card p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <div class="hero-kicker mb-2">Photo gallery</div>
                        <h2 class="mb-0" style="font-size: 1.9rem;">Trip Photos</h2>
                    </div>
                </div>

                <div class="hero-divider mb-4"></div>

                @if ($fishlog->photos->count())
                    <div id="fishlogPhotoCarousel" class="carousel slide" data-bs-ride="false">
                        @if ($fishlog->photos->count() > 1)
                            <div class="carousel-indicators">
                                @foreach ($fishlog->photos as $photo)
                                    <button type="button"
                                            data-bs-target="#fishlogPhotoCarousel"
                                            data-bs-slide-to="{{ $loop->index }}"
                                            class="{{ $loop->first ? 'active' : '' }}"
                                            aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-label="Slide {{ $loop->iteration }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <div class="carousel-inner rounded-4 overflow-hidden"
                             style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);">
                            @foreach ($fishlog->photos as $photo)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="d-flex justify-content-center align-items-center"
                                         style="min-height: 450px;">
                                        <img src="{{ asset('storage/' . $photo->filePath) }}"
                                             alt="Fish log photo {{ $loop->iteration }}"
                                             class="img-fluid"
                                             style="max-height: 540px; width: 100%; object-fit: contain;">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($fishlog->photos->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#fishlogPhotoCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#fishlogPhotoCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>

                    <div class="mt-3 text-center text-secondary" style="font-size: .95rem;">
                        {{ $fishlog->photos->count() }} photo{{ $fishlog->photos->count() === 1 ? '' : 's' }} attached
                    </div>
                @else
                    <div class="rounded-4 p-4 text-center"
                         style="background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);">
                        <p class="text-secondary mb-0">No photos uploaded for this fish log.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection


