@extends('layouts.base')

@section('content')
<main role="main">
  <section class="content-header">
    <h1>
      Finance
      <small>Information</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#"><i class="fa fa-dollar"></i> Finance</a></li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <div class="pull-left">
              <hi class="box-title">
                Jurnal Keuangan
              </h1>
            </div>
            <div class="pull-right">
              @include('addjournal')
            </div>
          </div>
        </div>

        <div class="box">
          <div class="box-body">
            <div class="row">
              @foreach($data['data']['user']['journal'] as $journal)
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$journal['timeStamp']}}</h3>
                    </div>
                    <a href="{{route('journaldetails.show', $journal['id'])}}" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</main>
@endsection