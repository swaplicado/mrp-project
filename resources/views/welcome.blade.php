<!DOCTYPE html>
<html lang="es">
	@include('front.templates.head')
<body>
	<br />
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
				<h1 style="text-align = center;">MRP</h1>
				<h1>Manufacturing Resources Planning</h1>

				<a class="btn btn-primary" href="{{ route('auth.login') }}">Entrar</a>
			</section>
		</div>
		<div class="col-md-4">
		</div>
	</div>
	</div>


	<script src="{{ asset('/jquery/js/jquery-3.2.1.js')}}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.js')}}"></script>
	<script src="{{ asset('chosen/chosen.jquery.js') }}"></script>
	<script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}"></script>

</div>

<footer>
	@include('front.templates.footer')
</footer>

</body>
</html>
