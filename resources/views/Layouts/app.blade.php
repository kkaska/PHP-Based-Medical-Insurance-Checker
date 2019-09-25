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
    width: 50%;
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
  .side {
    top: 0%;
    width: 200%;
    

  }
</style>
  <head>
      @include('layouts.partials.head')
  </head>

  <body class="bg-primary">
      @include ('layouts.partials.breadcrumbs')
    <div class="content">
      @yield('content')
    </div>
      @include('layouts.partials.footer')
  </body>
  
</html>