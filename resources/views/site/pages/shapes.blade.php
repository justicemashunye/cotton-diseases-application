@extends('site.app')
@section('title', 'Shapes')

@section('content')    
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-6 text-center" style="margin-top:50px;margin-bottom:50px ">
            <h2> Select the shape displayed by the Disease </h2>
            <div class="card my-4">
              <div class="card-body ">
              <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                              <tr>
                                <th> Shape Id </th>
                              </tr>
                          </thead>
                          <tbody>
                  @forelse ($shapes as $shape)
                      <tr>
                        {{$shape->shape_id}}
                      </tr>
                  @empty
                  <div>
                      <p>You have no shapes yet</p>
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