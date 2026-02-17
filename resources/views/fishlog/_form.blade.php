@php
  $isEdit = isset($fishlog);
@endphp

<div class="mb-3">
  <label class="form-label">Date</label>
  <input type="date" name="date" class="form-control"
         value="{{ old('date', $isEdit ? \Carbon\Carbon::parse($fishlog->date)->format('Y-m-d') : '') }}">
</div>

<div class="mb-3">
  <label class="form-label">Name</label>
  <input type="text" name="name" class="form-control"
         value="{{ old('name', $isEdit ? $fishlog->name : '') }}">
</div>

<div class="mb-3">
  <label class="form-label">Location</label>
  <input type="text" name="location" class="form-control"
         value="{{ old('location', $isEdit ? $fishlog->location : '') }}">
</div>

<div class="mb-3">
  <label class="form-label">Species</label>
  <input type="text" name="species" class="form-control"
         value="{{ old('species', $isEdit ? $fishlog->species : '') }}">
</div>

<div class="mb-3">
  <label class="form-label">Method</label>
  <input type="text" name="method" class="form-control"
         value="{{ old('method', $isEdit ? $fishlog->method : '') }}">
</div>

<div class="mb-3">
  <label class="form-label">Rating (1–10)</label>
  <input type="number" name="rating" min="1" max="10" class="form-control"
         value="{{ old('rating', $isEdit ? $fishlog->rating : '') }}">
</div>

<button class="btn btn-primary">
  {{ $isEdit ? 'Update Fish Log' : 'Add Fish Log' }}
</button>
<a href="{{ route('fishlogs.index') }}" class="btn btn-secondary ms-2">Cancel</a>
