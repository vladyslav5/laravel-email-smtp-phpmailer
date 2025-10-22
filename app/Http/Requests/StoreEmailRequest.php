<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "from" => "required|email",
            "to" => "required|email",
            "cc" => "nullable|email",
            "subject" => "required|string|max:255",
            "type"=>"required|in:text,html",
            "body" => "required|string",
        ];
    }
}
