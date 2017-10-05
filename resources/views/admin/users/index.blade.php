@extends('templates.list.mainlist')

@section('menu')
	@include('templates.menu.menu')
@endsection

@section('title', trans('userinterface.titles.LIST_USERS'))

@section('content')
	<?php $sRoute='admin.users' ?>
	@section('create')
		@include('templates.form.create')
	@endsection
	<table data-toggle="table" class="table table-condensed">
		<thead>
			<th data-sortable="true">{{ trans('userinterface.labels.NAME') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.EMAIL') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
			<th>{{ trans('userinterface.labels.CREATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.CREATED') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED') }}</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@if (! $user->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $user;
								$iRegistryId = $user->id;
						?>
						@include('templates.list.options')
					</td>
					<td>
						@include('templates.list.createdUs')
					</td>
					<td>
						@include('templates.list.created')
					</td>
					<td>
						@include('templates.list.updatedUs')
					</td>
					<td>
						@include('templates.list.updated')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $users->render() !!}
@endsection
