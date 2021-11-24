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
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.disease-details.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                    <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        placeholder="Enter disease name"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                    />
                                </div>
                    </div>
                    <div class="form-group">
                                    <label class="control-label" for="user_id">User Id</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="user_id"
                                        name="user_id"
                                        value="{{ auth()->user()->id }}"
                                        readonly
                                    />
                                </div>
                    <div class="tile-body">
                        <div class="form-group">
                                <label class="control-label" for="description">Description</label>
                                <textarea class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror  
                        </div>
                    </div>


                    <div class="tile-body">
                        <div class="form-group">
                                <label class="control-label" for="symptoms">Symptoms</label>
                                <textarea class="form-control" rows="4" name="symptoms" id="symptoms">{{ old('symptoms') }}</textarea>
                                @error('symptoms') <span class="text-danger">{{ $message }}</span> @enderror  
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                                <label class="control-label" for="mode_of_transmission">Mode of Transmission</label>
                                <textarea class="form-control" rows="4" name="mode_of_transmission" id="mode_of_transmission">{{ old('mode_of_transmission') }}</textarea>
                                @error('mode_of_transmission') <span class="text-danger">{{ $message }}</span> @enderror  
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                                <label class="control-label" for="control">Control</label>
                                <textarea class="form-control" rows="4" name="control" id="control">{{ old('control') }}</textarea>
                                @error('control') <span class="text-danger">{{ $message }}</span> @enderror  
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save disease detail</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.disease-details.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection