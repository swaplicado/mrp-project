@extends('front.mainListado')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_UNITS'))

@section('content')
	<?php $sRoute="wms.units"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-condensed">
		<thead>
			<th>{{ trans('userinterface.labels.SYMBOL') }}</th>
			<th>{{ trans('userinterface.labels.UNIT') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($units as $unit)
				<tr>
					<td>{{ $unit->code }}</td>
					<td>{{ $unit->name }}</td>
					<td>
						@if (! $unit->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $unit;
								$iRegistryId = $unit->id_unit;
						?>
						@include('front.listed.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $units->render() !!}
@endsection
