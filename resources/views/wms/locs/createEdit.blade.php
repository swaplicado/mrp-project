@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@if(isset($location))
	<?php
			if (isset($bIsCopy))
			{
				$sRoute = 'wms.locs.store';
			}
			else
			{
				$sRoute = 'wms.locs.update';
			}
			$aux = $location;
	?>
	@section('title', trans('userinterface.titles.EDIT_LOCATION'))
@else
	<?php
		$sRoute='wms.locs.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_LOCATION'))
@endif
	<?php $sRoute2 = 'wms.locs.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('code', trans('userinterface.labels.CODE').'*') !!}
			{!! Form::text('code',
				isset($location) ? $location->code : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.CODE'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.LOCATION').'*') !!}
			{!! Form::text('name',
				isset($location) ? $location->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.LOCATION'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('whs_id', trans('userinterface.labels.WAREHOUSE')) !!}
			{!! Form::select('whs_id', $warehouses, isset($location) ?  $location->whs_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.WAREHOUSE'), 'required']) !!}
		</div>

@endsection
