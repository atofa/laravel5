@extends('template')

@section('header')
	@if(Auth::check())
		<div class="btn-group pull-right">
			{!! link_to_route('post.create', 'Creer un article',[], ['class' => 'btn btn-info']) !!}
			{!! link_to('auth/logout', 'Deconnexion', ['class' => 'btn btn-warning']) !!}
			
		</div>
	@else
		{!! link_to('auth/login', 'Se connecter', ['class' => 'btn btn-info pull-right']) !!}
	@endif
@stop

@section('contenu')
    @if(isset($info))
		<div class="row alert alert-info">{{ $info }}</div>
	@endif
	{!! $links !!}
	@foreach($posts as $post)
		<article class="row bg-primary">
			<div class="col-md-12">
				<header>
					<h1>{{ $post->titre }}</h1>
				</header>
				<hr>
				<section>
					<p>{{ $post->contenu }}</p>
					@if(Auth::check() and Auth::user()->admin)
						{!! Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $post->id]]) !!}
							{!! Form::submit('Supprimer cet article', ['class' => 'btn btn-danger btn-xs ', 'onclick' => 'return confirm(\'Vraiment supprimer cet article ?\')']) !!}
						{!! Form::close() !!}
					@endif
					<em class="pull-right">
						<span class="glyphicon glyphicon-pencil"></span> {{ $post->user->name }} le {!! $post->created_at->format('d-m-Y') !!}
					</em>
				</section>
			</div>
		</article>
		<br>
	@endforeach
	{!! $links !!}
@stop