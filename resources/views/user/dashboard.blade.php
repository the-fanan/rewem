@extends('layouts.pages')
@section('title', 'Meruem | Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Info boxes -->
    <div class="row">
        @foreach($auth->dashboardTabs() as $tab)
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon {{ $tab['bg-color'] }}"><i class="fa {{ $tab['icon'] }}"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ ucfirst($tab['title']) }}</span>
              <span class="info-box-number">{{ $tab['quantity'] }}<small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        @endforeach
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@push('page-scripts')
@endpush