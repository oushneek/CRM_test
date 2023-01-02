<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends FormRequest
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
     */
    public function rules()
    {
        $company_id = $this->request->get('id');

        return [
            'name' => 'required',
            'email' => 'nullable|unique:companies',
            'email' => Rule::unique('companies')->where(function ($query)use($company_id) {
                return $query->where('id','!=',$company_id);
            }),
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'nullable'
        ];
    }
}
