@extends('layouts.mainlayout')
@section('content')

<hr style="margin: 1rem 0;">
<div class="container marketing">

    <div class="py-5 text-center">
      <!--<img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
      <h2 class="text-primary">To Send Email</h2>
      <p class="lead">This form is to receive email address and message from visitor and send mail to them as well.</p>
    </div> 

    <div class="row g-5">
      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">To send email</h4>

        <form action="{{ url('email-sent') }}" method="POST" class="needs-validation" novalidate>
          @csrf
            
            
            <div class="col-lg-8 col-md-8 col-sm-12">
              <label for="email" class="form-label">Email</label>
              <input type="hidden" name="subject" class="form-control" id="subject" value="Visitor Email">
              <input type="text" name="email" class="form-control" id="email">

            </div>

            <div class="col-lg-8 col-md-8 col-sm-12">
              <label for="messages" class="form-label">Message</label>
              <!-- <input type="text" name="messages" class="form-control" id="messages" > -->
              <textarea type="text" name="messages" class="form-control" id="messages"  cols="5" rows="8"></textarea>
            
            </div>
            
            <hr class="my-4">

          <input type="submit" name="submit" class="w-100 btn btn-primary btn-lg" value="Submit">
          
        </form>
        
        
        
      </div>
    </div>
  
        <!-- <hr class="featurette-divider"> -->

        </div><!-- /.container -->

@endsection
<b></b>