@extends('blog.admin.default')

@empty($page->id)
	@php
		$title = 'Créer une nouvelle page de ressource';
		$method = 'POST';
	@endphp
@else
	@php
		$title = "Editer la page de ressource";
		$method = 'PUT';
	@endphp
@endif

@section('title', 'Gestion - ' . $title)

@section('content')


		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h5 class="m-0">
						@empty($page->id)
							Nouvelle page
						@else
						{{ $page->title }}
						@endif
						</h5>
					</div>
					<div class="card-body">
						<form action="{{ $route }}" method="post">
							@if(session('success_store'))
								<div class="alert alert-success">
									La page a bien été créée
								</div>
							@elseif (session('success_edit'))
								<div class="alert alert-success">
									La page a bien été éditée
								</div>
							@endif

							@csrf

							@method($method)
							
							@if($page->created_at)
								
							<div class="form-row mb-4">
								<div class="col-lg">
									<i class="fa fa-clock" aria-hidden="true"></i> Créée le :
									<span id="page-created-at"><?php // {{ $article->getFormattedDateToText($article->created_at) }} ?></span>
								</div>
								
								<div class="col-lg">
									@if($page->updated_at)
										<i class="fa fa-clock" aria-hidden="true"></i> Mise à jour le :
										<span id="page-updated-at"><?php //{{ $article->getFormattedDateToText($article->updated_at) }} ?></span>
									@endif
								</div>
							</div>

							<div class="form-row mb-4">
								<div class="col-lg">
								{{ route('blog.admin.resource-page.page-with-slug', ['page_id' => $page->id, 'page_slug' => $page->slug]) }}
								</div>
							</div>
							
							@endif

							<div class="form-row mb-4">								
								<div class="block-enclosing col-lg">
									@if(empty($page->id))
										@php
											$unpublished = -1;
											$published = -1;
										@endphp
									@else
										@php
											$unpublished = \App\Models\Page::UNPUBLISHED;
											$published = \App\Models\Page::PUBLISHED;
										@endphp
									@endif
									<label for="published"><i class="fa fa-eye"></i> Publier la page</label>
									<select id="published" name="published" class="form-control">
										<option value="{{ \App\Models\Page::UNPUBLISHED }}"@if($page->published == $unpublished) selected @endif>Non publié</option>
										<option value="{{ \App\Models\Page::PUBLISHED }}"@if($page->published == $published) selected @endif>Publié</option>
									</select>
								</div>
								
								<div class="block-enclosing col-lg">
									@if(empty($page->id))
										@php
											$private = -1;
											$public = -1;
										@endphp
									@else
										@php
											$private = \App\Models\Page::PRIVATE_POST;
											$public = \App\Models\Page::PUBLIC_POST;
										@endphp
									@endif
									<label for="private"><i class="fa fa-user-lock"></i> Statut</label>
									<select id="private" name="private" class="form-control">
										<option value="{{ \App\Models\Page::PRIVATE_POST }}"@if($page->private == $private) selected @endif>Privé</option>
										<option value="{{ \App\Models\Page::PUBLIC_POST }}"@if($page->private == $public) selected @endif>Public</option>
									</select>
								</div>
							</div>

							<div class="block-enclosing mb-4">
								<div>
									<label for="title" class="pointer">Titre</label>
								</div>

								<div>
									<input type="text" id="title" name="title" class="form-control" value="{!! $page->title !!}" style="width: 100%">
								</div>
							</div>

							<div class="block-enclosing mb-4">
								<div>
									<label for="url-source" class="pointer">URL Source</label>
								</div>

								<div>
									<input type="text" id="url-source" name="url_source" class="form-control" value="{!! $page->link->link ?? '' !!}" style="width: 100%">
								</div>
							</div>
							
							<div class="block-enclosing mb-4">
								<div>
									<label for="description" class="pointer">Description</label>
								</div>

								<div>
									<textarea id="description" name="description" class="form-control" style="width: 100%; min-height: 150px">{!! $page->description !!}</textarea>
								</div>
							</div>
							
							<div class="block-enclosing mb-4">
								<div>
									<label for="content">Contenu</label>
								</div>

								<div>
									<textarea id="article" name="content" hidden>{!! $page->content !!}</textarea>
								</div>
							</div>
							
							<div class="mb-4">
								<div class="float-right">
									<input type="submit" class="btn btn-primary" value="Valider">
									@isset($page->id)
									<input type="hidden" name="id" value="{{ $page->id }}">
									@endisset
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script>
		/*
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
		*/
		</script>

@endsection