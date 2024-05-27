@extends('base')
@section('content')

<div class="container">
    <form action="">
        <button class="mt-2 mb-2 float-end border border-none" style="font-size:18px; border-radius:20% "><i class="bi bi-search"></i></button>
        <input type="search" name="search" id="search" placeholder="search" class="text-center form-control form-control-sm w-25 mt-2 float-end mb-2">
    </form>
    <div id="table">
        <table class="text-center table table-bordered table-hover mt-2">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Address</th>
                <th>Role</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
            
                @foreach ($userData as $index => $item)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$item -> name}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->allUsers->name}}<a href="" class="ms-1">manage </a></td>
                <td><a href="">view</a></td>
                <td >
                <a href="{{route('superadmin.delete')}}?id={{$item->id}}"><span class="text-danger me-1">Delete</span></a>
                <a href=""> <span class="text-primary">Edit</span></a>
                </td>
            </tr>
                @endforeach
        </table>
    </div>
    <div class="mt-2 mb-2" >
        @if(Session::has('success'))
        <div class="form-control align-items-center" id="sessionSuccess" style="background-color: rgb(51, 198, 28)">
         <p class="text-small text-center text-light align-items-center">{{session::get('success')}}</p>
        </div>
         @endif
         @if(Session::has('fail'))
         <div class="form-control align-items-center" id="sessionFail" style="background-color: rgb(233, 6, 6)">
          <p class="text-small text-center text-light align-items-center">{{session::get('fail')}}</p>
         </div>
          @endif
    </div>
</div>
    <style>
        #table{
            font-size: 13px;
        }
    </style>
       <script>
        setTimeout(function () {
            document.getElementById("sessionSuccess").style.display = "none";
            }, 3000); 

        setTimeout(function () {
            document.getElementById("sessionFail").style.display = "none";
            }, 3000); 

           document.getElementById('users').classList.add("menu-open");
           document.getElementById('viewUsers').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
 </script>

@endsection