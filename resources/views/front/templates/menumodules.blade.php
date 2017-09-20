<?php
  if (! isset($sClassNav))
  {
    $sClassNav = session()->has('menu') ? session('menu')->getClassNav() : '';
  }
?>

<nav class="navbar {{ $sClassNav }}">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img style="padding-bottom: -5; padding-top: 5px;  padding-bottom: -5; height: 45px;" width="50" height="50" src="{{ asset('images/logo.jpg') }}">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <!-- Collect the nav links, forms, and other content for toggling -->
  			<ul class="nav navbar-nav">
  				@include(config('laravel-menu.views.bootstrap-items'), array('items' => $sMenu->roots()))
  			</ul>
        @include('front.templates.userul')
        @include('front.templates.navmodules')
    </div><!-- /.container-fluid -->
  </div>
</nav>
