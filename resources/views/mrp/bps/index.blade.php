@extends('front.mainListado')

@section('menu')
	@include('front.templates.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_BPS'))

@section('content')
	<?php $sRoute="mrp.bps"?>
	@section('create')
		@include('front.templates.create')
	@endsection
	<table data-toggle="table" class="table table-condensed">
		<thead>
			<th>{{ trans('userinterface.labels.BP') }}</th>
			<th>{{ trans('userinterface.labels.RFC') }}</th>
			<th>{{ trans('userinterface.labels.CURP') }}</th>
			<th>{{ trans('userinterface.labels.SIIE_ID') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
		</thead>
		<tbody>
			@foreach($bps as $bpartner)
				<tr>
					<td>{{ $bpartner->bp_name }}</td>
					<td>{{ $bpartner->id_fiscal }}</td>
					<td>{{ $bpartner->curp }}</td>
					<td>{{ $bpartner->siie_id }}</td>
					<td>
						@if (! $bpartner->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $bpartner;
								$sRoute = 'mrp.bps';
								$iRegistryId = $bpartner->id_bp;
						?>
						@include('front.listed.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $bps->render() !!}
@endsection
