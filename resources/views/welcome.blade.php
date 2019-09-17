@extends('layouts.app')

@section('content')
  <h1>Welcome<h1>

  <form action="submit.php" method="post">
      ID: <input type="text" name="ID"><br>
      Name: <input type="text" name="name"><br>
      <input type="submit">
  </form>

@endsection
