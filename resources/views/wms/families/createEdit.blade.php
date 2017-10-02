@extends('front.mainCapturaEdicion')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@if(isset($family))
	<?php
			$aux = $family;
			if (isset($bIsCopy))
			{
				$sRoute = 'wms.families.store';
			}
			else
			{
				$sRoute = 'wms.families.update';
			}
	?>
	@section('title', trans('userinterface.titles.EDIT_FAMILY'))
@else
	<?php
		$sRoute='wms.families.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_FAMILY'))
@endif
	<?php $sRoute2 = 'wms.families.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.FAMILY').'*') !!}
			{!! Form::text('name',
				isset($family) ? $family->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.FAMILY'), 'required']) !!}
		</div>

@endsection
