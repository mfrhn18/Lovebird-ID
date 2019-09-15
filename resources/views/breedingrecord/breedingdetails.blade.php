@extends('layouts.base')

@section('content')
<main role="main">

    <section class="content-header">
        <h1>
            Breeding
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="breeding"><i class="glyphicon glyphicon-info-sign"></i> Breeding</a></li>
            <li class="active"><a href="#"> Details</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-6">
                            <!-- Gallery -->
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="text-center">
                                    <img class="d-block img-fluid" src="{{$data['data']['birdParentById']['image']['src']}}" width="450">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="pull-left">
                                    <h3>Informasi Induk</h3>
                                </div>
                                <div class="pull-right">
                                    @include('breedingrecord.bdaddbatch')</br>
                                </div>
                            </div>
                            <div id="inforow" class="row">
                                <hr>
                                <table class="mt-3 pt-3 mb-1 pb-1" id="userdetails">
                                    <tbody>
                                        <tr>
                                            <th>Induk Jantan</th>
                                            <td>:</td>
                                            <td>
                                                {{$data['data']['birdParentById']['male']['ring']}}
                                                ({{$data['data']['birdParentById']['male']['species']}})
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Induk Betina</th>
                                            <td>:</td>
                                            <td>
                                                {{$data['data']['birdParentById']['female']['ring']}}
                                                ({{$data['data']['birdParentById']['female']['species']}})
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>No. Induk</th>
                                            <td>:</td>
                                            <td>{{$data['data']['birdParentById']['noParent']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Batch</th>
                                    <th>Status</th>
                                    <th>Egg</th>
                                    <th>Date</th>
                                    <th>Mortality</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            <!-- Add data from database via GraphQL -->
                            <tbody>
                                @foreach($data['data']['birdParentById']['breedingRecord'] as $brec)
                                <tr>
                                    <td>{{$brec['name']}}</td>
                                    <td>{{$brec['status']}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @include('breedingrecord.bdaddrec')
                                            </div>
                                            <div class="col-md-6">
                                                <div class="button">
                                                    <a href="/" type="button" class="btn btn-block btn-sm bg-orange">
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
  
</main>

@endsection