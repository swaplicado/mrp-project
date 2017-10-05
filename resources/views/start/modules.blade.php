@extends('templates.home.mainHome')
<br />
<br />
@section('title', trans('userinterface.titles.SELECT_MODULE'))

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8"><h1>{{ trans('userinterface.SYSTEM') }}</h1></div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-4"><a href="{{ route('mms.home') }}" class="btn btn-primary3 button-xlarge btn3d" role="button">{{ trans('mms.MODULE') }}</a></div>
      <div class="col-md-4"><a href="{{ route('qms.home') }}" class="btn btn-warning3 button-xlarge btn3d">{{ trans('qms.MODULE') }}</a></div>
      <div class="col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-4"><a href="{{ route('wms.home') }}" class="btn btn-success3 button-xlarge btn3d">{{ trans('wms.MODULE') }}</a></div>
      <div class="col-md-4"><a href="{{ route('tms.home') }}" class="btn btn-info3 button-xlarge btn3d">{{ trans('tms.MODULE') }}</a></div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <br />
  <br />
@endsection
