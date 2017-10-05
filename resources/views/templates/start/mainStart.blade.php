<!DOCTYPE html>
<html lang="es">
	@include('templates.head')
<body>
	<div class="container">

	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading col-md-12">
				<div class="col-md-10">
					<h2 class="panel-title">@yield('title')</h2>
				</div>
				<div style="text-align: right;" class="dropdown col-md-2">
					<button class="btn btn-default dropdown-toggle"
											type="button" id="dropdownMenu1"
											data-toggle="dropdown"
											aria-haspopup="true" aria-expanded="true">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						@if (\Auth::user()->user_type_id == \Config::get('scsys.TP_USER.ADMIN'))
							<li>
									<a href="{{ route('plantilla.admin') }}">{{ trans('userinterface.ADMINISTRATOR') }}</a>
							</li>
						@endif
							<li>
									<a href="{{ route('auth.logout') }}">{{ trans('userinterface.EXIT') }}</a>
							</li>
					</ul>
				</div>
			</div>
		<div class="panel-body">
			<section>
				@include('flash::message')
				@include('templates.error')

			</section>
		</div>
		<div class="col-md-12">
			@include('templates.start.start')
		</div>
		<div class="panel-body">


		</div>
		<div class="col-md-4">
		</div>
	</div>
	</div>
	</div>

	@include('templates.scripts')

	@yield('js')

</body>
</html>
