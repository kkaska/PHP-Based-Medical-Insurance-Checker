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
  html, body {
    height: 100%;
  }
  body{
    align-items: center;
    justify-content: center;
  }
  .map-container{
    overflow:hidden;
    padding-bottom:56.25%;
    position:relative;
    height:0;
  }
  .map-container iframe{
    left:0;
    top:0;
    height:100%;
    width:100%;
    position:absolute;
  }
  .center-card{
    transform: translateY(50%);
  }
</style>
  <head>
      @include('layouts.partials.head')
  </head>

  <body class="bg-primary">
    <div class="content">
      @yield('content')
    </div>
    @include('layouts.partials.footer')
  </body>
  
</html>