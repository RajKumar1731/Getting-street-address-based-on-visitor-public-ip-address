@extends('layouts.mainlayout')
@section('content')

<hr style="margin: 1rem 0;">
<div class="container marketing">

    <div class="py-5 text-center">
      <!--<img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h2 class="text-primary">Execution Time</h2>
      <p class="lead">This form is to upload basic details like FirstName, LastName and Execution time.</p>
    </div> 

    <div class="row g-5">
      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">Please fill up the form given below and send to us!</h4>
        <form action="{{ url('form-execution-time') }}" method="POST" class="needs-validation" novalidate>
          @csrf

          <div class="row g-3">
            
            
            <div class="col-sm-4">
              <label for="FirstName" class="form-label">FirstName</label>
              <input type="text" name="FirstName" class="form-control" id="FirstName">
              <div class="invalid-feedback">
                Valid FirstName is required.
              </div>
            </div>

            <div class="col-sm-4">
              <label for="LastName" class="form-label">LastName</label>
              <input type="text" name="LastName" class="form-control" id="LastName" >
              <div class="invalid-feedback">
                Valid last LastName is required.
              </div>
            </div>
            
            <!--<hr class="my-4">-->

          <input type="submit" name="submit" class="w-100 btn btn-primary btn-lg" value="Submit">
          
        </form>
        
        
      </div>
    </div>
  
        <hr class="featurette-divider">

        </div><!-- /.container -->

@endsection
<b></b>