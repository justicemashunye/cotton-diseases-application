@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title text-primary">{{ $subTitle }}</h3>
                <form action="{{ route('admin.diseases.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">   
                        <div class="col-md-6">
                            <div class="form-group my-5" style="margin-left:0px;">
                                <label class="control-label" for="disease_detail_id">Disease</label>
                                <select name="disease_detail_id" id="disease_detail_id" class="form-control @error('disease_detail_id') is-invalid @enderror">
                                    <option value="0">Select Disease</option>
                                        @foreach($diseasedetails as $disease_detail)
                                            <option value="{{ $disease_detail->id }}">{{ $disease_detail->name }}</option>
                                        @endforeach
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('disease_detail_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-5" style="margin-left:0px;">
                                <label class="control-label" for="stage_id">Stage</label>
                                <select name="stage_id" id="stage_id" class="form-control @error('stage_id') is-invalid @enderror">
                                    <option value="0">Select a Stage</option>
                                        @foreach($stages as $stage)
                                            <option value="{{$stage->id }}">{{$stage->name }}</option>
                                        @endforeach
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('stage_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-5" style="margin-left:0px;">
                                <label class="control-label" for="location_id">Location</label>
                                <select name="location_id" id="location_id" class="form-control @error('location_id') is-invalid @enderror">
                                    <option value="0">Select location</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id }}">{{ $location->name }}</option>
                                        @endforeach
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('location_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-5" style="margin-left:0px;">
                                <label class="control-label" for="shape_id">Shape</label>
                                <select name="shape_id" id="shape_id" class="form-control @error('shape_id') is-invalid @enderror">
                                    <option value="0">Select a Shape</option>
                                        @foreach($shapes as $shape)
                                            <option value="{{ $shape->id }}">{{ $shape->description }}</option>
                                        @endforeach
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('shape_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-5" style="margin-left:0px;">
                                <label class="control-label" for="color_id">Color</label>
                                <select name="color_id" id="color_id" class="form-control @error('color_id') is-invalid @enderror">
                                    <option value="0">Select a color</option>
                                        @foreach($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('color_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-5" style="margin-left:0px;">
                                <label class="control-label" for="color_state_id">Color State</label>
                                <select name="color_state_id" id="color_state_id" class="form-control @error('color_state_id') is-invalid @enderror">
                                    <option value="0">Select  color state</option>
                                        @foreach($colorstates as $color_state)
                                            <option value="{{ $color_state->id }}">{{ $color_state->description }}</option>
                                        @endforeach
                                    </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('color_state_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                    <label class="control-label" for="user_id">User Id</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="user_id"
                                        name="user_id"
                                        value="{{auth()->user()->id }}"
                                        readonly
                                    />
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Disease</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="/admin/disease "><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection