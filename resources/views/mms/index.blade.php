@extends('templates.home.modules')

@section('title', trans('mms.MODULE'))

@section('content')

  <div class="row">
    @include('templates.home.rapidaccess')
    <?php echo createBlock(asset('images/wms/box.gif'), "#", trans('wms.QRY_INVENTORY'), "primary3", trans('wms.QRY_INVENTORY_T'));?>
    <?php echo createBlock(asset('images/mms/ingred_list.gif'), "#", trans('mms.FORMULAS'), "primary3", trans('mms.FORMULAS_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/folder.gif'), "#", trans('mms.PROD_ORDER'), "primary3", trans('mms.PROD_ORDER_T'));?>
    <?php echo createBlock(asset('images/wms/whss.gif'), "#", trans('mms.EXPL_MAT'), "primary3", trans('mms.EXPL_MAT_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/monta.gif'), "#", trans('mms.ASSIGNAMENT'), "primary3", trans('mms.ASSIGNAMENT_T'));?>
    <?php echo createBlock(asset('images/wms/reports.gif'), "#", trans('wms.REPORTS'), "primary3", trans('wms.REPORTS_T'));?>
  </div>

@endsection
