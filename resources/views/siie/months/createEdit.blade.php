@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@if(isset($month))
	<?php
			$sRoute = 'siie.months.update';
			$aux = $month;
	?>
	@section('title', trans('userinterface.titles.EDIT_YEAR'))
@else
	<?php
		$sRoute='siie.months.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_YEAR'))
@endif
	<?php $sRoute2 = 'siie.months.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('id_month', trans('userinterface.labels.MONTH').'*') !!}
			{!! Form::number('id_month',
				isset($month) ? $month->id_month : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.MONTH'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('is_closed', trans('userinterface.labels.CLOSED')) !!}
			{!! Form::checkbox('is_closed', 1, isset($month) ? $month->is_closed : false) !!}
		</div>

@endsection
