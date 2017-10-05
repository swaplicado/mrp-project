<?php
		function createBlock($image, $route, $button, $class, $text) {
			$rapidAccess =
        "
          <div class='col-md-6'>
            <div class='row'>
              <div class='col-md-1'>
              </div>
              <div class='col-md-5'>
                <img align='right' style=' width: 90%; height: 90%'' src='".$image."' alt='' class='img-rounded'>
              </div>
              <div class='col-md-5'>
                <div class='row'>
                  <a href='".$route."' class='btn btn-".$class."' style='display:block;'>".$button."</a>
                </div>
                <div class='row'>
                  <div class='bs-callout bs-callout-info'>
                    <p>".$text."</p>
                  </div>
                </div>
              </div>
              <div class='col-md-1'>
              </div>
            </div>
          </div>
    			";

		return $rapidAccess;
		}
