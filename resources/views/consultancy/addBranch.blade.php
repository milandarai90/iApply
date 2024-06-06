@extends('base')
@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Branch Registration</h5>
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
        <form action="{{route('consultancy.postBranch')}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchName">Branch Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="branchName" required>
                    <div class="mt-1">
                        @error('branchName')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchPhone">Branch Contact :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="branchPhone" required>
                    <div class="mt-1"> 
                        @error('branchPhone')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror</div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="email">Branch Email :</label></div>
                <div class="col-8">
                    <input type="email" class="form-control form-control-sm" name="email" required>
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
                <div class="col-4"><label for="branchDistrict">Branch District :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="branchDistrict" required>
                    <div class="mt-1">
                        @error('branchDistrict')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchMunicipality">Branch Municipality :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="branchMunicipality" required>
                    <div class="mt-1">
                        @error('branchMunicipality')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchWard">Branch Ward :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="branchWard" required>
                    <div class="mt-1">
                        @error('branchWard')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchPan">Branch PAN Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="branchPan" required>
                    <div class="mt-1">
                        @error('branchPan')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchManager">Branch Manager Name:</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="branchManager" required>
                    <div class="mt-1">
                        @error('branchManager')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchManagerIdcard">Branch Manager Id card :</label></div>
                <div class="col-8">
                    <input type="file" class="form-control form-control-sm" name="branchManagerIdcard" required>
                    <div class="mt-1">
                        @error('branchManagerIdcard')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchManagerPhone">Branch Manager Contact :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="branchManagerPhone" required>
                    <div class="mt-1">
                        @error('branchManagerPhone')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchValidDocument">Valid Documents of Branch :</label></div>
                <div class="col-8">
                    <input type="file" class="form-control form-control-sm" name="branchValidDocument" required>
                    <div class="mt-1">
                        @error('branchValidDocument')
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
                <div class="col-4"><label for="c_password">Confirm Password :</label></div>
                <div class="col-8">
                    <input type="password" class="form-control form-control-sm" name="c_password" required>
                    <div class="mt-1">
                        @error('c_password')
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