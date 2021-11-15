@extends('site.app')
@section('title', 'Colors')

@section('content')    
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-6 text-center" style="margin-top:50px;margin-bottom:50px ">
            <h2> Select the color displayed the plant </h2>
            <div class="card my-4">
              <div class="card-body ">
              <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                              <tr>
                                <th> Description </th>
                              </tr>
                          </thead>
                          <tbody>
                  @forelse ($colors as $color)
                      <tr>
                          <td><a href="{{ route('site.color-states', $color->id) }}" >{{$color->name}}</a></td>
                      </tr>
                  @empty
                  <div>
                      <p>You have no colors yet</p>
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