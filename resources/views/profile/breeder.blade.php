@extends('layouts.base')

@section('content')
    <main role="main">

        <section class="content-header">
            <h1>
                Breeder
                <small>Profile</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><a href="#"><i class="glyphicon glyphicon-info-sign"></i> Profile</a></li>
            </ol>
        </section>

        <section class="content">
            <!-- User Photo & Information -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <!-- User Photo -->
                            <div class="col-md-4">
                                <img src="{{$data['data']['user']['image']['src']}}" width="100%">
                            </div>
                            <!-- User Information -->
                            <div class="col-md-8">
                                <table class="mt-3 pt-3 mb-1 pb-1" id="userinfo">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h1>{{Session::get('name')}}</h1>
                                                <h3>{{$data['data']['user']['city']}}</h3>
                                                <small><u>{{$data['data']['user']['location']}}</u></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><a class="btn btn-primary btn-sm" href="/editbreeder" role="button">Edit Profile &raquo;</a></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <table class="mt-3 pt-3 mb-1 pb-1" id="userdetails">
                                    <tbody>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>:</td>
                                            <td>{{$data['data']['user']['address']}}</td>
                                        </tr>
                                        <tr>
                                            <th>No. Telp</th>
                                            <td>:</td>
                                            <td>{{$data['data']['user']['phone']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>:</td>
                                            <td>{{$data['data']['user']['birthday']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Farm Name</th>
                                            <td>:</td>
                                            <td>{{$data['data']['user']['farmName']}}</td>
                                        </tr>
                                    </tbody>
                                </table>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Bird -->
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h1 class="box-title">
                                {{Session::get('name')}}
                                <small>Bird Collections</small>
                            </h1>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="input-group">
                                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari No. Ring..">
                            </div>
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No. Ring</th>
                                        <th>Bird Name</th>
                                        <th>Gender</th>
                                        <th>Warna Mutasi</th>
                                        <th>Breeder</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach($data['data']['user']['birdOwned'] as $collection)
                                <tbody>
                                    <tr>
                                        <td>{{$collection['ring']}}</td>
                                        <td>{{$collection['name']}}</td>
                                        <td>{{$collection['gender']}}</td>
                                        <td>{{$collection['species']}}</td>
                                        <td>{{$collection['breeder']}}</td>
                                        <td>
                                            <div class="button">
                                                <a href="{{ route('birddetails.show', $collection['id']) }}" type="button" class="btn btn-block btn-sm bg-orange">
                                                    Details
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
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
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            } 
        }
    }
</script>