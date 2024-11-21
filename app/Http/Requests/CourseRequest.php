<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'number_of_lessons' => 'required|integer|min:1',
            'course_type' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên khóa không được bỏ trống.',
            'price.required' => 'Giá không bỏ trống.',
            'user_id.required' => 'Không được bỏ trống.',
            'number_of_lessons.required' => 'Số buổi học không được bỏ trống',
            'course_type.required' => 'Loại khóa học không được bỏ trống.',
        ];
    }
}
