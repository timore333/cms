<?php

namespace App\Http\Request\Admins;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Tenants\Admin\Role;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
//                       'name' => 'required|min:3|max:255',
//                        Rule::unique('roles')->ignore($this->role)
        ];
    }

    public function update()
    {
        $role = Role::find($this->role['id']);
        $role->removeAllPermissions();
        if($this['permissions']) {
            foreach($this['permissions'] as $permission) {
                $role->givePermissionTo($permission);
            }
        }
        $role->save();
    }

}
