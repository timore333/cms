<?php

namespace App\Http\Requests;


use App\Models\Tenants\Admin\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => ['required', 'email',
                Rule::unique('users')->ignore($this->user)
            ],

            'username' => [
                'required',
                'string',
                Rule::unique('users')->ignore($this->user)
            ],

        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.unique' => 'This username is used, try another one',
            'email.unique' => 'This email is already registerd, try another one',
            'email.email' => 'You shoul inter avalid email',
        ];
    }

    public function update()
    {
        $this->user->update($this->only('name', 'username', 'email'));

        if($this->has('phones')) {
            $this->user->removeAllPhones();
            $this->user->addPhones($this->phones);
        }

        if($this->has('role')) {
            // check if the user is super admin
            if($this->user->getRole() === 'super-admin') {
                // we need to check if there is any super admins or not before updating.
                if(User::admins()->count() !== 1) {
                    $this->updateRole();
                    $this->session()->flash('message-success', 'Role Updated.');
                } else {
                    // we need to flash message that we don't have more than one super admin.
                    $this->session()->flash('message-error', 'This is The Only admin, you should always have at least one admin, if you want to update you need to create admin first.');
                }
            } else {
                $this->updateRole();
                $this->session()->flash('message-success', 'Role Updated.');
            }
        }

    }

    public function updateRole()
    {
        $this->user->removeAllRoles();
        $this->user->assignRole($this['role']);
    }

}
