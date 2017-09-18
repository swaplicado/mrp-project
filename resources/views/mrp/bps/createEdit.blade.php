@extends('front.mainCapturaEdicion')
@if(isset($bpartner))
	<?php
			$sRoute = 'mrp.bps.update';
			$aux = $bpartner;
	?>
	@section('title', trans('userinterface.titles.EDIT_BRANCH'))
@else
	<?php
		$sRoute='mrp.bps.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_BRANCH'))
@endif
	<?php $sRoute2 = 'mrp.bps.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('bp_name', trans('userinterface.labels.NAME')) !!}
			{!! Form::text('bp_name',
				isset($bpartner) ? $bpartner->bp_name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('last_name', trans('userinterface.labels.BRANCH')) !!}
			{!! Form::text('last_name',
				isset($bpartner) ? $bpartner->last_name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.BRANCH'), 'required']) !!}
		</div>

@endsection
