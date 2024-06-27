@extends('base')
@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Student Registration</h5>
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
        <form action="" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex mt-2">
                <div class="col-4"><label for="studentName">Student Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="studentName" required>
                    <div class="mt-1">
                        @error('studentName')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="email">Student Email :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="email" required>
                    <div class="mt-1">
                        @error('email')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="phone">Student Phone :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="phone" required>
                    <div class="mt-1">
                        @error('phone')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="u_district">Student District:</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="u_district" >
                    <div class="mt-1">
                        @error('u_district')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="u_muncipality">Student Muncipality:</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="u_municipality" >
                    <div class="mt-1">
                        @error('u_muncipality')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="u_ward">Student Ward:</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="u_ward">
                    <div class="mt-1">
                        @error('u_ward')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="joining_date">Joining date:</label></div>
                <div class="col-8">
                    <input type="date" class="form-control form-control-sm" name="joining_date" required>
                    <div class="mt-1">
                        @error('joining_date')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>       

            <div class="d-flex mt-2">
                <div class="col-4"><label for="classes">Status:</label></div>
                <div class="col-8">
                    <select class="form-select form-select-sm" aria-label="select consultancy" name="status">
                        <option selected disabled>Select the class.</option>
                        <option value="booked" class="text-danger">Booked</option>
                        <option value="joined" class="text-danger">Joined</option>
                      </select>
                    <div class="mt-1">
                        @error('classes')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                       </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="password">Password :</label></div>
                <div class="col-8">
                    <input type="password" class="form-control form-control-sm" name="password" required>
                    <div class="mt-1">
                        @error('password')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="password">Confirm password :</label></div>
                <div class="col-8">
                    <input type="password" class="form-control form-control-sm" name="c_password" required>
                    <div class="mt-1">
                        @error('password')
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

           document.getElementById('class').classList.add("menu-open");
           document.getElementById('viewClasses').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
    </script>
@endsection