@extends('templates.list.mainlist')

@section('menu')
	@include('templates.menu.menumodules')
@endsection
@section('addfilters')
	<span class="input-group-btn">
		{!! Form::select('filterBp', [
										 \Config::get('scsiie.ATT.ALL') => trans('userinterface.labels.ALL'),
										 \Config::get('scsiie.ATT.IS_COMP') => trans('userinterface.labels.IS_COMP'),
										 \Config::get('scsiie.ATT.IS_SUPP') => trans('userinterface.labels.IS_SUPP'),
										 \Config::get('scsiie.ATT.IS_CUST') => trans('userinterface.labels.IS_CUST'),
										 \Config::get('scsiie.ATT.IS_CRED') => trans('userinterface.labels.IS_CRED'),
										 \Config::get('scsiie.ATT.IS_DEBT') => trans('userinterface.labels.IS_DEBT'),
										 \Config::get('scsiie.ATT.IS_DEBT') => trans('userinterface.labels.IS_DEBT'),
										 \Config::get('scsiie.ATT.IS_EMPL') => trans('userinterface.labels.IS_EMPL'),
										 \Config::get('scsiie.ATT.IS_AGTS') => trans('userinterface.labels.IS_AGTS'),
										 \Config::get('scsiie.ATT.IS_PART') => trans('userinterface.labels.IS_PART'),
											],
											$iFilterBp, ['class' => 'form-control', 'required']) !!}
	</span>
@endsection

@section('title', trans('userinterface.titles.LIST_BPS'))

@section('content')
	<?php $sRoute='siie.bps' ?>
	@section('create')
		@include('templates.form.create')
	@endsection
	<table id="table"
               data-toggle="table"
               data-toolbar="#toolbar"
							 class="table table-condensed">
		<thead>
			<th data-field="id" data-sortable="true">{{ trans('userinterface.labels.BP') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.RFC') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.CURP') }}</th>
			<th data-sortable="true">{{ trans('userinterface.labels.SIIE_ID') }}</th>
			<th>ATT</th>
			<th data-sortable="true">{{ trans('userinterface.labels.STATUS') }}</th>
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
						@if ($bpartner->is_company)
								<span class="label label-success">{{ trans('userinterface.labels.IS_COMP') }}</span>
						@endif
						@if ($bpartner->is_supplier)
								<span class="label label-default">{{ trans('userinterface.labels.IS_SUPP') }}</span>
						@endif
						@if ($bpartner->is_customer)
								<span class="label label-primary">{{ trans('userinterface.labels.IS_CUST') }}</span>
						@endif
						@if ($bpartner->is_creditor)
								<span class="label label-warning">{{ trans('userinterface.labels.IS_CRED') }}</span>
						@endif
						@if ($bpartner->is_debtor)
								<span class="label label-danger">{{ trans('userinterface.labels.IS_DEBT') }}</span>
						@endif
						@if ($bpartner->is_bank)
								<span class="label label-default">{{ trans('userinterface.labels.IS_BANK') }}</span>
						@endif
						@if ($bpartner->is_employee)
								<span class="label label-primary">{{ trans('userinterface.labels.IS_EMPL') }}</span>
						@endif
						@if ($bpartner->is_agt_sales)
								<span class="label label-info">{{ trans('userinterface.labels.IS_AGTS') }}</span>
						@endif
						@if ($bpartner->is_partner)
								<span class="label label-info">{{ trans('userinterface.labels.IS_PART') }}</span>
						@endif
					</td>
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
								$iRegistryId = $bpartner->id_bp;
						?>
						@include('templates.list.options')
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $bps->render() !!}
@endsection
