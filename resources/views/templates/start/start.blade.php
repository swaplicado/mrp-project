
{!! Form::open(['route' => $sRoute, 'method' => 'POST', 'files' => true]) !!}
	@yield('content')
	<div class="form-group" align="right">
			{!! Form::submit('Entrar', ['class' => 'btn btn-primary', 'onclick' => 'getValue()']) !!}
			<input type="button" name="{{ trans('actions.CANCEL') }}" value="{{ trans('actions.CANCEL') }}" class="btn btn-danger" onClick="location.href='{{ route('auth.logout') }}'">
	</div>
{!! Form::close() !!}
