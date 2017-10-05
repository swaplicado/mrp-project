@extends('templates.list.mainlist')

@section('menu')
	@include('templates.menu.menu')
@endsection

@section('title', trans('userinterface.titles.LIST_PRIVILEGES'))

@section('content')
	<?php $sRoute='admin.privileges' ?>
	@section('create')
		@include('templates.form.create')
	@endsection
	<table class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.NAME') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($privileges as $privilege)
				<tr>
					<td>{{ $privilege->name }}</td>
					<td>
						@if (! $privilege->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $privilege;
								$iRegistryId = $privilege->id_privilege;
						?>
						@include('templates.list.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $privileges->render() !!}
@endsection
