<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Fishlogs;

class UpdateFishlogsRequest extends FormRequest
{
    public function authorize(): bool
    {
        $fishlog = $this->route('fishlog');

        return $fishlog && $this->user()->can('update', $fishlog);
    }

    public function rules(): array
    {
        return [
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
            'remove_photos' => 'nullable|array',
            'remove_photos.*' => 'integer|exists:photos,id',
        ];
    }
}
