@extends('layouts.base')

@section('content')
  <main role="main">
    
    <section class="content-header">
      <h1>
        Dashboard
        <small>Breeder Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
    <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>BirdFarm</h3>

              <p>Management</p>
            </div>
            <div class="icon">
              <img class="rounded-circle" src="{{ asset('img/bird-farm.png')}}" alt="Generic placeholder image" width="70" height="70">
            </div>
            <a href="birdfarm" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Breeding</h3>

              <p>Information</p>
            </div>
            <div class="icon">
              <img class="rounded-circle" src="{{ asset('img/breeding.png')}}" alt="Generic placeholder image" width="70" height="70">
            </div>
            <a href="breeding" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Gallery</h3>

              <p>Bird Collection</p>
            </div>
            <div class="icon">
              <img class="rounded-circle" src="{{ asset('img/gallery.png')}}" alt="Generic placeholder image" width="70" height="70">
            </div>
            <a href="gallery" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Finance</h3>

              <p>Information</p>
            </div>
            <div class="icon">
              <img class="rounded-circle" src="{{ asset('img/finance.png')}}" alt="Generic placeholder image" width="70" height="70">
            </div>
            <a href="finance" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>

  </main>
@endsection