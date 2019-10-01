<!DOCTYPE html>
<html lang="en">
{{-- <style>
	/* header {
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
  } */
</style> --}}
  <head>
      <title>@yield('pageTitle') | HealthScanner</title>
      @include('layouts.partials.head')
  </head>

  <body class="bg-primary">
    {{-- Allows screen readers to skip past the navigation and search to the main content of the page --}}
      <a href="#content" style="display:none;">Skip to content</a>
    @include('layouts.partials.header')
    <div class="content" id='content'>
      @yield('content')
    </div>
      @include('layouts.partials.footer')
  </body>
  
</html>