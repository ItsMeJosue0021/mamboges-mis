<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
    //  */
    // public function rules(): array
    // {
    //     return [
    //         'name' => ['string', 'max:255'],
    //         'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
    //         'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    //     ];
    // }

    // /**
    //  * Store the uploaded file and return the file path.
    //  *
    //  * @param  string  $fieldName
    //  * @param  string  $disk
    //  * @return string|null
    //  */
    // public function storeUploadedFile(string $fieldName, string $disk = 'public'): ?string
    // {
    //     if ($this->hasFile($fieldName)) {
    //         $file = $this->file($fieldName);

    //         return $file->store('profile', $disk);
    //     }

    //     return null;
    // }
}
