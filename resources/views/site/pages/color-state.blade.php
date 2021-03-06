@extends('site.app')
@section('title', 'Color-states')

@section('content')    
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-6 text-center" style="margin-top:50px;margin-bottom:50px ">
            <h2> Select the color-state you see from the plant</h2>
            <div class="card my-4">
              <div class="card-body ">
              <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                              <tr>
                                <th>Description </th>
                              </tr>
                          </thead>
                          <tbody>
                    @forelse ($colorstates as $colorstate)
                        <tr>
                        <td><a href="{{ route('site.diseases', $colorstate->color_state_id) }}" >{{$colorstate->colorstate->description}}</a></td></a></td>
                     @empty
                        <div>
                            <p>No disease found,please go <a href="{{ route('home')}}"> back </a>and try again</p>
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