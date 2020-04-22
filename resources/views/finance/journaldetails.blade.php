@extends('layouts.base')

@section('content')
<main role="main">
    <section class="content-header">
        <h1>
            Journal
            <small>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="finance"><i class="fa fa-dollar"></i> Finance</a></li>
            <li class="active"><a href="#"> Journal</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <hi class="box-title">
                        Jurnal {{$data['data']['data']['journalById']['timeStamp']}}
                    </h1>
                </div>
                <div class="pull-right">
                    @include('finance.addtransaction')
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="journal" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Deskripsi</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>@include('finance.detailstrx')</th>
                                </tr>
                            </thead>
                            @foreach($data['data']['data']['journalById']['transaction'] as $tx)
                            <tbody>
                                <td>{{$tx['timeStamp']}}</td>
                                <td>{{$tx['description']}}</td>
                                <td>{{$tx['type']}}</td>
                                <td>Rp{{$tx['amount']}}</td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection