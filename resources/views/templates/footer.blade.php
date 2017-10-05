<section id="footer" style="background-color: rgb(41, 43, 52); position: absolute; bottom: 0;width: 100%">
		<center style="color:#fff;">
		    <div class="well well-sm" style="background-color:#292b34; border:0px">

		            <div class="col-md-12">
		                    <div class="col-md-6 ">
		                        <h6>© Copyright Software Aplicado S.A. de C.V.</h6>
		                    </div><!--end .col-md-4 .contact-email-->
		                    <div class="col-md-6">
		                        <?php date_default_timezone_set('America/Mexico_City');?>
                                <h6 id="reloj" style="font-size:15px;"></h6>

		                    </div><!--end .col-md-6-->
		            </div><!--end .col-md-12-->

		    </div><!--end .well .well-sm .main-footer-->
		</center>
</section>

<script type="text/javascript">
    function startTime(){
    today = new Date();
    mesm = today.getMonth() + 1;
    mes = (mesm < 10) ? '0' + mesm : mesm;
    yy = today.getYear()
    year = (yy < 1000) ? yy + 1900 : yy;
    h = today.getHours();
    m = today.getMinutes();
    s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);

    document.getElementById('reloj').innerHTML = today.getDate() + "/" + mes + "/" + year + "  " + h + ":" + m + ":" + s;
    t = setTimeout('startTime()',500);}
    function checkTime(i) {
      if (i<10) {
        i="0" + i;
      }

      return i;
    }
    window.onload=function(){startTime();}
</script>
