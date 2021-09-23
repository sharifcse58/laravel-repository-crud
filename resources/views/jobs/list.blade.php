@extends('jobs.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Jobs List</h2>
            </div>
        </div>
    </div>
   
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Details</th>
        </tr>
        
        @foreach ($jobs_lists as $job)
        <tr>
            <td>{{ ++$i }}</td> 
            <td>{{ $job->title }}</td>
            <td><img src="{{ asset('storage/'.$job->image) }}" width="100px"></td>
            <td>{{ $job->description }}</td>
        </tr>
        @endforeach
    </table>
  
@endsection