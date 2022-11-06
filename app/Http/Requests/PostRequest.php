<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class PostRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function rules()
    {
        $jsonRule = [
             'json'
        ];
        $post = $this->post('post');
        if($this->post('post')){
            $validator = Validator::make([$post], $jsonRule);
            if($validator->passes()){
                $post = json_decode($post, true);
                $rules = [
                    'title' => 'required|max:100',
                    'description' => 'max:500',
                    'content' => 'required',
                    'post_id' => 'integer'
                ];
                if($this->method() == "PATCH"){
                    $rules = [
                        'title' => 'max:100',
                        'description' => 'max:500',
                        'post_id' => 'integer'
                    ];
                } else if($this->method() != "PUT"){
                    array_key_exists('post_id', $post) ? : $post['post_id'] = "0";
                }

                $validator = Validator::make($post, $rules);
                if($validator->passes()){
                    return $validator->validate();
                } else{
                    dd($validator->errors()->all());
                }
            } else{
                dd($validator->errors()->all());
            }
        } else{
            return throw new Exception();
        }
    }
}
