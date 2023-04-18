<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'category_id'=>'required|integer',
            'thumbnail'=>'nullable|image',
        ];
    }
    public function messages()
    {
        return[
            'title.required'=>'Название категории не было заполнено!',
            'description.required'=>'Ваша цитата не была заполнена!',
            'content.required'=>'Содержание поста - пустое',
            'category_id.required'=>'Категория не выбрана',
            'category_id.integer'=>'Категория должна быть числом',
            'thumbnail.image'=>'Вы загрузили не картинку'
        ];
    }
}
