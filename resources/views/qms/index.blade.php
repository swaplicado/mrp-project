@extends('templates.home.modules')

@section('title', trans('qms.MODULE'))

@section('content')

  <div class="row">
    @include('templates.home.rapidaccess')
    <?php echo createBlock(asset('images/wms/box.gif'), "#", trans('qms.QRY_BY_STATUS'), "warning3", trans('wms.QRY_INVENTORY_T'));?>
    <?php echo createBlock(asset('images/qms/boxtime.png'), "#", trans('qms.IN_INSPECTION'), "warning3", trans('wms.MOV_WAREHOUSES_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/qms/inspection.gif'), "#", trans('qms.CLASSIFICATION'), "warning3", trans('wms.DOC_ASSORTMENT_T'));?>
    <?php echo createBlock(asset('images/qms/lots.gif'), "#", trans('qms.LOTS'), "warning3", trans('wms.DOC_RETURNS_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/barcode.gif'), "#", trans('wms.LBL_GENERATION'), "warning3", trans('wms.LBL_GENERATION_T'));?>
    <?php echo createBlock(asset('images/wms/reports.gif'), "#", trans('wms.REPORTS'), "warning3", trans('wms.REPORTS_T'));?>
  </div>

@endsection
