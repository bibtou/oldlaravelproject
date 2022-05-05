<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class RequestManageArticle extends FormRequest
{
	protected $minAndMaxYear = [
		'min' => 2020,
		'max' => 2040
	];
	
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //auth()->check();
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
			'category' => 'required|numeric|exists:categories,id',
			'published' => [
				'required',
				'numeric',
				'regex:/^(' . Article::UNPUBLISHED . '|' . Article::PUBLISHED . ')$/'
			],
			'status' => [
				'required',
				'numeric',
				'regex:/^(' . Article::PUBLIC_POST . '|' . Article::PRIVATE_POST . ')$/'
			],
			'displayed_at_day' => 'required|numeric|between:1,31',
			'displayed_at_month' => 'required|numeric|between:1,12',
			'displayed_at_year' => 'required|numeric|between:' . sprintf(
				'%s,%s',
				$this->minAndMaxYear['min'], $this->minAndMaxYear['max']
			),
			'displayed_at_hour' => 'required|regex:/^[0-9]{2}$/',
			'displayed_at_minute' => 'required|regex:/^[0-9]{2}$/',
			'slug' => 'required|unique:articles,slug,' . $this->id ?? 0,
			'excerpt' => 'required',
			'article' => 'required'
        ];
    }
	
	public function messages()
	{
		return [
			'title.required' => 'Le champs Titre est requis',
			'title.max' => 'Le champs Titre ne doit pas faire plus de 125 caractères',
			'category.required' => 'Une Catégorie doit être choisie',
			'category.exists' => 'La Catégorie choisie n\'existe pas',
			'category.numeric' => 'Le champs Catégorie est incorrect',
			'published.required' => 'Le champs Publier doit être renseigné',
			'published.numeric' => 'Le champs Publier est incorrect',
			'published.regex' => 'Le champs Publier est incorrect',
			'status.required' => 'Le champs Statut doit être renseigné',
			'status.numeric' => 'Le champs Statut est incorrect',
			'status.regex' => 'Le champs Statut est incorrect',
			'displayed_at_day.required' => 'Le champs Jour doit être renseigné',
			'displayed_at_day.numeric' => 'Le champs Jour est incorrect',
			'displayed_at_day.between' => 'Le champs Jour est incorrect',
			'displayed_at_month.required' => 'Le champs Mois doit être renseigné',
			'displayed_at_month.numeric' => 'Le champs Mois est incorrect',
			'displayed_at_month.between' => 'Le champs Mois est incorrect',		
			'displayed_at_year.required' => 'Le champs Année doit être renseigné',
			'displayed_at_year.numeric' => 'Le champs Année est incorrect',
			'displayed_at_year.between' => 'Le champs Année est incorrect',
			'displayed_at_hour.required' => 'Le champs Heure doit être renseigné',
			'displayed_at_hour.numeric' => 'Le champs Heure est incorrect',
			'displayed_at_hour.between' => 'Le champs Heure est incorrect',
			'displayed_at_hour.regex' => 'Le champs Heure est incorrect',
			'displayed_at_minute.required' => 'Le champs Minute doit être renseigné',
			'displayed_at_minute.numeric' => 'Le champs Minute est incorrect',
			'displayed_at_minute.between' => 'Le champs Minute est incorrect',
			'displayed_at_minute.regex' => 'Le champs Minute est incorrect',
			'slug.required' => 'Le champs Slug doit être renseigné',
			'slug.unique' => 'La valeur du champs Slug est déjà utilisée pour un autre article',
			'excerpt.required' => 'Le champs Description doit être renseigné',
			'article.required' => 'Le champs Article doit être renseigné',
		];
	}
	
	public function getDateFormatted()
	{
		$displayedAtDay = $this->request->has('displayed_at_day') ? $this->request->get('displayed_at_day') : '0';
		$displayedAtMonth = $this->request->has('displayed_at_month') ? $this->request->get('displayed_at_month') : '0';
		$displayedAtYear = $this->request->has('displayed_at_year') ? $this->request->get('displayed_at_year') : '0';
		$displayedAtHour = $this->request->has('displayed_at_hour') ? $this->request->get('displayed_at_hour') : '0';
		$displayedAtMinute = $this->request->has('displayed_at_minute') ? $this->request->get('displayed_at_minute') : '0';

		$displayedAt = mktime($displayedAtHour, $displayedAtMinute, 0, $displayedAtMonth, $displayedAtDay, $displayedAtYear);

		return date('Y-m-d H:i:s', $displayedAt);
	}

	protected function prepareForValidation() {
		if(empty($this->category) === TRUE or $this->category == 0) {
			$this->request->remove('category');
		}
	}
	
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			if(checkdate($this->displayed_at_month, $this->displayed_at_day, $this->displayed_at_year) === FALSE) {
				$validator->errors()->add('published_at', 'La date de publication est incorrecte' ?? 'Error');
			}
		});
	}


/*
	protected function failedValidation($validator) {
		exit('erreur');
	}
*/
}