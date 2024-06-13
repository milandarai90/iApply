@extends('base')
@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Add Classes</h5>
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
        <form action="{{route('branch.postClass')}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex mt-2">
                <div class="col-4"><label for="class_name">Class Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="class_name" required>
                    <div class="mt-1">
                        @error('class_name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="seats_number">Numbers of available seats :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="seats_number" required>
                    <div class="mt-1"> 
                        @error('seats_number')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror</div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="starting_time">Class start time :</label></div>
                <div class="col-8">
                    <input type="time" class="form-control form-control-sm" name="starting_time" required>
                    <div class="mt-1">
                        @error('starting_time')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="ending_time">Class ending time :</label></div>
                <div class="col-8">
                    <input type="time" class="form-control form-control-sm" name="ending_time" required>
                    <div class="mt-1">
                        @error('ending_time')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="starting_date">Class start date :</label></div>
                <div class="col-8">
                    <input type="date" class="form-control form-control-sm" name="starting_date" required>
                    <div class="mt-1">
                        @error('starting_date')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="ending_date">Class end date :</label></div>
                <div class="col-8">
                    <input type="date" class="form-control form-control-sm" name="ending_date" required>
                    <div class="mt-1">
                        @error('ending_date')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="mt-2 mb-2 d-flex justify-content-center">
                <button type="submit" class=" w-25 text-center text-light bg-primary form-control form-control-sm ">Register</button>
            </div>
        </form>
    </div>
    </div>
    <script>
        setTimeout(function () {
            document.getElementById("sessionSuccess").style.display = "none";
            }, 3000); 

        setTimeout(function () {
            document.getElementById("sessionFail").style.display = "none";
            }, 3000); 

           document.getElementById('consultancyBranch').classList.add("menu-open");
           document.getElementById('consultancyAddBranch').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
    </script>
@endsection