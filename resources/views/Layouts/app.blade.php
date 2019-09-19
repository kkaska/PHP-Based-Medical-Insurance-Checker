<!DOCTYPE html>
<html>
  <head>
      @include('layouts.partials.head')
  </head>
  <body>

    @include('layouts.partials.header')

    <div class="content">
      @yield('content')
    </div>

    @include('layouts.partials.footer')
  </body>
</html>
