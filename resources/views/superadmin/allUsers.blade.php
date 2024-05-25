@extends('base')
@section('content')
    <div id="table">
        <table class="text-center table table-bordered table-hover mt-2">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Address</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            
                @foreach ($userData as $index => $item)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$item -> name}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->allUsers->name}}<a href="" class="ms-1">manage </a></td>
                <td >
                <a href=""><span class="text-danger me-1">Delete</span></a>
                <a href=""> <span class="text-primary">Edit</span></a>
                </td>
            </tr>
                @endforeach
               
           
        </table>
    </div>
    <style>
        #table{
            font-size: 13px;
        }
    </style>

@endsection