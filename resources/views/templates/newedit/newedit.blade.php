@if(isset($aux))
	@if (isset($bIsCopy))
		{!! Form::open(['route' => [$sRoute, $aux], 'method' => 'POST']) !!}
		@yield('content')
		<div class="form-group" align="right">
			{!! Form::submit(trans('actions.SAVE'), ['class' => 'btn btn-primary', 'onClick' => 'disable(this)']) !!}
	@else
		{!! Form::open(['route' => [$sRoute, $aux], 'method' => 'PUT']) !!}
		@yield('content')
		<div class="form-group" align="right">
			{!! Form::submit(trans('actions.EDIT'), ['class' => 'btn btn-primary', 'onClick' => 'disable(this)']) !!}
	@endif
@else
	{!! Form::open(['route' => $sRoute, 'method' => 'POST']) !!}
	@yield('content')
	<div class="form-group" align="right">
		{!! Form::submit(trans('actions.SAVE'), ['class' => 'btn btn-primary']) !!}
@endif
	<input type="button" name="{{ trans('actions.CANCEL') }}" value="{{ trans('actions.CANCEL') }}" class="btn btn-danger" onClick="location.href='{{ route($sRoute2) }}'">
	</div>
	{!! Form::close() !!}
