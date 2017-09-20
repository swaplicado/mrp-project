@extends('front.mainCapturaEdicion')

@section('menu')
	@include('front.templates.menu')
@endsection

@if(isset($permission))
	<?php
			$sRoute='permissions.update';
			$aux=$permission;
	?>
	@section('title', trans('userinterface.titles.EDIT_PERMISSION'))
@else
	<?php
		$sRoute='permissions.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_PERMISSION'))
@endif
	<?php $sRoute2='permissions.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('code_mrp', trans('userinterface.labels.CODE')) !!}
			{!! Form::text('code_mrp',isset($permission) ? $permission->code_mrp : null ,['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.CODE'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('name','Name') !!}
			{!! Form::text('name',isset($permission) ? $permission->name : null ,['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('permission_type_id', trans('userinterface.labels.TYPE')) !!}
			{!! Form::select('permission_type_id', $types, isset($permission) ? $permission->permission_type_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.SELECT_TYPE'), 'required']) !!}
		</div>

@endsection
