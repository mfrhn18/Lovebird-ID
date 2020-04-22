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
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img class="d-block img-fluid" src="{{$data['data']['birdParentById']['image']['src']}}" width="500">
                                    </div>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="pull-left">
                                    <h3>Informasi Induk</h3>
                                </div>
                                @php
                                    $finished = true;
                                    foreach($data['data']['birdParentById']['breedingRecord'] as $brec):
                                        if($brec['status'] != "Finish"):
                                            $finished = false;
                                        endif;
                                    endforeach;
                                @endphp
                                @if($finished == "true")
                                    <div class="pull-right">
                                        <a href="/breedingdetails/batch/{{$data['data']['birdParentById']['id']}}" type="button" class="btn btn-block btn-sm bg-orange" >
                                            Add Batch
                                        </a></br>
                                    </div>
                                @else
                                    <div class="pull-right">
                                        <a href="#" type="button" class="btn btn-block btn-sm bg-orange" disabled>
                                            Add Batch
                                        </a></br>
                                    </div>
                                @endif
                            </div>
                            <div id="inforow" class="row">
                                <hr>
                                <table class="mt-3 pt-3 mb-1 pb-1" id="userdetails">
                                    <tbody>
                                        <tr>
                                            <th>No. Induk</th>
                                            <td>:</td>
                                            <td>{{$data['data']['birdParentById']['noParent']}}</td>
                                        </tr>
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
                                    @php
                                    $egg = 0;
                                    $date = 'n/a';
                                    $mortality = 0;
                                    foreach($brec['log'] as $log):
                                        if($log['type'] == "Bertelur"):
                                            $egg = substr($log['description'], 18);
                                            $date = $log['timeStamp'];
                                        endif;
                                        if($log['born'] && $log['dead'] != "null"):
                                            $mortality = ($log['born'] / ($log['born'] + $log['dead'])) * 100;
                                        endif;
                                    endforeach;
                                    @endphp
                                    <td>{{$egg}}</td>
                                    <td>{{$date}}</td>
                                    <td>{{$mortality}}%</td>
                                    <td>
                                        <div class="row">
                                        <!-- Button -->
                                            <div class="button">
                                                <button type="button" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#{{$brec['name']}}">
                                                    Details
                                                </button>
                                            </div>
                                        <!-- Modal -->
                                            <div class="modal fade" id="{{$brec['name']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Batch Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-Label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <table id="batchDetails" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tanggal</th>
                                                                        <th>Log</th>
                                                                        <th>Deskripsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($brec['log'] as $log)
                                                                    <tr>
                                                                        <td>{{$log['timeStamp']}}</td>
                                                                        <td>{{$log['type']}}</td>
                                                                        <td>{{$log['description']}}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                            @if($brec['status'] != 'Finish')
                                                                <a href="/breedingdetails/batch/addrecord/{{$brec['id']}}" type="button" class="btn btn-block btn-sm bg-orange">
                                                                    Add Record
                                                                </a>
                                                                <a href="/breedingdetails/batch/closebatch/{{$brec['id']}}">
                                                                    <button type="submit" class="btn btn-block btn-sm bg-red">
                                                                        Close Batch
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
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

<script>
    function myFunction() {
        // Declare variables 
        var value;
        value = document.getElementById("myInput");

        // Loop through all table rows, and hide those who don't match the search query
        
    }
</script>