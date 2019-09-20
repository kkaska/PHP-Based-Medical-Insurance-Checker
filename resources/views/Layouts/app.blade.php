<!DOCTYPE html>
<html>
<style>
	header {
  background-color: #666;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}
</style>
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