@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@if(isset($whs))
	<?php
			$sRoute = 'wms.whs.update';
			$aux = $whs;
	?>
	@section('title', trans('userinterface.titles.EDIT_WAREHOUSE'))
@else
	<?php
		$sRoute='wms.whs.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_WAREHOUSE'))
@endif
	<?php $sRoute2 = 'wms.whs.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('code', trans('userinterface.labels.CODE').'*') !!}
			{!! Form::text('code',
				isset($whs) ? $whs->code : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.CODE'), 'required', 'unique']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.WAREHOUSE').'*') !!}
			{!! Form::text('name',
				isset($whs) ? $whs->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.WAREHOUSE'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('branch_id', trans('userinterface.labels.BRANCH')) !!}
			{!! Form::select('branch_id', $branches, isset($whs) ?  $whs->branch_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.BRANCH'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('whs_type_id_opt', trans('userinterface.labels.TYPE')) !!}
			{!! Form::select('whs_type_id_opt', $types, isset($whs) ?  $whs->whs_type_id_opt : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.WHS_TYPE')]) !!}
		</div>

@endsection
