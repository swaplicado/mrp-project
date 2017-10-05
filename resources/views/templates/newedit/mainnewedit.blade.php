<!DOCTYPE html>
<html lang="es">
	@include('templates.head')
<body>

	@yield('menu')

	<div class="container">

	<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">@yield('title')</h2>
		</div>
		<div class="panel-body">
			<section>
				@include('flash::message')
				@include('templates.error')

			</section>
		</div>
		<div class="col-md-12">
		@include('templates.newedit.newedit')
		</div>
		<div class="panel-body">


		</div>
		<div class="col-md-4">
		</div>
	</div>
	<br />
	</div>
	</div>
<br />
	@include('templates.scripts')

	@yield('js')

</body>
<footer>
	@include('templates.footer')
</footer>
</html>
