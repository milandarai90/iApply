@extends('base')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center mt-3 mb-1">
        <h5 class="text-danger">Consultancy Register Form</h5>
    </div>
    <div class="me-2 ms-2 d-flex justify-content-center" >
        <form action="{{route('superadmin.registerConsultancy')}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="col-4"><label for="name">Consultancy Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="consultancyName">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="email">Consultancy Email :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="consultancyEmail">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="headOfficeDistrict">Head Office District :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="headOfficeDistrict">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="headOfficeMunicipality">Head Office Municipality :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="headOfficeMunicipality">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="headOfficeWard">Head Office Ward :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="headOfficeWard">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="tel_number">Telephone Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="tel_number">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="pan_number">PAN Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" name="pan_number">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="head_person_idcard">Head Person ID Card :</label></div>
                <div class="col-8">
                    <input type="file" class="form-control form-control-sm" name="head_person_idcard">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="head_person_name">Head Person Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="head_person_name">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="head_person_number">Head Person Number :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" name="head_person_number">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="valid_documents">Valid Documents of Consultancy :</label></div>
                <div class="col-8">
                    <input type="file" class="form-control form-control-sm" name="valid_documents">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="password">Password :</label></div>
                <div class="col-8">
                    <input type="password" class="form-control form-control-sm" name="password">
                </div>
            </div>
            <div class="d-flex mt-2">
                <div class="col-4"><label for="c_password">Confirm Password :</label></div>
                <div class="col-8">
                    <input type="password" class="form-control form-control-sm" name="c_password">
                </div>
            </div>
            <div class="mt-2 mb-2 d-flex justify-content-center">
                <button type="submit" class=" w-25 text-center text-light bg-primary form-control form-control-sm ">Register</button>
            </div>
        </form>
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
    </div>
@endsection