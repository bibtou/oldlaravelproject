@extends('blog.layouts.default')

@section('title', 'Accueil')

@section('content')

	@if($items->isEmpty())
	
		@include('blog.includes.part-no-article')

	@else
		
		@if(request()->route()->getName() == 'blog.category')
			<div class="post-content"><p class="entry-summary">{{ $category->description }}</p></div>
		@endif

		@foreach($items as $article)
		
			@include('blog.includes.part-article', ['article' => $article])

		@endforeach
		
		{{ $items->links() }}

	@endempty

@endsection