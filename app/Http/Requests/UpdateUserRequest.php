<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->user()->role == Role::ADMIN->status() || $this->id == auth()->user()->id;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => __('model.user.name'),
            'email' => __('model.user.email'),
            'phone' => __('model.user.phone'),
            'password' => __('model.user.password'),
            'role' => __('model.user.role'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($this->id)],
            'phone' => ['nullable'],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'string', 'in:admin,staff'],
            'is_active' => ['nullable'],
        ];
    }
}
