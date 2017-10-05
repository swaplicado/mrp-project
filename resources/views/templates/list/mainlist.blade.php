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
		<div class="panel-body"></div>
		<div class="col-md-12">
			<div class="row">

			</div>
			<div class="row">
				<div class="col-md-6">
					@yield('create')
				</div>
				<div class="col-md-6">
					@include('templates.list.search')
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					@include('flash::message')
					@include('templates.error')
				</div>
			</div>
		</div>
		<div class="panel-body">
			<section>
				@yield('content')
			</section>

		</div>
	</div>
	</div>
	</div>
@include('templates.scripts')
</body>
<br />
<br />
<footer>
	@include('templates.footer')
</footer>
</html>
