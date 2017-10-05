@extends('templates.list.mainlist')
@section('menu')
	@include('templates.menu.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_MONTHS'))

@section('content')
	<?php $sRoute="siie.months"?>
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.MONTH') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
			<th>{{ trans('userinterface.labels.CREATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.CREATED') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED') }}</th>
		</thead>
		<tbody>
			@foreach($months as $month)
				<tr>
					<td>{{ $month->id_month }}</td>
					<td>
						@if (!$month->is_closed)
								<span class="label label-success">{{ trans('userinterface.labels.OPENED') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.CLOSED') }}</span>
						@endif
					</td>
					<td>
						<a href="{{ route('siie.months.edit', $month->id_y_month) }}" data-toggle = "editar" title="{{ trans('userinterface.tooltips.EDIT') }}"
																												style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('scsys.OPERATION.EDIT'), $actualUserPermission, $month->created_by_id) }};"
																												class="btn btn-info">
							<span class="glyphicon glyphicon-pencil" aria-hidden = "true"/>
						</a>
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
	{!! $months->render() !!}
@endsection
