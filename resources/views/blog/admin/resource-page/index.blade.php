@extends('blog.admin.default')

<?php /*
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
*/?>

@section('title', 'Gestion - Liste des pages')

@section('content')

	@forelse($items as $item)
	
		@if($loop->first)

		<div class="card-header">
			{{ $items->links('blog.includes.part-simple-admin-pagination') }}
		</div>
		
		<div class="card-body table-responsive p-0">
		
			@if (session()->has('success_article'))
				<div class="alert alert-success m-3">
					L'article <strong>{{ session()->get('success_article') }}</strong> a bien été supprimé.
				</div>
			@elseif (session()->has('failed_article'))
				<div class="alert alert-danger m-3">
					L'article souhaité n'existe pas ou plus...
				</div>
			@endif

			<table class="table table-hover text-nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>Affiché</th>
						<th>Domaine</th>
						<th>Titre</th>
						<th>Auteur</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

		@endif

		@if($item->published == 0)
			@php
				$type = 'danger';
				$label = 'Non';
			@endphp
		@elseif($item->private == 1)
			@php
				$type = 'warning';
				$label = 'Privé';
			@endphp
		@else
			@php
				$type = 'success';
				$label = 'Public';
			@endphp
		@endif



					<tr>
						<td class="align-middle">{{ $item->id }}</td>
						<td class="align-middle"><span class="badge badge-{{ $type }}">{{ $label }}</span></td>
						<td class="align-middle">{{ $item->link->domain->domain }}</td>
						<td class="align-middle">
							<span data-toggle="tooltip" data-placement="top" title="{{ $item->title }}">{{ Str::limit($item->title, 25) }}</span>
						</td>
						<td class="align-middle">{{ ucfirst($item->user->name) }}</td>
						<td>
							<form action="{{ route('blog.admin.resource-page.destroy', ['page' => $item->id]) }}" method="post">
								@csrf()
								@method('DELETE')

	<!-- onclick="event.preventDefault(); this.closest('form').submit();" -->
								<a href="{{ route('blog.admin.resource-page.show', ['page' => $item->id]) }}"
									class="btn btn-secondary"
									data-toggle="tooltip"
									data-placement="top"
									title="Editer">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</a>
								<button
									type="button"
									class="btn btn-danger btn--delete"
									data-modal-title-delete="Supprimer cette page"
									data-modal-content-delete="{{ $item->title }}"
									data-toggle="tooltip"
									data-placement="top"
									title="Supprimer">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</button>
								<a href="{{ route('blog.admin.resource-page.edit', ['page' => $item->id]) }}"
									class="btn btn-primary"
									data-toggle="tooltip"
									data-placement="top"
									title="Editer">
									<i class="fa fa-pen" aria-hidden="true"></i>
								</a>							
							</form>
						</td>
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
	pas de page
	@endif

@endsection