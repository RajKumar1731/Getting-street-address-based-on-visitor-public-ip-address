@extends('layouts.mainlayout')
@section('content')

<hr style="margin: 1rem 0;">
<div class="container marketing">

    <div class="py-5 text-center">
      <!--<img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h2 class="text-primary">Get & Display IP Address</h2>
      <p class="lead">On this page we will access public IP of the client and display street address associated with. Apart from this we will also store public IP based street details in cookie also.</p>
    </div> 

    <div class="row g-5">
      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">Get and diaply public ip:</h4>
        <ol>
        @foreach ($data as $key => $value)
            <li>{{ $key }}: {{ $value }}</li>
        @endforeach
        </ol>
        
        
      </div>
    </div>
  
        <hr class="featurette-divider">

        </div><!-- /.container -->

@endsection
<b></b>