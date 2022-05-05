<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RequestManageCategory extends FormRequest
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
			'title' => 'required|between:2,50|unique:categories,title,' . $this->id ?? 0,
            'slug' => 'required|between:2,100|unique:categories,slug,' . $this->id ?? 0,
			'description' => 'required|between:10,255'
        ];
    }
	
	public function messages()
	{
		return [
			'title.required' => 'Le champs Titre doit être renseigné',
			'title.between' => 'Le champs Titre doit contenir entre 2 et 100 caractères',
			'title.unique' => 'La valeur du champs Titre est déjà utilisée par une autre catégorie',
			'slug.required' => 'Le champs Slug doit être renseigné',
			'slug.between' => 'Le champs Slug doit contenir entre 2 et 100 caractères',
			'slug.unique' => 'La valeur du champs Slug est déjà utilisée par une autre catégorie',
			'description.required' => 'Le champs Description doit être renseigné',
			'description.between' => 'Le champs Description doit contenir entre 10 et 255 caractères'
		];
	}
}
