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
  .absolute {
    position: absolute;
    top:25%;
    width: 100%;
  }
</style>
  <head>
      @include('layouts.partials.head')
  </head>
  <body>

    <div class="content">
      @yield('content')
    </div>

    @include('layouts.partials.footer')
  </body>
</html>