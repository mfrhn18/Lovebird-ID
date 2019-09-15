@extends('layouts.base')

<style>
    #myInput {
        background-image: url('/public/img/searchicon.png'); /* Add a search icon to input */
        background-position: 10px 12px; /* Position the search icon */
        background-repeat: no-repeat; /* Do not repeat the icon image */
        width: 100%; /* Full-width */
        font-size: 16px; /* Increase font-size */
        padding: 12px 20px 12px 40px; /* Add some padding */
        border: 1px solid #ddd; /* Add a grey border */
        margin-bottom: 12px; /* Add some space below the input */
    }
</style>

@section('content')    
    <main role="main">

      <section class="content-header">
        <h1>
            BirdFarm
            <small>Management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#"><i class="glyphicon glyphicon-info-sign"></i> BirdFarm</a></li>
        </ol>
      </section>

      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>Register</h3>

                        <p>Burung</p>
                    </div>
                    <div class="icon">
                        <img class="rounded-circle" src="{{ asset('img/regbird.png')}}" alt="Generic placeholder image" width="70" height="70">
                    </div>
                    <a href="regbird" class="small-box-footer">Add new <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>Register</h3>

                        <p>Induk</p>
                    </div>
                    <div class="icon">
                        <img class="rounded-circle" src="{{ asset('img/reginduk.png')}}" alt="Generic placeholder image" width="70" height="70">
                    </div>
                    <a href="reginduk" class="small-box-footer">Add new <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
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
                            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari No. Ring...">
                        </div>
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No. Ring</th>
                                    <th width="20%"></th>
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
                                    <td><img class="img-fluid img-thumbnail" src="{{$collection['image'][0]['src']}}"></td>
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