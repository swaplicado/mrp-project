{!! Form::open(['route' => [ $sRoute.'.index'],'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
	<div class="form-group">
    <div class="input-group">
	    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('userinterface.placeholders.SEARCH'), 'aria-describedby' => 'search']) !!}
	    <span class="input-group-btn">
				{!! Form::select('filter', [
												 \Config::get('scsys.FILTER.ACTIVES') => trans('userinterface.labels.ACTIVES'),
												 \Config::get('scsys.FILTER.DELETED') => trans('userinterface.labels.INACTIVES'),
												 \Config::get('scsys.FILTER.ALL') => trans('userinterface.labels.ALL')
													],
													$iFilter, ['class' => 'form-control', 'required']) !!}
	    </span>
	    <span class="input-group-btn">
	        <button id="searchbtn" type="submit" class="form-control">
						<span class="glyphicon glyphicon-search"></span>
					</button>
			</span>
    </div>
	</div>
{!! Form::close() !!}
