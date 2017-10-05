@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@if(isset($group))
	<?php
			$aux = $group;
			if (isset($bIsCopy))
			{
				$sRoute = 'wms.groups.store';
			}
			else
			{
				$sRoute = 'wms.groups.update';
			}
	?>
	@section('title', trans('userinterface.titles.EDIT_FAMILY'))
@else
	<?php
		$sRoute='wms.groups.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_FAMILY'))
@endif
	<?php $sRoute2 = 'wms.groups.index' ?>

@section('content')

		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.GROUP').'*') !!}
			{!! Form::text('name',
				isset($group) ? $group->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.GROUP'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('family_id', trans('userinterface.labels.FAMILY')) !!}
			{!! Form::select('family_id', $families, isset($group) ?  $group->family_id : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.FAMILY'), 'required']) !!}
		</div>

@endsection
