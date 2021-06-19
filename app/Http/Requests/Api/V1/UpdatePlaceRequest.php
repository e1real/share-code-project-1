<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceRequest extends FormRequest
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
            'place.name' => 'string|max:255',
            'place.name_de' => 'string|nullable|max:255',
            'place.name_sk' => 'string|nullable|max:255',
            'place.description' => 'string|nullable|max:1024',
            'place.description_de' => 'string|nullable|max:1024',
            'place.description_sk' => 'string|nullable|max:1024',
            'place.opening_non_stop' => 'nullable',
            'place.temporarily_closed' => 'nullable',
            'photos' => 'nullable|array',
            'map_data.address' => 'string|max:512',
            'map_data.lat' => 'nullable',
            'map_data.lon' => 'nullable',
            'map_data.place_map_data_id' => 'integer',
            'place_opening_time' => 'nullable|array'
        ];
    }
}
