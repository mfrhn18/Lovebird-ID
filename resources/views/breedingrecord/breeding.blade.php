@extends('layouts.base')

@section('content')    
<main role="main">

  <section class="content-header">
    <h1>
      Breeding
      <small>Information</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><a href="#"><i class="glyphicon glyphicon-info-sign"></i> Breeding</a></li>
    </ol>
  </section>

  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        {{-- <div class="small-box bg-green">
          <div class="inner">
            <h3>Register</h3>
            <p>Induk</p>
          </div>
          <div class="icon">
            <img class="rounded-circle" src="{{ asset('img/reginduk.png')}}" alt="Generic placeholder image" width="70" height="70">
          </div>
          <a href="reginduk" class="small-box-footer">Add new <i class="fa fa-arrow-circle-right"></i></a>
        </div> --}}
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
              <small>Product Collections</small>
            </h1>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="input-group">
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari No. Induk..">
            </div>
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No. Parent</th>
                  <th width="20%"></th>
                  <th>Male Ring</th>
                  <th>Female Ring</th>
                  <th>Produk ke</th>
                  <th>Telur terlihat pada</th>
                  <th>Mortality</th>
                  <th></th>
                </tr>
              </thead>
              @foreach($data['data']['user']['birdParent'] as $parent)
              <tbody>
                <tr>
                  <td>{{$parent['noParent']}}</td>
                  <td><img class="img-fluid img-thumbnail" src="{{$parent['image']['src']}}"></td>
                  <td>{{$parent['male']['ring']}} - {{$parent['male']['species']}}</td>
                  <td>{{$parent['female']['ring']}} - {{$parent['female']['species']}}</td>
                  <td>{{count($parent['breedingRecord'])}}</td>
                  @php
                    $date = 'n/a';
                    foreach($parent['breedingRecord'] as $brec):
                      if($brec['status'] == "on process"):
                        foreach($brec['log'] as $log):
                          if($log['type'] == "Bertelur"):
                            $date = $log['timeStamp'];
                          endif;
                        endforeach;
                        endif;
                    endforeach;
                  @endphp
                  <td>{{$date}}</td>
                  @php
                    $mortality = 0;
                    $born = 0;
                    $dead = 0;
                    foreach($parent['breedingRecord'] as $brec):
                      if($brec['status'] == "Finish"):
                        foreach($brec['log'] as $log):
                          if($log['type'] == "Hatch"):
                            $born += $log['born'];
                            $dead += $log['dead'];
                          endif;
                        endforeach;
                      endif;
                    endforeach;
                    if($born + $dead > 0):
                      $mortality = ($born / ($born + $dead)) * 100;
                    endif;
                  @endphp
                  <td>{{$mortality}}%</td>
                  <td>
                    <div class="button">
                      <a href="/breedingdetails/{{$parent['id']}}" type="button" class="btn btn-block btn-sm bg-orange">
                        Details
                      </a>
                    </div>
                  </td>
                  <td></td>
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