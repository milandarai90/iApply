@extends('base')
@section('content')
{{-- for consultancy --}}
@if($findTokenUser->role == 2)
<div class="container mb-5">

    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">{{$consultancyTitle}}</h5>
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
        <form action="{{route('superadmin.updateConsultancy')}}?id={{$token}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="col-4"><label for="consultancyName">Consultancy Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->consultancyDetails->name}}" name="consultancyName" required>
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
                <div class="col-4"><label for="headOfficeDistrict">Head Office District :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->consultancyDetails->u_district}}" name="headOfficeDistrict" required>
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
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->consultancyDetails->u_municipality}}" name="headOfficeMunicipality" required>
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
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->consultancyDetails->u_ward}}" name="headOfficeWard" required>
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
                    <input type="number" class="form-control form-control-sm" name="phone" value="{{$findTokenUser->consultancy->consultancyDetails->phone}}" required>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="tel_number">Telephone Number :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->telphone_num}}" name="tel_number" required>
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
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->pan_number}}" name="pan_number" required>
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
                <div class="col-4"><label for="head_person_name">Head Person Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->head_person_fullname}}" name="head_person_name" required>
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
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser->consultancy->head_person_number}}" name="head_person_number" required>
                    <div class="mt-1">
                        @error('head_person_number')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-2 mb-2 d-flex justify-content-center">
                <button type="submit" class=" w-25 text-center text-light bg-primary form-control form-control-sm ">Save</button>
            </div>
        </form>
    </div>
</div>
@endif

 {{-- branch --}}

@if($findTokenUser->role == 3)
 <div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">{{$branchTitle}}</h5>
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
        <form action="{{route('superadmin.updateBranch')}}?id={{$token}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="col-4"><label for="consultancyName">Consultancy Name :</label></div>
                <div class="col-8">
                    <select class="form-select form-select-sm" aria-label="select consultancy" name="consultancyName">
                        <option value="{{$findTokenUser->consultancy_id}}" selected disabled>{{$findTokenUser->consultancy->consultancyDetails->name}}</option>
                        @foreach ($consultancyDatas as $item)
                        <option value="{{$item->consultancy_id}}" class="text-danger">{{$item->name}}
                        </option>
                        @endforeach
                   
                      </select>
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
                <div class="col-4"><label for="branchName">Branch Name :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser->userBranch->userBranch->name}}" name="branchName" required>
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
                    <input type="number" value="{{$findTokenUser ->userBranch->userBranch->phone}}" class="form-control form-control-sm" name="branchPhone" required>
                    <div class="mt-1"> 
                        @error('branchPhone')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror</div>
                </div>
            </div>
           
            <div class="d-flex mt-2">
                <div class="col-4"><label for="branchDistrict">Branch District :</label></div>
                <div class="col-8">
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser ->u_district}}" name="branchDistrict" required>
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
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser ->u_municipality}}" name="branchMunicipality" required>
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
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser ->u_ward}}" name="branchWard" required>
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
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser ->userBranch->branch_pan}}" name="branchPan" required>
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
                    <input type="text" class="form-control form-control-sm" value="{{$findTokenUser ->userBranch->branch_manager_name}}" name="branchManager" required>
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
                <div class="col-4"><label for="branchManagerPhone">Branch Manager Contact :</label></div>
                <div class="col-8">
                    <input type="number" class="form-control form-control-sm" value="{{$findTokenUser ->userBranch->branch_manager_phone}}" name="branchManagerPhone" required>
                    <div class="mt-1">
                        @error('branchManagerPhone')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-2 mb-2 d-flex justify-content-center">
                <button type="submit" class=" w-25 text-center text-light bg-primary form-control form-control-sm ">Save</button>
            </div>
        </form>
    </div>
    </div>
    @endif
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