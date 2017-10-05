<nav class="navbar navbar-inverse">
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
          <li><a href="#">{{ trans('userinterface.HOME') }}</a></li>
          <li><a href="{{ route('start') }}">{{ trans('userinterface.SYS') }}</a></li>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('userinterface.CATALOGUES') }}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.USERS')))
                <li>
                  <a href="{{ route('admin.users.index') }}">{{ trans('userinterface.USERS') }}</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.PRIVILEGES')))
                <li>
                  <a href="{{ route('admin.privileges.index') }}">{{ trans('userinterface.PRIVILEGES') }}</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.ASSIGNAMENTS')))
                <li>
                  <a href="{{ route('admin.userPermissions.index') }}">{{ trans('userinterface.USER_PERMISSIONS') }}</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.PERMISSIONS')))
                <li>
                  <a href="{{ route('admin.permissions.index') }}">{{ trans('userinterface.PERMISSIONS') }}</a>
                </li>
              @endif
                <li>
                  <a href="{{ route('admin.companies.index') }}">{{ trans('userinterface.COMPANIES') }}</a>
                </li>
            </ul>
          </li>
        </ul>
        @include('templates.menu.userul')
    </div><!-- /.container-fluid -->
  </div>
</nav>
