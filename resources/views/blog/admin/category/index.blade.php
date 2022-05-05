@extends('blog.admin.default')

@section('title', 'Gestion - Liste des catégories')

@section('content')

	<div class="card">

	@forelse($items as $item)
	
		@if($loop->first)
		
		<div class="card-body table-responsive p-0">

			@if(session()->has('success_category'))
				<div class="alert alert-success m-3">
					La catégorie <strong>{{ session()->get('success_category') }}</strong> a bien été supprimée.
				</div>
			@elseif(session()->has('failed_category'))
				<div class="alert alert-danger m-3">
					La catégorie souhaitée n'existe pas ou plus.
				</div>
			@elseif(session()->has('failed_category_has_articles'))
				<div class="alert alert-danger m-3">
					La catégorie <strong>{{ session()->get('failed_category_has_articles') }}</strong> ne peut pas être supprimée, un ou plusieurs articles y sont associés.
				</div>
			@endif

			<table class="table table-hover text-nowrap">
				<thead>
					<tr>
						<th>ID</th>
						<th>Article</th>
						<th>Titre</th>
						<th>Auteur</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
		
		@endif

			@php
				$total = $item->articles->count()
			@endphp

				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ $total }}</td>
					<td>
						<span data-toggle="tooltip" data-placement="top" title="{{ $item->description }}">{{ Str::limit($item->title, 25) }}</span>
					</td>					
					<td>{{ ucfirst($item->user->name) }}</td>
					<td>
						<form action="{{ route('blog.admin.category.destroy', ['category' => $item->id]) }}" method="post">
							@csrf()
							@method('DELETE')

							<button type="button"
								class="btn btn-danger btn--delete"
								data-modal-title-delete="Supprimer cette catégorie"
								data-modal-content-delete="{{ $item->title }}"
								data-toggle="tooltip"
								data-placement="top"
								title="{{ $total === 0 ? "Supprimer cette catégorie" : "Impossible de supprimer cette catégorie car il y a " . $total . " " . Str::plural("article", $total) . " " . Str::plural("associé", $total) . " à celle-ci" }}"
								{{ $total > 0 ? 'disabled' : '' }}
							>
								<i class="fa fa-trash" aria-hidden="true"></i>
							</button>
							<a href="{{ route('blog.admin.category.edit', ['category' => $item->id]) }}"
								class="btn btn-primary"
								data-toggle="tooltip"
								data-placement="top"
								title="Editer"	
							>
								<i class="fa fa-pen" aria-hidden="true"></i>
							</a>
						</form>
					</td>
				</tr>

		@if($loop->last)

				</tbody>
			</table>
		</div>

		@endif

	@empty
	
	@endif

	</div>

@endsection