@extends('templates.newedit.mainnewedit')

@section('menu')
	@include('templates.menu.menu')
@endsection

@if(isset($assignament))
	<?php
		$sRoute='admin.userPermissions.update';
		$aux=$assignament;
	?>
	@section('title', trans('userinterface.titles.EDIT_ASSIGNAMENT'))
@else
	<?php
		$sRoute='admin.userPermissions.store';
	?>
	@section('title', trans('userinterface.titles.CREATE_ASSIGNAMENT'))
@endif
	<?php $sRoute2='admin.userPermissions.index' ?>

@section('content')

	@if(! isset($assignament))
    <div class="form-group">
      {!! Form::label('user_id', trans('userinterface.labels.USER')) !!}
      {!! Form::select('user_id', $users, isset($assignament) ? $assignament->user : null , ['class' => 'form-control select-user', 'placeholder' => trans('userinterface.placeholders.SELECT_USER'), 'required']) !!}
    </div>

    <div class="form-group">
			{!! Form::label('permission_id', trans('userinterface.labels.PERMISSION')) !!}
			{!! Form::select('permission_id', $permissions, isset($assignament) ? $assignament->permission->name : null , ['class' => 'form-control select-permission', 'placeholder' => trans('userinterface.placeholders.SELECT_PERMISSION'), 'required']) !!}
		</div>
	@endif

    <div class="form-group">
			{!! Form::label('privilege_id', trans('userinterface.labels.PRIVILEGE')) !!}
			{!! Form::select('privilege_id', $privileges, isset($assignament) ? $assignament->privilege->id : null , ['class' => 'form-control select-privilege', 'placeholder' => trans('userinterface.placeholders.SELECT_PRIVILEGE'), 'required']) !!}
		</div>

@endsection

@section('js')
	<script type="text/javascript">
		$('.select-user').chosen({
			placeholder_select_single: 'Seleccione un usuario...'
		});
		$('.select-permission').chosen({
			placeholder_select_single: 'Seleccione un permiso...'
		});
		$('.select-privilege').chosen({
			placeholder_select_single: 'Seleccione un privilegio...'
		});
	</script>

@endsection
