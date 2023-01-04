<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
        $employee_id = $this->request->get('id');

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable',
            'email' => Rule::unique('employees')->where(function ($query)use($employee_id) {
                return $query->where('id','!=',$employee_id)->where('email','!=',null);
            }),
            'phone' => 'nullable'
        ];
    }
}
