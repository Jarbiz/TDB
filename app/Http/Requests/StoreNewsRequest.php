<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng thực hiện yêu cầu này
    }

    // Ghi đè phương thức failedValidation để tùy chỉnh phản hồi lỗi
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
            'title' => 'required|string',
            'short_desc' => 'required|string',
            'category_news_id' => 'required|integer',
            'description' => 'required|string',
            'user_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'short_desc.required' => 'Mô tả ngắn là bắt buộc.',
            'short_desc.string' => 'Mô tả ngắn phải là một chuỗi.',
            'short_desc.max' => 'Mô tả ngắn không được vượt quá 500 ký tự.',
            'category_news_id.required' => 'Danh mục là bắt buộc.',
            'category_news_id.exists' => 'Danh mục đã chọn không tồn tại.',
            'description.required' => 'Mô tả là bắt buộc.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'user_id.required' => 'ID người dùng là bắt buộc.',
         
        ];
    }
}
