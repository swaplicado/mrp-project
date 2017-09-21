@extends('front.mainListado')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_WAREHOUSES'))

@section('content')
	<?php $sRoute="wms.whs"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-condensed">
		<thead>
			<th>{{ trans('userinterface.labels.CODE') }}</th>
			<th>{{ trans('userinterface.labels.WAREHOUSE') }}</th>
			<th>{{ trans('userinterface.labels.TYPE') }}</th>
			<th>{{ trans('userinterface.labels.BRANCH') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($warehouses as $whs)
				<tr>
					<td>{{ $whs->code }}</td>
					<td>{{ $whs->name }}</td>
					<td>{{ $whs->whsType->name }}</td>
					<td>{{ $whs->branch->name }}</td>
					<td>
						@if (! $whs->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $whs;
								$iRegistryId = $whs->id_whs;
						?>
						@include('front.listed.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $warehouses->render() !!}
@endsection
