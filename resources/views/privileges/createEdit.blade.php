@extends('front.mainCapturaEdicion')

@section('menu')
	@include('front.templates.menu')
@endsection

@if(isset($privilege))
	<?php
			$sRoute='privileges.update';
			$aux=$privilege;
	?>
	@section('title', trans('userinterface.titles.EDIT_PRIVILEGE'))
@else
	<?php
		$sRoute='privileges.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_PRIVILEGE'))
@endif
	<?php $sRoute2='privileges.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name',isset($privilege) ? $privilege->name : null ,['class'=>'form-control', 'placeholder' => 'Nombre del privilegio','required']) !!}
		</div>

@endsection
