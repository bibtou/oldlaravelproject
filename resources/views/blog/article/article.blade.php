@extends('blog.layouts.default')

@section('title')
	{{ $article->title }})
@endsection

@section('content')

	@include('blog.includes.part-article', ['article' => $article])

@endsection