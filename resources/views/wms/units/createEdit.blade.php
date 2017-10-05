@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@if(isset($unit))
	<?php
			if (isset($bIsCopy))
			{
				$sRoute = 'wms.units.store';
			}
			else
			{
				$sRoute = 'wms.units.update';
			}
			$aux = $unit;
	?>
	@section('title', trans('userinterface.titles.EDIT_UNIT'))
@else
	<?php
		$sRoute='wms.units.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_UNIT'))
@endif
	<?php $sRoute2 = 'wms.units.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('code', trans('userinterface.labels.SYMBOL').'*') !!}
			{!! Form::text('code',
				isset($unit) ? $unit->code : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.SYMBOL'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.UNIT').'*') !!}
			{!! Form::text('name',
				isset($unit) ? $unit->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.UNIT'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('unit_base_equivalence_opt', trans('userinterface.labels.EQUIVALENCE')) !!}
			{!! Form::text('unit_base_equivalence_opt',
				isset($unit) ? $unit->unit_base_equivalence_opt : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.EQUIVALENCE')]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('user_type_id', trans('userinterface.labels.UNIT_EQ')) !!}
			{!! Form::select('user_type_id', $unitseq, isset($unit) ?  $unit->unit_base_id_opt : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.UNIT_EQ')]) !!}
		</div>

@endsection
