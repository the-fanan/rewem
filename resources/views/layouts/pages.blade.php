@extends('layouts.master')
@section('body-class', 'skin-blue sidebar-mini')
@section('wrapper')
    <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">M<b>E</b>R</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Meruem<b> Dashboard</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('master/' . $auth->profilePicture()) }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ $auth->fullname }}</span>
                </a>
                <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ asset('master/' . $auth->profilePicture()) }}" class="img-circle" alt="User Image">

                    <p>
                    {{ $auth->fullname }} 
                    <small>Member since {{ $auth->created_at->diffForHumans() }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
                </ul>
            </li>
            </ul>
        </div>
        </nav>
    </header>

    <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('master/' . $auth->profilePicture()) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ $auth->fullname }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @foreach($auth->sidebarLinks() as $link)
        <li>
          <a href="{{ route($link['href']) }}">
            <i class="fa {{ $link['icon'] }}"></i> <span>{{ ucfirst($link['title']) }}</span>
          </a>
        </li>
        @endforeach
      </ul>
      
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

    @yield('content')
@endsection