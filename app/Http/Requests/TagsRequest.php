<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class TagsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws Exception
     */
    public function rules()
    {
        $jsonRule = [
            'json'
        ];
        $tag = $this->post('tag');
        if($this->post('tag')){
            $validator = Validator::make([$tag], $jsonRule);
            if($validator->passes()){
                $rules = [
                    'name' => 'required|max:100',
                ];
                if($this->method() != "PUT" && $this->method() != "PATCH"){
                    $rules['post_id'] = 'required|integer';
                }

                $tag = json_decode($tag, true);
                $validator = Validator::make($tag, $rules);
                if($validator->passes()){
                    return $validator->validate();
                } else{
                    dd($validator->errors()->all());
                }

            } else{
                dd($validator->errors()->all());
            }
        } else{
            return throw new Exception('Error');
        }
    }
}
