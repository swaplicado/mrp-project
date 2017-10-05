@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@if(isset($year))
	<?php
			if (isset($bIsCopy))
			{
				$sRoute = 'siie.years.store';
			}
			else
			{
				$sRoute = 'siie.years.update';
			}
			$aux = $year;
	?>
	@section('title', trans('userinterface.titles.EDIT_YEAR'))
@else
	<?php
		$sRoute='siie.years.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_YEAR'))
@endif
	<?php $sRoute2 = 'siie.years.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('id_year', trans('userinterface.labels.YEAR').'*') !!}
			{!! Form::number('id_year',
				isset($year) ? $year->id_year : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.YEAR'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('is_closed', trans('userinterface.labels.CLOSED')) !!}
			{!! Form::checkbox('is_closed', 1, isset($year) ? $year->is_closed : false) !!}
		</div>

@endsection
