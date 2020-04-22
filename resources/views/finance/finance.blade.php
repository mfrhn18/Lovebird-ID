@extends('layouts.base')
<head>
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Morris charts -->
  <link rel="stylesheet" href="{{url('adminlte/bower_components/morris.js/morris.css')}}">
</head>

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
    <br>
    <div class="pull-right">
      @include('finance.addtransaction')
    </div>
  </section>

  <section class="content">
    <br>
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Neraca Keuangan</h3>
        
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>

      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <form>
              <select id="choice" name="filter">
                <option value="all">All</option>
                @foreach($data['dropdown'] as $item)
                  <option value="{{substr($item, 0, 7)}}" {{ request()->get('filter', '') == substr($item, 0, 7) ? 'selected' : '' }}>{{substr($item, 8).' '.substr($item, 0, 4)}}</option>
                @endforeach
              </select>
              <button class="btn btn-primary btn-sm" type="submit">Submit</button>
            </form>

            <table id="table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Deskripsi</th>
                  <th>Debet</th>
                  <th>Kredit</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Penjualan</td>
                  <td>Rp{{$data['aggregates']->get('_101',0)}}</td>
                  <td>Rp0</td>
                  <td>Rp{{$data['aggregates']->get('_101',0)}}</td>
                </tr>
                <tr>
                  <td>Lelang</td>
                  <td>Rp{{$data['aggregates']->get('_102',0)}}</td>
                  <td>Rp0</td>
                  <td>Rp{{$data['aggregates']->get('_102',0)}}</td>
                </tr>
                <tr>
                  <td>Pemasukan Lain-lain</td>
                  <td>Rp{{$data['aggregates']->get('_103',0)}}</td>
                  <td>Rp0</td>
                  <td>Rp{{$data['aggregates']->get('_103',0)}}</td>
                </tr>
                <tr>
                  <td>Tagihan</td>
                  <td>Rp0</td>
                  <td>Rp{{$data['aggregates']->get('_201',0)}}</td>
                  <td>Rp{{$data['aggregates']->get('_201',0)}}</td>
                </tr>
                <tr>
                  <td>Operasional</td>
                  <td>Rp0</td>
                  <td>Rp{{$data['aggregates']->get('_202',0)}}</td>
                  <td>Rp{{$data['aggregates']->get('_202',0)}}</td>
                </tr>
                <tr>
                  <td>Pengeluaran Lain-lain</td>
                  <td>Rp0</td>
                  <td>Rp{{$data['aggregates']->get('_203',0)}}</td>
                  <td>Rp{{$data['aggregates']->get('_203',0)}}</td>
                </tr>
                <tr>
                  <th>Total Keuangan</th>
                  <th>Rp{{$data['aggregates']->get('debet',0)}}</th>
                  <th>Rp{{$data['aggregates']->get('kredit',0)}}</th>
                  <th>Rp{{$data['aggregates']->get('debet',0) - $data['aggregates']->get('kredit',0)}}</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
            
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari tanggal..">
            </div>
            <table id="myTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Deskripsi</th>
                  <th>Jenis</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              @foreach($data['data']['data']['user']['journal'] as $trx)
                @foreach($trx['transaction'] as $tx)
                <tbody>
                  <td>{{$tx['timeStamp']}}</td>
                  <td>{{$tx['description']}}</td>
                  <td>{{$tx['type']}}</td>
                  <td>Rp{{$tx['amount']}}</td>
                </tbody>
                @endforeach
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
    
  </section>
</main>
@endsection


<script>
  var msg = '{{Session::get('alert')}}';
  var exist = '{{Session::has('alert')}}';
  if(exist){
    alert(msg);
  }

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