@extends('layouts.app')

@section('content')
<p>This page needs fixed a bit, the cards shouldn't touch the sides of the page and the map should probably have a fixed height</p>
<p>Map is also completely unconnected -> to do later</p>
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Hospital</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < count($diseases); $i++)
                            <tr scope="row">
                            <td>{{ $diseases[$i]->Name }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            <div class="row justify-content-center">
                {{ $diseases->appends(request()->input())->links() }}
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <!--Google map-->
                <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
                <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <!--Google Maps-->
            </div>
        </div>
    </div>
@endsection