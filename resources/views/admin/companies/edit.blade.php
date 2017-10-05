@extends('templates.newedit.mainnewedit')
<?php
    $sRoute='admin.companies.update';
    $aux=$company;
?>

@section('title', trans('userinterface.titles.EDIT_COMPANY'))
<?php $sRoute2='admin.companies.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.COMPANY')) !!}
			{!! Form::text('name',
				isset($company) ? $company->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.COMPANY'), 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('database_name', trans('userinterface.labels.DB_NAME')) !!}
			{!! Form::text('database_name',
				isset($company) ? $company->database_name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.DB_NAME'), 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('host', trans('userinterface.labels.DB_HOST')) !!}
			{!! Form::text('host',
				isset($company) ? $company->host : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.DB_HOST'), 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('port', trans('userinterface.labels.DB_PORT')) !!}
			{!! Form::number('port',
				isset($company) ? $company->port : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.DB_PORT'), 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('database_user', trans('userinterface.labels.DB_USER')) !!}
			{!! Form::text('database_user',
				isset($company) ? $company->database_user : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.DB_USER'), 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('password', trans('userinterface.labels.DB_PASS')) !!}
			{!! Form::text('password',
				isset($company) ? $company->password : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.DB_PASS'), 'required']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('default_schema', trans('userinterface.labels.DB_SCH')) !!}
			{!! Form::text('default_schema',
				isset($company) ? $company->default_schema : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.DB_SCH'), 'required']) !!}
		</div>
    <br />



@endsection
