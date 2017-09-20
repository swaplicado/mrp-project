@extends('front.mainCapturaEdicion')

@section('menu')
	@include('front.templates.menumodules')
@endsection

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
			{!! Form::label('bp_name', trans('userinterface.labels.BP').'*') !!}
			{!! Form::text('bp_name',
				isset($bpartner) ? $bpartner->bp_name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.BP'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('last_name', trans('userinterface.labels.LAST_NAME')) !!}
			{!! Form::text('last_name',
				isset($bpartner) ? $bpartner->last_name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.LAST_NAME')]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('first_name', trans('userinterface.labels.NAME')) !!}
			{!! Form::text('first_name',
				isset($bpartner) ? $bpartner->first_name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.NAME')]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('id_fiscal', trans('userinterface.labels.RFC').'*') !!}
			{!! Form::text('id_fiscal',
				isset($bpartner) ? $bpartner->id_fiscal : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.RFC'), 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('curp', trans('userinterface.labels.CURP')) !!}
			{!! Form::text('curp',
				isset($bpartner) ? $bpartner->curp : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.CURP')]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('web', trans('userinterface.labels.WEB')) !!}
			{!! Form::text('web',
				isset($bpartner) ? $bpartner->web : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.WEB')]) !!}
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_company', trans('userinterface.labels.IS_COMP')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_company', 1, isset($bpartner) ? $bpartner->is_company : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_supplier', trans('userinterface.labels.IS_SUPP')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_supplier', 1, isset($bpartner) ? $bpartner->is_supplier : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_customer', trans('userinterface.labels.IS_CUST')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_customer', 1, isset($bpartner) ? $bpartner->is_customer : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_creditor', trans('userinterface.labels.IS_CRED')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_creditor', 1, isset($bpartner) ? $bpartner->is_creditor : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_debtor', trans('userinterface.labels.IS_DEBT')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_debtor', 1, isset($bpartner) ? $bpartner->is_debtor : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_bank', trans('userinterface.labels.IS_BANK')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_bank', 1, isset($bpartner) ? $bpartner->is_bank : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_employee', trans('userinterface.labels.IS_EMPL')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_employee', 1, isset($bpartner) ? $bpartner->is_employee : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_agt_sales', trans('userinterface.labels.IS_AGTS')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_agt_sales', 1, isset($bpartner) ? $bpartner->is_agt_sales : false) !!}
					</div>
				</div>
				<div class="col-md-1">
					<div class="row">
						{!! Form::label('is_partner', trans('userinterface.labels.IS_PART')) !!}
					</div>
					<div class="row">
						{!! Form::checkbox('is_partner', 1, isset($bpartner) ? $bpartner->is_partner : false) !!}
					</div>
				</div>
			</div>
		</div>

@endsection
