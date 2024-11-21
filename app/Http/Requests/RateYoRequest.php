<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RateYoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to true if all users are allowed to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $errors,
            ], 422)
        );
    }
    public function rules()
    {
        return [
            'course_id' => 'required|integer', // Ensures course_id is valid
            'comment' => 'required|string', // Comment as required with a max length of 255
            'rate' => 'required|numeric|min:1|max:5', // Rate as a number between 1 and 5
            'user_id' => 'required|integer', // Ensures user_id is valid
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'course_id.required' => 'ID khóa học không bỏ trống.',
            'comment.required' => 'Bình luận không bỏ trống.',
            'rate.required' => 'The rate is required.',
            'rate.min' => 'Số sao nhỏ nhất là 1.',
            'rate.max' => 'Số sao lớn nhất là 5.',
            'user_id.required' => 'ID Người dùng không bỏ trống.',
        ];
    }
}
