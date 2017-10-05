<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('userinterface.MODULES') }} <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="{{ route('siie.home') }}">{{ trans('siie.MODULE') }}</a></li>
      <li><a href="{{ route('mms.home') }}">{{ trans('mms.MODULE') }}</a></li>
      <li><a href="{{ route('qms.home') }}">{{ trans('qms.MODULE') }}</a></li>
      <li><a href="{{ route('wms.home') }}">{{ trans('wms.MODULE') }}</a></li>
      <li><a href="{{ route('tms.home') }}">{{ trans('tms.MODULE') }}</a></li>
    </ul>
  </li>
</ul>
