<!DOCTYPE html>
<html lang="es">
	@include('templates.head')
<body>
	@if (Auth::check())
		@include('templates.menu.menu')
	@else
		<br />
	@endif

	<div class="container">

	<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">@yield('title')</h2>
		</div>

		<div class="col-md-12">

		</div>
		<div class="panel-body">
			<section>
				@include('flash::message')
				@include('templates.error')

				@yield('content')
			</section>

		</div>
		<div class="col-md-4">
		</div>
	</div>
	</div>


@include('templates.scripts')

</div>

<footer>
	@include('templates.footer')
</footer>

</body>
</html>
