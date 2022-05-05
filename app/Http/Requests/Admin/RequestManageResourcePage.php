<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Page;

class RequestManageResourcePage extends FormRequest
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
			'published' => [
				'required',
				'numeric',
				'regex:/^(' . Page::UNPUBLISHED . '|' . Page::PUBLISHED . ')$/'
			],
			'private' => [
				'required',
				'numeric',
				'regex:/^(' . Page::PUBLIC_POST . '|' . Page::PRIVATE_POST . ')$/'
			],
			'title' => 'required|max:125',
			'url_source' => 'url|nullable',
			'description' => '',
			'content' => ''
        ];
    }

	public function messages()
	{
		return [
			'published.required' => 'Le champs Publier doit être renseigné',
			'published.numeric' => 'Le champs Publier est incorrect',
			'published.regex' => 'Le champs Publier est incorrect',
			'private.required' => 'Le champs Statut doit être renseigné',
			'private.numeric' => 'Le champs Statut est incorrect',
			'private.regex' => 'Le champs Statut est incorrect',
			'title.required' => 'Le champs Titre est requis',
			'title.max' => 'Le champs Titre ne doit pas faire plus de 125 caractères',
			'url_source.url' => 'Le champs URL source doit contenir une URL valide',
			'content.required' => 'Le champs Contenu doit être renseigné'
		];
	}
}
