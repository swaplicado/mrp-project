@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menu')
@endsection

@if(isset($user))
	<?php
			$aux = $user;
			if (isset($bIsCopy))
			{
				$sRoute = 'admin.users.store';
			}
			else
			{
				$sRoute = 'admin.users.update';
			}
	?>
	@section('title', trans('userinterface.titles.EDIT_USER'))
@else
	<?php
		$sRoute = 'admin.users.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_USER'))
@endif
	<?php $sRoute2='admin.users.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('username', trans('userinterface.labels.NAME').'*') !!}
			{!! Form::text('username',
				isset($user) ? $user->username : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', trans('userinterface.labels.EMAIL').'*') !!}
			{!! Form::email('email',isset($user) ? $user->email : null ,['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.EMAIL'), 'required']) !!}
		</div>

		@if(!isset($user) || (isset($user) && isset($bIsCopy)))
			<div class="form-group">
				{!! Form::label('password', trans('userinterface.labels.PASSWORD').'*') !!}
				{!! Form::password('password', ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.PASSWORD'), 'required']) !!}
			</div>
		@endif

		<div class="form-group">
			{!! Form::label('user_type_id', trans('userinterface.labels.TYPE').'*') !!}
			{!! Form::select('user_type_id', $types, isset($user) ? $user->user_type_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.SELECT_TYPE'), 'required']) !!}
		</div>


@endsection
