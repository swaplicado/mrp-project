<?php
		$v_id = $iRegistryId;
		$v_route_edit = $sRoute.'.edit';
		$v_route_destroy = $sRoute.'.destroy';
		$v_created_by = $oRegistry->created_by_id;
?>

<a href="{{ route($v_route_edit, $v_id) }}" data-toggle = "editar" title="{{ trans('userinterface.tooltips.EDIT') }}"
																						style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('scsys.OPERATION.EDIT'), $actualUserPermission, $v_created_by) }};"
																						class="btn btn-info">
	<span class="glyphicon glyphicon-pencil" aria-hidden = "true"/>
</a>
<a href="{{ route($v_route_destroy, $v_id) }}" style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('scsys.OPERATION.DEL'), $actualUserPermission, $v_created_by) }};"
															class="btn btn-danger"
															data-toggle="confirmation-popout" data-popout="true"
															data-btn-ok-label="{{ trans('messages.options.MSG_YES') }}"
															data-btn-cancel-label="{{ trans('messages.options.MSG_NO') }}"
															data-singleton="true" data-title="{{ trans('messages.confirm.MSG_CONFIRM') }}">
	<span class="glyphicon glyphicon-trash" aria-hidden = "true"/>
</a>
<div class="btn-group">
	<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
		<span  class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<ul style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('scsys.OPERATION.EDIT'), $actualUserPermission, $v_created_by) }};" class="dropdown-menu" role="menu">
		@if ($oRegistry->is_deleted == \Config::get('scsys.STATUS.DEL')
									&& App\SUtils\SValidation::isRenderedB(\Config::get('scsys.OPERATION.DEL'), $actualUserPermission, $v_created_by))
			<li>
				<a href="{{ route($sRoute.'.activate', $v_id) }}">
					<i class="glyphicon glyphicon-ok-sign"></i>
					&nbsp;{{ trans('userinterface.buttons.ACTIVATE') }}
				</a>
			</li>
			<li class="divider"></li>
		@endif
		@if (\Route::has($sRoute.'.copy'))
		<li><a href="{{ route($sRoute.'.copy', $v_id) }}"
					style="visibility: {{ App\SUtils\SValidation::isRendered(\Config::get('scsys.OPERATION.CREATE'), $actualUserPermission, $v_created_by) }};">
					<i class="glyphicon glyphicon-duplicate"></i>&nbsp;{{ trans('userinterface.buttons.DUPLICATE') }}
				</a>
		</li>
		@endif
	</ul>
</div>
