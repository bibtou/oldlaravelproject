@extends('blog.admin.default')

@section('title', 'Gestion - Liste des utilisateurs')

@section('content')

	<div class="card">

	@forelse($items as $item)
	
		@if($loop->first)

		<div class="card-header">
			{{ $items->links('blog.includes.part-simple-admin-pagination') }}
		</div>
		
		<div class="card-body table-responsive p-0">
		
			@if(session()->has('success_user'))
				<div class="alert alert-success m-3">
					L'utilisateur <strong>{{ session()->get('success_user') }}</strong> a bien été supprimé.
				</div>
			@elseif(session()->has('failed_user'))
				<div class="alert alert-danger m-3">
					L'utilisateur souhaité n'existe pas ou plus.
				</div>
			@elseif(session()->has('failed_user_has_articles'))
				<div class="alert alert-danger m-3">
					L'utilisateur <strong>{{ session()->get('failed_user_has_articles') }}</strong> ne peut pas être supprimé, un ou plusieurs articles y sont associés.
				</div>
			@elseif(session()->has('failed_user_has_categories'))
				<div class="alert alert-danger m-3">
					L'utilisateur <strong>{{ session()->get('failed_user_has_categories') }}</strong> ne peut pas être supprimé, une ou plusieurs catégories y sont associées.
				</div>
			@endif

			<table class="table table-hover text-nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>Role</th>
						<th>Identifiant</th>
						<th>Inscrit</th>
						<th>Vérifié</tH>
						<th>Articles</th>
						<th>Catégories</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

		@endif

		@php
			$type = 'success';
			$isVerified = ($item->email_verified_at !== NULL);
			$userTotalCategories = $item->categories->count();
			$userTotalArticles = $item->articles->count();
			$canBeDeleted = $userTotalCategories + $userTotalArticles === 0;
		@endphp

				<tr>
					<td class="align-middle">{{ $item->id }}</td>
					<td class="align-middle"><span class="badge badge-{{ $type }}">{{ $item->role->name }}</span></td>
					<td class="align-middle">{{ $item->name }}</td>
					<td class="align-middle">{{ $item->created_at_formatted }}</td>
					<td class="align-middle"><span class="badge badge-{{ $isVerified ? 'success' : 'danger' }}">{{ $isVerified === TRUE ? 'Oui' : 'Non' }}</span></td>
					<td class="align-middle">{{ $userTotalArticles }}</td>
					<td class="align-middle">{{ $userTotalCategories }}</td>
					<td class="align-middle">
						<form action="{{ route('blog.admin.user.destroy', ['user' => $item->id]) }}" method="post">
							@csrf()
							@method('DELETE')
							
							<button
								type="button"
								class="btn btn-danger btn--delete"
								data-modal-title-delete="Supprimer cet utilisateur"
								data-modal-content-delete="{{ $item->name }}"
								data-toggle="tooltip"
								data-placement="top"
								title="{{ $canBeDeleted === TRUE ? 'Supprimer' : '' }}"
								{{ $canBeDeleted !== TRUE ? "disabled" : "Impossible de supprimer cet utilisateur car plusieurs articles et / ou catégories y sont associés." }}>
								<i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							<a href="{{ route('blog.admin.user.edit', ['user' => $item->id]) }}"
								class="btn btn-primary"
								data-toggle="tooltip"
								data-placement="top"
								title="Editer">
								<i class="fa fa-pen" aria-hidden="true"></i>
							</a>
						</form>
					</td>
					<?php /*
					<td class="align-middle"><span data-toggle="tooltip"
							data-placement="top"
							title="{{ $item->category->description }}">
							{{ $item->category->title }}
						</span>
					</td>
					<td class="align-middle">
						<span data-toggle="tooltip" data-placement="top" title="{{ $item->title }}">{{ Str::limit($item->title, 25) }}</span>
					</td>
					
					<td class="align-middle">{{ $item->created_at_formatted }}</td>
					<td class="align-middle">{{ $item->displayed_at_formatted }}</td>
					<td class="align-middle">{{ ucfirst($item->user->name) }}</td>
					<td class="align-middle">
						<form action="{{ route('blog.admin.article.destroy', ['article' => $item->id]) }}" method="post">
							@csrf()
							@method('DELETE')

<!-- onclick="event.preventDefault(); this.closest('form').submit();" -->
							<button
								type="button"
								class="btn btn-danger btn--delete"
								data-modal-title-delete="Supprimer cet article"
								data-modal-content-delete="{{ $item->title }}"
								data-toggle="tooltip"
								data-placement="top"
								title="Supprimer">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							<a href="{{ route('blog.admin.article.edit', ['article' => $item->id]) }}"
								class="btn btn-primary"
								data-toggle="tooltip"
								data-placement="top"
								title="Editer">
								<i class="fa fa-pen" aria-hidden="true"></i>
							</a>							
						</form>
					</td>
					*/ ?>
				</tr>

		@if($loop->last)

				</tbody>
			</table>
		</div>

		<div class="card-footer">
			{{ $items->links('blog.includes.part-simple-admin-pagination') }}
		</div>

		@endif

	@empty

pas d'article :/

	@endif

	</div>

@endsection