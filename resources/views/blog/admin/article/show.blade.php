@extends('blog.layouts.default')

@section('title')
	Gestion - voir - {{ $article->title }})
@endsection

@section('content-admin')

	@include('blog.includes.part-article', ['article' => $article])

@endsection