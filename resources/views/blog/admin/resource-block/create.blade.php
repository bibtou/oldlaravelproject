@extends('blog.admin.default')

@empty($block->id)
	@php
		$title = 'Créer un nouveau bloc de ressource';
		$route = route('blog.admin.resource-block.store');
		$method = 'POST';
	@endphp
@else
	@php
		$title = "Editer le bloc de ressource";
		$route = route('blog.admin.resource-block.update');
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
						@empty($block->id)
							Nouveau bloc
						@else
							{{ $block->title }}
						@endif
						</h5>
					</div>
					<div class="card-body">
						<form action="{{ $route }}" method="post">
							@if(session('success_store'))
								<div class="alert alert-success">
									Le bloc a bien été créé
								</div>
							@elseif (session('success_edit'))
								<div class="alert alert-success">
									La bloc a bien été édité
								</div>
							@endif

							@csrf

							@method($method)
							
							@if($block->created_at)
								
							<div class="form-row mb-4">
								<div class="col-lg">
									<i class="fa fa-clock" aria-hidden="true"></i> Créé le :
									<span id="page-created-at"><?php // {{ $block->getFormattedDateToText($block->created_at) }} ?></span>
								</div>
								
								<div class="col-lg">
									@if($block->updated_at)?>
										<i class="fa fa-clock" aria-hidden="true"></i> Mis à jour le :
										<span id="page-updated-at"><?php //{{ $block->getFormattedDateToText($block->updated_at) }} ?></span>
									 @endif
								</div>
							</div>
							
							@endif

							<div class="form-row mb-4">
								<div class="block-enclosing col-lg">
									<label for="published"><i class="fa fa-eye"></i> Afficher le bloc</label>
									<select id="published" name="published" class="form-control">
										<option value="1">Oui</option>
										<option value="0">Non</option>
									</select>
								</div>
							</div>

							<div class="block-enclosing mb-4">
								<div>
									<label for="title" class="pointer">Titre</label>
								</div>

								<div>
									<input type="text" id="title" name="title" class="form-control" value="{!! $block->title !!}" style="width: 100%">
								</div>
							</div>

							<div class="block-enclosing mb-4">
								<div>
									<label for="description" class="pointer">Description</label>
								</div>

								<div>
									<textarea id="description" name="description" class="form-control" style="width: 100%; min-height: 150px">{!! $block->description !!}</textarea>
								</div>
							</div>

							<div class="block-enclosing mb-4">
								<p><strong>Liens associés à ce bloc</strong></p>
								
								<div class="manage-block-link">
									<div class="form-row mb-2">
										<div class="col-md-2">
											<button type="button" class="btn btn-secondary up" data-action="up" disabled><i class="fa fa-chevron-up"></i></button>
											<button type="button" class="btn btn-secondary down" data-action="down" disabled><i class="fa fa-chevron-down"></i></button>
										</div>
										<div class="col-md-8">
											<input type="text" name="links[]" class="form-control">
										</div>
										<div class="col-md-2 text-right">
											<button type="button" class="btn btn-secondary delete" data-action="delete" disabled><i class="fa fa-trash-alt"></i></button>
											<button type="button" class="btn btn-secondary add" data-action="add"><i class="fa fa-plus-circle"></i></button>
										</div>
									</div>
								</div>
							</div>

							<div class="block-enclosing mb-4">
								<div>
									<label for="all-links" class="pointer">Copiez-collez tous les liens à ajouter à ce bloc</label>
								</div>
								<div>
									<textarea id="all-links" name="allLinks" class="form-control" style="width: 100%; min-height:150px"></textarea>
								</div>
							</div>

							<div class="mt-5 mb-4">
								<div class="float-right">
									<input type="submit" class="btn btn-primary" value="Valider">
									@isset($block->id)
									<input type="hidden" name="id" value="{{ $block->id }}">
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
		
		@push('scripts')
		<script>
		function blockMoveLink($item, direction) {
			const $containerItem = $item.closest('.form-row');
			const $containerItemPrev = $containerItem.prev();
			const $containerItemNext = $containerItem.next();

			if(direction === 'up') {
				// L'element qui precede celui qui va etre deplace, est-il le premier de la liste
				if($containerItemPrev.prev().length === 0) {
					// L'element qui va etre deplace devient le premier de la liste
					$containerItem.find('.up').prop('disabled', true);
					// Le premier element prend la place de l'element qui va etre deplace
					$containerItemPrev.find('.up').prop('disabled', false);
				}

				// L'element qui va etre deplace est-il le dernier de la liste
				if($containerItemNext.length === 0) {
					$containerItem.find('.down').prop('disabled', false);
					$containerItemPrev.find('.up').prop('disabled', false);
					$containerItemPrev.find('.down').prop('disabled', true);
				}

				$containerItem.insertBefore($containerItemPrev);
			} else if(direction === 'down') {
				if($containerItemNext.next().length === 0) {
					$containerItem.find('.down').prop('disabled', true);
					$containerItemNext.find('.down').prop('disabled', false);
				}

				if($containerItemPrev.length === 0) {
					$containerItem.find('.up').prop('disabled', false);
					$containerItemNext.find('.up').prop('disabled', true);
					$containerItemNext.find('.down').prop('disabled', false);
				}

				$containerItem.insertAfter($containerItemNext);
			}
		}

		function blockRemoveLink($item) {
			const $containerMain = $item.closest('.manage-block-link');
			const $containerItem = $item.closest('.form-row');
			const $containerItemPrev = $containerItem.prev();
			const $containerItemNext = $containerItem.next();

			// L'element qui va etre supprime a un element avant lui mais pas apres
			if($containerItemPrev.length === 1 && $containerItemNext.length === 0) {
				// L'element d'avant deviendra le dernier de la liste, l'action pour le deplacer vers le bas est desactivee
				$containerItemPrev.find('.down').prop('disabled', true);

				// L'element qui se trouve avant celui qui va etre supprime, n'a aucun element avant lui ni apres
				if($containerItemPrev.prev().length === 0) {
					// Ce sera le dernier element restant dans la liste, celui-ci ne pourra pas etre supprime
					$containerItemPrev.find('.delete').prop('disabled', true);
				}
			// L'element qui va etre supprime a un element apres lui mais pas avant
			} else if($containerItemPrev.length === 0 && $containerItemNext.length === 1) {
				// L'element d'apres deviendra le premier de la liste, l'action pour le deplacer vers le haut est desactivee
				$containerItemNext.find('.up').prop('disabled', true);

				// L'element qui se trouve apres celui qui va etre supprime, n'a aucun element apres lui ni avant
				if($containerItemNext.next().length === 0) {
					// Ce dernier le dernier element restant dans la liste, celui-ci ne pourra pas etre supprime
					$containerItemNext.find('.delete').prop('disabled', true);
				}
			}

			$containerItem.remove();
		}

		function blockAddLink($item) {
			const $containerMain = $item.closest('.manage-block-link');
			const $containerItem = $item.closest('.form-row');
			const $containerClone = $containerItem.clone();

			$containerItem.find('.down').prop('disabled', false);
			$containerItem.find('.delete').prop('disabled', false);
			$containerClone.find('input[type="text"]').val('');

			if($containerItem.next().length === 0) {
				$containerClone.find('.up').prop('disabled', false);
				$containerClone.find('.down').prop('disabled', true);
				$containerClone.find('.delete').prop('disabled', false);
			} else {
				$containerClone.find('.up').prop('disabled', false);
				$containerClone.find('.down').prop('disabled', false);
			}
			
			$containerItem.after($containerClone);
		}

		const $manageBlockLinks = $('.manage-block-link');

		$manageBlockLinks.on('click', 'button', (event) => {
			const $self = $(event.currentTarget);

			switch(event.currentTarget.dataset.action) {
				case 'up':
					blockMoveLink($self, 'up');
					break;
				case 'down':
					blockMoveLink($self, 'down');
					break;
				case 'delete':
					blockRemoveLink($self);
					break;
				case 'add':
					blockAddLink($self);
					break;
			}
			console.log(event.currentTarget.dataset)
			
		});
		
		$manageBlockLinks.find('input[type="text"]').val('');
		$manageBlockLinks.find('.up, .down, .delete').prop('disabled', true);
		</script>
		@endpush

@endsection