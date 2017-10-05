@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

<?php
    $sRoute='siie.companies.update';
    $aux=$company;
?>

@section('title', trans('userinterface.titles.EDIT_COMPANY'))
<?php $sRoute2='siie.companies.index' ?>

@section('content')


		<div class="form-group">
			{!! Form::label('name', trans('userinterface.labels.COMPANY').'*') !!}
			{!! Form::text('name',
				isset($company) ? $company->name : null , ['class'=>'form-control', 'placeholder' => trans('userinterface.placeholders.COMPANY'), 'required']) !!}
		</div>
    <br />



@endsection
