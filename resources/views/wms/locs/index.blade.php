@extends('templates.list.mainlist')

@section('menu')
	@include('templates.menu.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_LOCATIONS'))

@section('content')
	<?php $sRoute="wms.locs"?>
	@section('create')
		@include('templates.form.create')
	@endsection
	<table data-toggle="table" class="table table-condensed">
		<thead>
			<th>{{ trans('userinterface.labels.CODE') }}</th>
			<th>{{ trans('userinterface.labels.LOCATION') }}</th>
			<th>{{ trans('userinterface.labels.WAREHOUSE') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($locations as $location)
				<tr>
					<td>{{ $location->code }}</td>
					<td>{{ $location->name }}</td>
					<td>{{ $location->warehouse->name }}</td>
					<td>
						@if (! $location->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $location;
								$iRegistryId = $location->id_location;
						?>
						@include('templates.list.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $locations->render() !!}
@endsection
