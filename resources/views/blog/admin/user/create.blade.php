@extends('blog.admin.default')

@empty($user->id)
	@php
		$title = 'Créer un nouvel utilisateur';
		$method = 'POST';
	@endphp
@else
	@php
		$title = "Editer l'utilisateur";
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
						@empty($user->id)
							Nouvel utilisateur
						@else
							{{ $user->name }}
						@endif
						</h5>
					</div>

					<div class="card-body">
						<form action="{{ $route }}" method="post" autocomplete="off">
							@csrf
							@method($method)

							@if($user AND $user->created_at)
								<div class="form-row mb-4">
									<div class="col-lg">
										<i class="fa fa-clock" aria-hidden="true"></i> Créée le : {{ $user->created_at }}
									</div>
									
									<div class="col-lg">
										@if($user->updated_at)
											<i class="fa fa-clock" aria-hidden="true"></i> Mise à jour le : {{ $user->updated_at }}
										@endif
									</div>
								</div>
							@endif

								<div class="block-enclosing mb-4">
									<div>
										<label for="name" class="pointer">
										Identifiant
										</label>
									</div>

									<div>
										<input type="text"
												id="name"
												name="name"
												class="form-control"
												value="{!! old('name', $user->name) !!}"
												style="width: 100%">
									</div>
								</div>

								<div class="block-enclosing mb-4">
									<div>
										<label for="email" class="pointer">Email</label>
									</div>

									<div class="form-inline">
										<input type="text" id="email" name="email" class="form-control" 
										value="{!! old('email', $user->email) !!}" style="width: 100%">
									</div>
								</div>

								<div class="block-enclosing mb-4">
									<div>
										<label for="password" class="pointer">Mot de passe</label>
									</div>

									<div class="form-inline">
										<input type="password" id="password_confirm" name="password" class="form-control" style="width: 100%">
									</div>
								</div>

								<div class="block-enclosing mb-4">
									<div>
										<label for="password" class="pointer">Confirmer le mot de passe</label>
									</div>

									<div class="form-inline">
										<input type="password" id="password_confirm" name="password" class="form-control" style="width: 100%">
									</div>
								</div>

								<div class="blog-enclosing mb-4">
									<div>
										<label for="role">Role</label>
									</div>

									<div>
										<select id="role" name=role">
											<option value="0">Choisir un role</option>
										@foreach($roles as $role)
											<option value="{{ $role->id }}"{{ $user->role->id === $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
										@endforeach
										</select>
									</div>
								</div>

								<div class="mb-4">
									<div class="float-right">
										<input type="submit" class="btn btn-primary" value="Valider">
										@isset($user->id)
										<input type="hidden" name="id" value="{{ $user->id }}">
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

			['name', 'email'].forEach(function(fieldName, index) {
				if(errors[fieldName]) {
					form.find('[name="'+fieldName+'"]').addClass('border-danger');
					form.find('label[for="'+fieldName+'"]').after(`<div class="text-danger">${errors[fieldName]}</div>`);
				}
			});
		}
		</script>

@endsection