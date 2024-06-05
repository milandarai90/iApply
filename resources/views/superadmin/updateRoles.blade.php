@extends('base')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Update a Role of 
            @if($user->role == 4 || $user->role == 2)
            {{$user->name}}
            @endif
           @if($user->role == 3)
            {{$user->name}} , {{$user->consultancy->consultancyDetails->name}}
            @endif
        </h5>
    </div>
        <div class="mt-2 mb-2" >
            @if(Session::has('success'))
            <div class="form-control align-items-center" id="sessionSuccess" style="background-color: rgb(64, 193, 44)">
             <p class="text-small text-center text-light align-items-center">{{session::get('success')}}</p>
            </div>
             @endif
             @if(Session::has('fail'))
             <div class="form-control align-items-center" id="sessionFail" style="background-color: rgb(233, 6, 6)">
              <p class="text-small text-center text-light align-items-center">{{session::get('fail')}}</p>
             </div>
              @endif
        </div>
    <div class="me-2 ms-2 d-flex justify-content-center" >
        <form action="{{route('superadmin.submitRoles')}}?id={{$token}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%">
            @csrf
            <div class="d-flex">
                <div class="col-4 p-1"><label for="roles">Select a Role :</label></div>
                <div class="col-8">
                    <select class="form-select form-select-sm" aria-label="select roles" name="roles" required>
                        <option selected disabled value="{{$user->role}}">{{$user->allUsers->name}}</option>
                       @foreach ($roles as $item)
                        <option value="{{$item->id}}" class="text-danger">{{$item->name}}
                        </option>
                        @endforeach
                      </select>
                    <div class="mt-1">
                        @error('roles')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                       </div>
                </div>
            </div>
            <div class="mt-2 mb-2 d-flex justify-content-center">
                <button type="submit" class=" w-25 text-center text-light bg-success form-control form-control-sm ">Save</button>
            </div>
        </form>
        </div>
</div>
@endsection