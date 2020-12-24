<?php

namespace App\Http\Requests\Managment\Ledger\PriceList;

use App\Models\Medical\Price;
use App\Models\Medical\PriceList;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceListRequest extends FormRequest
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
            //
        ];
    }

    public function updatePriceList(PriceList $priceList)
    {
        $priceList->update($this->only('name','description'));
        $this->updatePrices($priceList);
    }

    public function updatePrices(PriceList $priceList)
    {
            // $priceList->removeAllPrices();
        $priceList->procedures()->detach();
            foreach ($this['prices'] as $price ) {
              $priceList->procedures()->attach($price['service'],
               [
                'price'=> $price['price'],
                'code' => isset($price['code'])? $price['code'] : null
               ]);
            }
            $priceList->save();
    }
}
