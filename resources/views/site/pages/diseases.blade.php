@extends('site.app')
@section('title', 'Diseases')

@section('content')    
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-6 text-center" style="margin-top:50px;margin-bottom:50px ">
            <h2> The system suggest this disease</h2>
            <div class="card my-4">
                     <div class="card-body ">
                        
                     @if($disease)
                        <div class="my-4"><h2 class="text-primary">{{$disease->name}}</h2></div>
                              <h3>Description</h3>
                        <div class="my-4">{{$disease->description}}</div>
                                    <h3>Symptons</h3>
                        <div class="my-4">{{$disease->symptoms}}</div>
                          <h3>Mode of Transmission</h3>
                        <div class="my-4">{{$disease->mode_of_transmission}}</div>
                          <h3>Control</h3>
                        <div class="my-4">{{$disease->control}}</div>
                      @else
                      <p>Search returned empty result please try again</p>
                      @endif
                  </div>
                </div>
                  
          
      </div>
          </div>
      </div>
  </div>
@stop