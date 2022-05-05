@extends('blog.admin.default')

@empty($category->id)
	@php
		$title = 'Créer une nouvelle catégorie';
		$method = 'POST';
	@endphp
@else
	@php
		$title = 'Editer la catégorie';
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
						@empty($category->id)
							Nouvelle catégorie
						@else
							{{ $category->title }}
						@endif
						</h5>
					</div>

					<div class="card-body">
						<form action="{{ $route }}" method="post" autocomplete="off">
							@if (session('success_store'))
								<div class="alert alert-success">
									La catégorie a bien été créée
								</div>
							@elseif (session('success_update'))
								<div class="alert alert-success">
									La catégorie a bien été éditée
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

							@method($method)

							@if($category->created_at)
								<div class="form-row mb-4">
									<div class="col-lg">
										<i class="fa fa-clock" aria-hidden="true"></i> Créée le : {{ $category->getFormattedDateToText($category->created_at) }}
									</div>
									
									<div class="col-lg">
										@if($category->updated_at)
											<i class="fa fa-clock" aria-hidden="true"></i> Mise à jour le : {{ $category->getFormattedDateToText($category->updated_at) }}
										@endif
									</div>
								</div>
							@endif

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
										<input type="text"
												id="title"
												name="title"
												class="form-control"
												value="{!! old('title', $category->title) !!}"
												style="width: 100%">
									</div>
								</div>

								<div class="block-enclosing mb-4">
									<div>
										<label for="slug" class="pointer">Slug</label>
									</div>

									<div class="form-inline">
										<input type="text" id="input-slug" name="slug" class="form-control" 
										value="{!! old('slug', $category->slug) !!}" style="width: 80%" {{  $category->id > 0 ? 'readonly' : '' }}>
									
										<button type="button" id="disabled-slug"
											@if($category->id > 0)
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
										<label for="description" class="pointer">
										@error('description')
										<span class="text-danger">{{ $message }}</span><br>
										@enderror
										Description
										</label>
									</div>
									<div @error('description') class="has-error" @enderror >
										<input type="text" id="description" name="description" class="form-control" value="{!! old('description', $category->description) !!}" style="width: 100%">
									</div>
								</div>

								<div class="mb-4">
									<div class="float-right">
										<input type="submit" class="btn btn-primary" value="Valider">
										@isset($category->id)
										<input type="hidden" name="id" value="{{ $category->id }}">
										@endisset
									</div>
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
			}
		}

		function addFormErrorAfterValidation(form, response) {
			const errors = response.responseJSON.errors;

			form.find('input, textarea, select').removeClass('border-danger');
			form.find('.text-danger').remove();

			['title', 'description'].forEach(function(fieldName, index) {
				if(errors[fieldName]) {
					form.find('[name="'+fieldName+'"]').addClass('border-danger');
					form.find('label[for="'+fieldName+'"]').after(`<div class="text-danger">${errors[fieldName]}</div>`);
				}
			});

			if(errors.slug) {
				form.find('[name="input-slug"]').addClass('border-danger');
				form.find('label[for="slug"]').after(`<div class="text-danger">${errors.slug}</div>`);
			}
		}
		</script>

@endsection