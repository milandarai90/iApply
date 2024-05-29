@extends('base')
@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Consultancy Register Form</h5>
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
        <form action="{{route('superadmin.registerConsultancy')}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="col-4"><label for="consultancyName">Consultancy Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="consultancyName" required>
                    <div class="mt-1">
                        @error('consultancyName')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                       </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="email">Consultancy Email :</label></div>
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
                <div class="col-4"><label for="headOfficeDistrict">Head Office District :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="headOfficeDistrict" required>
                    <div class="mt-1"> 
                        @error('headOfficeDistrict')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror</div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="headOfficeMunicipality">Head Office Municipality :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="headOfficeMunicipality" required>
                    <div class="mt-1">
                        @error('headOfficeMunicipality')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="headOfficeWard">Head Office Ward :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="headOfficeWard" required>
                    <div class="mt-1">
                        @error('headOfficeWard')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="phone">Mobile Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="phone" required>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="tel_number">Telephone Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="tel_number" required>
                    <div class="mt-1">
                        @error('tel_number')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="pan_number">PAN Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="pan_number" required>
                    <div class="mt-1">
                        @error('pan_number')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="head_person_idcard">Head Person ID Card :</label></div>
                <div class="col-8">
                    <input type="file" class="form-control form-control-sm" name="head_person_idcard" required>
                    <div class="mt-1">
                        @error('head_person_idcard')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="head_person_name">Head Person Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="head_person_name" required>
                    <div class="mt-1">
                        @error('head_person_name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="head_person_number">Head Person Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="head_person_number" required>
                    <div class="mt-1">
                        @error('head_person_number')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="valid_documents">Valid Documents of Consultancy :</label></div>
                <div class="col-8">
                    <input type="file" class="form-control form-control-sm" name="valid_documents" required>
                    <div class="mt-1">
                        @error('valid_documents')
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

           document.getElementById('add').classList.add("menu-open");
           document.getElementById('addConsultancy').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
    </script>
@endsection