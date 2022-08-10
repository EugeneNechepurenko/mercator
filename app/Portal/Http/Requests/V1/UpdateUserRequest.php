<?php

namespace App\Portal\Http\Requests\V1;

use App\Http\Requests\ApiRequest;
use App\Portal\Models\User;
use App\Portal\Models\Role;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 *
 * @package App\Portal\Http\Requests\V1
 */
class UpdateUserRequest extends ApiRequest
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
        $role = $this->route('user')->getRoleName();

        $rules = [
            'first_name'        => 'required|string',
            'last_name'         => 'required|string',
            'status'            => ['required', Rule::in([User::STATUS_ACTIVE, User::STATUS_INACTIVE])],
        ];

        if ($role === Role::ROLE_COMPANY_ADMIN) {
            $rules['company_id'] = 'required|integer|exists:companies,id,deleted_at,NULL';
        }


        return $rules;
    }
}
