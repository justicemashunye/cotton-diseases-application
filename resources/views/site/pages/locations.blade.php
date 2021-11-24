@extends('site.app')
@section('title', 'Locations')

@section('content')    
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-6 text-center" style="margin-top:50px;margin-bottom:50px ">
            <h2> Select the location affected</h2>
            <div class="card my-4">
              <div class="card-body ">
              <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                              <tr>
                                <th> Location </th>
                                <th>Similar Image </th>
                                <tbody>
                              @forelse ($locations as $location)
                              <tr>
                                <td><a href="{{ route('site.shapes', $location->location_id) }}" >{{$location->location->name}}</a></td>
                                <td><a href="{{route('site.shapes', $location->location_id)}}" ><img class="rounded" src="{{ asset('storage/'.$location->location->image) }}" alt="{{<?php echo $location->location->name;?>}}" style="width: 200px; height: auto;" ></a>
                              @empty
                              <div>
                                  <p>Couldnt find anything from the search</p>
                              </div>
                              @endforelse
                              </tr>
                          <tbody>
                          </tbody>
              </table>
              </div>
          </div>
          </div>
      </div>
  </div>


@stop