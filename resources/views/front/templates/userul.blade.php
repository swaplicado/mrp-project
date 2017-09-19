<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
      {{ Auth::check() ? Auth::user()->username : '' }}
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
      @if (\Auth::user()->user_type_id == \Config::get('scsys.TP_USER.ADMIN'))
        <li>
            <a href="{{ route('plantilla.admin') }}">{{ trans('userinterface.ADMINISTRATOR') }}</a>
        </li>
      @endif
      <li><a href="{{ route('auth.logout') }}">{{ trans('userinterface.EXIT') }}</a></li>
    </ul>
  </li>
</ul>
