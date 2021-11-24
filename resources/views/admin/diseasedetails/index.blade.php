@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('admin.disease-details.create') }}" class="btn btn-primary pull-right">Add Disease detail</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> Disease</th>
                            <th> Description </th>
                            <th> Symptoms</th>
                            <th> Mode of Transmission</th>
                            <th> Control</th>
                            <th> Created By </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($diseasedetails as $diseasedetail)
                            <tr>
                                <td>{{ $diseasedetail->name }}</td>
                                <td>{{ $diseasedetail->description }}</td>
                                <td>{{ $diseasedetail->symptoms }}</td>
                                <td>{{ $diseasedetail->mode_of_transmission }}</td>
                                <td>{{ $diseasedetail->control }}</td>
                                <td>{{auth()->user()->name}}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.disease-details.edit', $diseasedetail->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush