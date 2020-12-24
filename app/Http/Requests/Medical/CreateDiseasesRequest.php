<?php

namespace App\Http\Requests\Medical;

use App\Models\Medical\Disease;
use Illuminate\Foundation\Http\FormRequest;

class CreateDiseasesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required'
        ];
    }

    public function storeDisease()
    {
        $disease = new  Disease;

        foreach ($this->except(['_token','_method','submit','images']) as $key => $value) {
            $disease[$key] = $value;
        }
        $disease->save();

        if ($this->has('images')) {
            $data = $disease->saveImage($this->images, $disease->name . mt_rand(10, 1000));
            $data['type'] = 'medical';
            $data['catigory'] = 'disease';
            $data['description'] = 'disease pictures';
            $disease->addPhoto($data);
        }
    }

}


