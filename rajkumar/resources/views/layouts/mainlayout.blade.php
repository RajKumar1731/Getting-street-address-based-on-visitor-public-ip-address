<!doctype html>
<html lang="en">
  <head>
    @include('layouts.partials.head')
 </head>
 <body>
   <main>
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

    </main>
 </body>
</html> 