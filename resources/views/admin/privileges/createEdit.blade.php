@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menu')
@endsection

@if(isset($privilege))
	<?php
			$sRoute='admin.privileges.update';
			$aux=$privilege;
	?>
	@section('title', trans('userinterface.titles.EDIT_PRIVILEGE'))
@else
	<?php
		$sRoute='admin.privileges.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_PRIVILEGE'))
@endif
	<?php $sRoute2='admin.privileges.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name',isset($privilege) ? $privilege->name : null ,['class'=>'form-control', 'placeholder' => 'Nombre del privilegio', 'required']) !!}
		</div>

@endsection
