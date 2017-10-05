@extends('templates.list.mainlist')
@section('menu')
	@include('templates.menu.menumodules')
@endsection

@section('title', trans('userinterface.titles.LIST_YEARS'))

@section('content')
	<?php $sRoute="siie.years"?>
	@section('create')
		@include('templates.form.create')
	@endsection
	<table data-toggle="table" class="table table-striped">
		<thead>
			<th>{{ trans('userinterface.labels.YEAR') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.STATUS') }}</th>
			<th>{{ trans('userinterface.labels.ACTION') }}</th>
			<th>{{ trans('userinterface.labels.CREATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.CREATED') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED_BY') }}</th>
			<th>{{ trans('userinterface.labels.UPDATED') }}</th>
		</thead>
		<tbody>
			@foreach($years as $year)
				<tr>
					<td>{{ $year->id_year }}</td>
					<td>
						@if (!$year->is_closed)
								<span class="label label-success">{{ trans('userinterface.labels.OPENED') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.CLOSED') }}</span>
						@endif
					</td>
					<td>
						@if (!$year->is_deleted)
								<span class="label label-success">{{ trans('userinterface.labels.ACTIVE') }}</span>
						@else
								<span class="label label-danger">{{ trans('userinterface.labels.INACTIVE') }}</span>
						@endif
					</td>
					<td>
						<?php
								$oRegistry = $year;
								$sRoute = 'siie.years';
								$iRegistryId = $year->id_year;
						?>
						<a href="{{ route('siie.months.index', $year->id_year) }}" class="btn btn-default">
							<span class="glyphicon glyphicon-folder-open" aria-hidden = "true"/>
						</a>
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
	{!! $years->render() !!}
@endsection
