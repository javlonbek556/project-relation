<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ];
    }
    public function message(): array
    {
        return [
            'title.required' => 'Sarlavha maydoni to\'ldirilishi shart.',
            'content.required' => 'Mazmuni maydoni to\'ldirilishi shart.',
            'image.image' => 'Fayl rasm bo\'lishi kerak.',
            'image.mimes' => 'Rasm formati: jpeg, png, jpg, gif bo\'lishi kerak.',
            'image.max' => 'Rasm hajmi 2MB dan oshmasligi kerak.',
        ];
    }
}
