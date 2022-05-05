@extends('blog.admin.default')

@section('title', 'Gestion - Liste des articles')

@section('content')

	<div class="card">

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
						<th>Catégorie</th>
						<th>Titre</th>
						<th>Création</th>
						<th>Affichage</th>
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