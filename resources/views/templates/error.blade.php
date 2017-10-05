	@if(count($errors)>0)
		<div class="alert alert-danger alert-dismissable" role="alert">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">
 			<i class="em em-heavy_multiplication_x"></i>

			</a>
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
			</div>
	@endif
