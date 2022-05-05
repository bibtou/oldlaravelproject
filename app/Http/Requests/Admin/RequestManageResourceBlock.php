<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestManageResourceBlock extends FormRequest
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
            'title' => 'required|max:125',
			'description' => 'required',
			'links.*' => [Rule::requiredIf(empty(request()->allLinks) === true), 'url'],
			'allLinks' => Rule::requiredIf(count(request()->links) === 0),
        ];
    }

	public function messages()
	{
		return [
			'title.required' => 'Le champs Titre est requis.',
			'title.max' => 'Le champs Titre ne doit pas faire plus de 125 caractères.',
			'description.required' => 'Le champs Description est requis.',
			'links.*.required' => 'Le champs Lien associés à ce bloc est requis (au moins 1 lien doit être renseigné).',
			'links.*.url' => 'Le champs contenant le lien n\'est pas une URL correcte.'
		];
	}
}
