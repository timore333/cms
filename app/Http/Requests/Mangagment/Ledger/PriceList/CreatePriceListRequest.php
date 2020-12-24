<?php

namespace App\Http\Requests\Managment\Ledger\PriceList;

use App\Models\Medical\Price;
use App\Models\Medical\PriceList;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Validator;
use Validator;

class CreatePriceListRequest extends FormRequest
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
           'name' => 'required:string|unique:price_lists',

        ];
    }

    public function messages()
    {
        return [
            'prices.price.required' => 'The service should has a price !',
            'prices.price.numeric' => 'The price should be valid digits !',
            'email.unique'  => 'This email is already registerd, try another one',
            'email.email'  => 'You shoul inter avalid email',
        ];
    }

    public function createPriceList()
    {


        $priceList = PriceList::create($this->only('name','description'));

        if($this['prices']){
            $this->addPrices($priceList);
        }
    }

    public function addPrices(PriceList $priceList)
    {
         foreach ($this['prices'] as $price) {
            $priceList->addProcedure($price['service_id'], $price['price'], $price['code']);
        }
    }
}
