@extends('blog.admin.default')

@empty($article->id)
	@php
		$title = 'Gestion - Créer un nouvel article';
	@endphp
@else
	@php
		$title = 'Gestion - Editer l\'article';
	@endphp
@endif

@section('title', $title)

@section('content')

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="m-0">
						@empty($article->id)
							Nouvel article
						@else
						{{ $article->title }}
						@endif
						</h5>
					</div>
					<div class="card-body">
						<form action="{{ $route }}" method="post">
							@if (session('success_store'))
								<div class="alert alert-success">
									L'article a bien été créé
								</div>
							@elseif (session('success_edit'))
								<div class="alert alert-success">
									L'article a bien été édité
								</div>
							@endif

							@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
									@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
									</ul>
								</div>
							@endif

							@csrf

							@if (isset($article->id))
								@method('PUT')
							@endif
							
							@if($article->created_at)
								
							<div class="form-row mb-4">
								<div class="col-lg">
									<i class="fa fa-clock" aria-hidden="true"></i> Créé le :
									<span id="article-created-at">{{ $article->getFormattedDateToText($article->created_at) }}</span>
								</div>
								
								<div class="col-lg">
									@if($article->updated_at)
										<i class="fa fa-clock" aria-hidden="true"></i> Mis à jour le :
										<span id="article-updated-at">{{ $article->getFormattedDateToText($article->updated_at) }}</span>
									@endif
								</div>
								
								<div class="col-lg">
									<i class="fa fa-clock" aria-hidden="true"></i> Affiché le :
									<span id="article-displayed-at">{{ $article->getFormattedDateToText($article->displayed_at) }}</span>
								</div>
							</div>
							
							@endif

							<div class="form-row mb-4">
								<div class="block-enclosing col-lg">
									<label for="category"><i class="fa fa-tag"></i> Catégorie</label>
									@if ($categories->isEmpty())
										<a href="{{ route('blog.admin.category.create') }}">Créer</a>
									@else
									<select id="category" name="category" class="form-control">
										<option value="0">Choisir une catégorie</option>
									@php
										$categoryToSelect = isset($article->category->id) ? $article->category->id : old('category', 0);
									@endphp

									@foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $categoryToSelect == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
									@endforeach
									</select>
									@endif
								</div>
								
								<div class="block-enclosing col-lg">
									<label for="published"><i class="fa fa-eye"></i> Publier l'article</label>
									<select id="published" name="published" class="form-control">
										<option value="{{ $article::UNPUBLISHED }}" @if (old('published', $article->published) == $article::UNPUBLISHED) selected @endif>Non publié</option>
										<option value="{{ $article::PUBLISHED }}"   @if (old('published', $article->published) == $article::PUBLISHED) selected @endif>Publié</option>
									</select>
								</div>
								
								<div class="block-enclosing col-lg">
									<label for="status"><i class="fa fa-user-lock"></i> Statut</label>
									<select id="status" name="status" class="form-control">
										<option value="{{ $article::PRIVATE_POST }}" @if (old('status', $article->private) == $article::PRIVATE_POST) selected @endif>Privé</option>
										<option value="{{ $article::PUBLIC_POST }}"  @if (old('status', $article->private) == $article::PUBLIC_POST) selected @endif>Public</option>
									</select>
								</div>
							</div>
							
							<div class="form-row mb-2">
								<div class="block-enclosing col-lg">
									<strong id="published_at">Date d'affichage</strong>
								</div>
							</div>

							<div class="form-row mb-4">
								<div class="block-enclosing col-lg">
									<label for="displayed_at_day"><i class="fa fa-calendar-alt"></i> Jour</label>
									<select id="displayed_at_day" name="displayed_at_day" class="form-control">
									@php
										$dayToSelect = $article->displayed_at ? date('d', strtotime($article->displayed_at)) : old('displayed_at_day', 0);
									@endphp
									@for ($i = 0; $i <= 31; $i++)
										<option value="{{ $i }}" {{ $dayToSelect == $i ? 'selected' : '' }}>{{ $i }}</option>
									@endfor
									</select>								
								</div>

								<div class="block-enclosing col-lg">
									<label for="displayed_at_month"><i class="fa fa-calendar-alt"></i> Mois</label>
									<select id="displayed_at_month" name="displayed_at_month" class="form-control">
									@php
										$monthToSelect = $article->getOriginal('displayed_at') ? date('m', strtotime($article->getOriginal('displayed_at'))) : old('displayed_at_month', 0);
									@endphp
									@for ($i = 0; $i <= 12; $i++)
										<option value="{{ $i }}" {{ $monthToSelect == $i ? 'selected' : '' }}>{{ $i }}</option>
									@endfor
									</select>								
								</div>
									
								<div class="block-enclosing col-lg">
									<label for="displayed_at_year"><i class="fa fa-calendar-alt"></i> Année</label>
									<select id="displayed_at_year" name="displayed_at_year" class="form-control">
										<option value="0">0000</option>
									@php
										$yearToSelect = $article->getOriginal('displayed_at') ? date('Y', strtotime($article->getOriginal('displayed_at'))) : old('displayed_at_year', 0);
										$maxYear = $startYear + 20;
									@endphp
									@for ($i = $startYear; $i <= $maxYear; $i++)
										<option value="{{ $i }}" {{ $yearToSelect == $i ? 'selected' : '' }}>{{ $i }}</option>
									@endfor
									</select>
								</div>
								
								<div class="block-enclosing col-lg">
									<label for="displayed_at_hour"><i class="fa fa-clock"></i> Heure</label>
									<select id="displayed_at_hour" name="displayed_at_hour" class="form-control">
									@php
										$hourToSelect = $article->getOriginal('displayed_at') ? date('H', strtotime($article->getOriginal('displayed_at'))) : old('displayed_at_hour', 0);
									@endphp
									@for ($i = 0; $i <= 24; $i++)
										<option value="{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}" {{ $hourToSelect == $i ? 'selected' : '' }}>{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</option>
									@endfor
									</select>
								</div>
								
								<div class="block-enclosing col-lg">
									<label for="displayed_at_minute"><i class="fa fa-clock"></i> Minute</label>
									<select id="displayed_at_minute" name="displayed_at_minute" class="form-control">
									@php
										$minuteToSelect = $article->getOriginal('displayed_at') ? date('i', strtotime($article->getOriginal('displayed_at'))) : old('displayed_at_minute', 0);
									@endphp
									@for ($i = 0; $i <= 59; $i++)
										<option value="{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}" {{ $minuteToSelect == $i ? 'selected' : '' }}>{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</option>
									@endfor
									</select>
								
								</div>
								
							</div>

							<div class="block-enclosing mb-4">
								<div>
									<label for="title" class="pointer">
									@error('title')
									<span class="text-danger">{{ $message }}</span><br>
									@enderror
									Titre
									</label>
								</div>

								<div @error('title') class="has-error" @enderror >
									<input type="text" id="title" name="title" class="form-control" value="{!! old('title', $article->title) !!}" style="width: 100%">
								</div>
							</div>
							
							<div class="block-enclosing mb-4">
								<div>
									<label for="slug" class="pointer">
									@error('slug')
									<span class="text-danger">{{ $message }}</span><br>
									@enderror
									Slug
									</label>
								</div>

								<div class="form-inline @error('slug') has-error @enderror ">
									<input type="text" id="input-slug" class="form-control" name="slug" value="{{ old('slug', $article->slug) }}" style="width: 80%" {{  $article->id > 0 ? 'readonly' : '' }}>
									<button type="button" id="disabled-slug"
										@if($article->id > 0)
											class="btn btn-danger">
											<i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Vérrouiller
										@else
											class="btn btn-primary">
											<i class="fa fa-lock-open" aria-hidden="true"></i>&nbsp;&nbsp;Déverrouiller
										@endif
									</button>
								</div>
							</div>
							
							<div class="block-enclosing mb-4">
								<div>
									<label for="excerpt" class="pointer">
									@error('excerpt')
									<span class="text-danger">{{ $message }}</span><br>
									@enderror
									Introduction
									</label>
								</div>

								<div @error('excerpt') class="has-error" @enderror >
									<textarea id="excerpt" name="excerpt" class="form-control" style="width: 100%; min-height: 150px">{!! old('excerpt', $article->description) !!}</textarea>
								</div>
							</div>
							
							<div class="block-enclosing mb-4">
								<div>
									<label for="article">
									@error('article')
									<span class="text-danger">{{ $message }}</span><br>
									@enderror
									Article</label>
								</div>

								<div>
									<textarea id="article" name="article" hidden>{!! old('article', $article->article) !!}</textarea>
								</div>
							</div>
							
							<div class="mb-4">
								<div class="float-right">
									<input type="submit" class="btn btn-primary" value="Valider">
									@isset($article->id)
									<input type="hidden" name="id" value="{{ $article->id }}">
									@endisset
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script>
		function updatePage(form, response) {
			if(response.created_at) {
				form[0].reset();
				Laraberg.setContent('');
			} else {
				const updatedAt = form.find('#article-updated-at');
				const displayedAt = form.find('#article-displayed-at');

				if(updatedAt.length === 1) {
					updatedAt.text(response.updated_at_formatted);
				}

				if(displayedAt.length === 1) {
					displayedAt.text(response.displayed_at_formatted);
				}
			}
		}

		function addFormErrorAfterValidation(form, response) {
			const errors = response.responseJSON.errors;

			form.find('input, textarea, select').removeClass('border-danger');
			form.find('.text-danger').remove();

			if(errors.category) {
				form.find('#category')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.category}</div>`);
			}

			if(errors.published) {
				form.find('#published')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.published}</div>`);
			}

			if(errors.status) {
				form.find('#status')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.status}</div>`);
			}

			if(errors.displayed_at_day) {
				form.find('#displayed_at_day')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.displayed_at_day}</div>`);
			}

			if(errors.displayed_at_month) {
				form.find('#displayed_at_month')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.displayed_at_month}</div>`);
			}

			if(errors.displayed_at_year) {
				form.find('#displayed_at_year')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.displayed_at_year}</div>`);
			}

			if(errors.displayed_at_hour) {
				form.find('#displayed_at_hour')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.displayed_at_hour}</div>`);
			}

			if(errors.displayed_at_minute) {
				form.find('#displayed_at_minute')
					.addClass('border-danger')
					.after(`<div class="text-danger">${errors.displayed_at_minute}</div>`);
			}

			if(errors.published_at) {
				form.find('#published_at').after(`<div class="text-danger">${errors.published_at}</div>`);
			}

			if(errors.title) {
				form.find('#title').addClass('border-danger');
				form.find('label[for="title"]').after(`<div class="text-danger">${errors.title}</div>`);
			}

			if(errors.slug) {
				form.find('#slug').addClass('border-danger');
				form.find('label[for="slug"]').after(`<div class="text-danger">${errors.slug}</div>`);
			}

			if(errors.excerpt) {
				form.find('#excerpt').addClass('border-danger');
				form.find('label[for="excerpt"]').after(`<div class="text-danger">${errors.excerpt}</div>`);
			}

			if(errors.article) {
				form.find('#article').addClass('border-danger');
				form.find('label[for="article"]').after(`<div class="text-danger">${errors.article}</div>`);
			}
		}

		function handled(form) {
			
		}
		</script>
@endsection