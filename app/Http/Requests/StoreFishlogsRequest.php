<?php




namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFishlogsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
        ];
    }
}

