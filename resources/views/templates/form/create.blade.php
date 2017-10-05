<a href={{  route($sRoute.'.create') }} class="btn btn-success btn-min"
      style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('scsys.OPERATION.CREATE'), $actualUserPermission, 0) }};">
      {{ trans('actions.CREATE') }}
</a>
