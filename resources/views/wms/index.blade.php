@extends('templates.home.modules')

@section('title', trans('wms.MODULE'))

@section('content')

  <div class="row">
    @include('templates.home.rapidaccess')
    <?php echo createBlock(asset('images/wms/box.gif'), "#", trans('wms.QRY_INVENTORY'), "success3",trans('wms.QRY_INVENTORY_T'));?>
    <?php echo createBlock(asset('images/wms/movsan.gif'), "#", trans('wms.MOV_WAREHOUSES'), "success3", trans('wms.MOV_WAREHOUSES_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/monta.gif'), "#", trans('wms.DOC_ASSORTMENT'), "success3", trans('wms.DOC_ASSORTMENT_T'));?>
    <?php echo createBlock(asset('images/wms/movss.gif'), "#", trans('wms.DOC_RETURNS'), "success3", trans('wms.DOC_RETURNS_T'));?>
  </div>
  <div class="row">
    <?php echo createBlock(asset('images/wms/barcode.gif'), "#", trans('wms.LBL_GENERATION'), "success3", trans('wms.LBL_GENERATION_T'));?>
    <?php echo createBlock(asset('images/wms/reports.gif'), "#", trans('wms.REPORTS'), "success3", trans('wms.REPORTS_T'));?>
  </div>

@endsection
