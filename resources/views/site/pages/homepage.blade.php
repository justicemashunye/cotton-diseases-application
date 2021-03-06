@extends('site.app')
@section('title', 'Homepage')

@section('content')    
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-6 text-center" style="margin-top:50px;margin-bottom:50px ">
            <h2>Select the stage affected</h2>
            <div class="card my-4">
              <div class="card-body ">
              <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                              <tr>
                                <th> Name of Stage</th>
                                <th>Similar Image </th>
                              </tr>
                          </thead>
                          <tbody>
                  @forelse ($stages as $stage)
                      <tr>
                        <td><a href="{{ route('site.locations', $stage->id) }}" >{{$stage->name}}</a></td>
                        <td><a href="{{ route('site.locations', $stage->id) }}" ><img class="rounded" src="{{ asset('storage/'.$stage->image) }}" alt="{{<?php echo $stage->name;?>}}" style="width: 200px; height: auto;" ></a>
                      </tr>
                  @empty
                  <div>
                      <p>You have no stages yet</p>
                  </div>
                  @endforelse
                  </tbody>
              </table>
              </div>
          </div>
          </div>
      </div>
  </div>


@stop