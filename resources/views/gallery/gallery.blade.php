@extends('layouts.base')

@section('content')    
<main role="main">
    <section class="content-header">
        <h1>
            Gallery
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="birdfarm"><i class="fa fa-picture-o"></i> Gallery</a></li>
        </ol>
    </section>    

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-left">
                            <h4>Bird Gallery</h4>    
                        </div>
                        <div class="pull-right">
                            @include('gallery.addimage')
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="container marketing text-center">        
                            
                            <div class="row text-center text-lg-left">
                                @foreach($data['data']['user']['birdOwned'] as $img)
                                    @foreach ( $img['image'] as $image )
                                        <div class="col-lg-3 col-md-4 col-xs-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail" src="{{$image['src']}}" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                                    
                            </div><!-- /.row -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>  
</main>
@endsection