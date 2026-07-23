<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $positionId = $this->route('position')?->id;

        return [
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:50|unique:positions,code,' . $positionId,
            'min_salary' => 'sometimes|required|numeric|min:0',
            'max_salary' => 'sometimes|required|numeric|min:0|gte:min_salary',
            'description' => 'nullable|string',
        ];
    }
}
