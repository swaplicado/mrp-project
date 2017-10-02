@extends('front.mainListado')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_FAMILIES'))

@section('content')
	<?php $sRoute="wms.families"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-condensed">
		<thead>
			<th>{{ trans('userinterface.labels.FAMILY') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($families as $family)
				<tr>
					<td>{{ $family->name }}</td>
					<td>
						@if (! $family->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $family;
								$iRegistryId = $family->id_family;
						?>
						@include('front.listed.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $families->render() !!}
@endsection
