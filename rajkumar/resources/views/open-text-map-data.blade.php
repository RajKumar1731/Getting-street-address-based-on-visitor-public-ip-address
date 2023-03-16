@extends('layouts.mainlayout')
@section('content')

<hr style="margin: 1rem 0;">
<div class="container marketing">

    <div class="py-5 text-center">
      <!--<img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h2 class="text-primary">Open Text Map Data</h2>
    </div> 

    <div class="row g-5">
      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">To export open text map data's id:</h4>

        <p>
          <a href="{{ url('exporting-id') }}" class="btn btn-primary" style="margin-left:70%">Export Excel Data</a>
        </p>
        
        
      </div>
    </div>
  
        <hr class="featurette-divider">

        </div><!-- /.container -->

@endsection
<b></b>