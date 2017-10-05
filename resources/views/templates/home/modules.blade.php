<!DOCTYPE html>
<html lang="es">
	@include('templates.head')
<body>

  @include('templates.menu.menumodules')

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
				<section>
					@yield('content')
				</section>
      </div>
    </div>
  </div>
</div>
<br />
<br />

<!-- Scripts -->
@include('templates.scripts')

@yield('js')

</body>
  <footer>
  @include('templates.footer')
  </footer>
</html>
