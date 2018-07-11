<?php

namespace Maxfactor\CMS\Http\Admin\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $role = $this->route('role');
        $roleId = optional($role)->id ?? null;

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('roles')->ignore($roleId),
            ],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('roles')->ignore($roleId),
            ],
            'permissions' => 'nullable|array',
        ];
    }
}
