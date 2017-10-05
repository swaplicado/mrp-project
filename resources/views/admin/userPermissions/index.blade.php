@extends('templates.list.mainlist')

@section('menu')
	@include('templates.menu.menu')
@endsection

@section('title', trans('userinterface.titles.LIST_ASSIGNAMENTS'))

@section('content')
	<?php $sRoute='admin.userPermissions' ?>
	@section('create')
		@include('templates.form.create')
	@endsection
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th data-sortable="true">{{ trans('userinterface.labels.USER') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.PERMISSION') }}</th>
      <th data-sortable="true">{{ trans('userinterface.labels.PRIVILEGE') }}</th>
      <th>Acciones</th>
		</thead>
		<tbody>
			@foreach($userPermissions as $userPermission)
				<tr>
					<td>{{ $userPermission->user->username }}</td>
					<td>{{ $userPermission->permission->name }}</td>
					<td>{{ $userPermission->privilege->name }}</td>
					<td>
						<?php
								$oRegistry = $userPermission;
								$iRegistryId = $userPermission->id_usr_per;
						?>
						@include('templates.list.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $userPermissions->render() !!}
@endsection
