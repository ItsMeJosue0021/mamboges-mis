<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'nullable',
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'nullable',
            'suffix' => 'nullable',
            'sex' => 'required|in:Male,Female',
            'contactNumber' => 'nullable',
            'dob' => 'required|date',
            'lrn' => 'required|numeric',
            'lot' => 'nullable',
            'block' => 'nullable',
            'street' => 'nullable',
            'subdivision' => 'nullable',
            'barangay' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zipCode' => 'nullable|numeric',
            'parentsFirstName' => 'required',
            'parentsLastName' => 'required',
            'parentsMiddleName' => 'nullable',
            'parentsSuffix' => 'nullable',
            'parentsSex' => 'required|in:Male,Female',
            'parentsContactNumber' => 'nullable',
            'parentsEmail'=> 'required|email',
            'parentsDob' => 'required|date',
        ];
    }
}
