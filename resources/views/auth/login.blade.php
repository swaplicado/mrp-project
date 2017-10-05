@extends('admin.admin')

@section('title', trans('userinterface.WELCOME_START'))

@section('content')
	{!! Form::open(['route' => 'auth.login', 'method' => 'POST']) !!}
		<div class="form-group">
			{!! Form::label('username', trans('userinterface.labels.USER_NAME')) !!}
			{!! Form::input('text', 'username', null, ['class' => 'form-control', 'placeholder' => trans('userinterface.labels.USER_NAME')]) !!}
		</div>
		<div class="form-group">
			{!! Form::label('password', trans('userinterface.labels.PASSWORD')) !!}
			{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********']) !!}
		</div>
		<div class="form-group" align="right">
			{!! Form::submit(trans('actions.ACCESS'), ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}

@endsection
