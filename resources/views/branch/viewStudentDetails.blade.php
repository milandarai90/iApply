@extends('base')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center mt-3 mb-3">
       <div class="border w-75 h-auto rounded border-2 p-4">
        <div>
           <h5 class="text-center ">{{$students->name}}</h5>
        </div>
    <hr>
        <div class="row col-12">
            <h6 class="text-danger">Basic Information</h6>
            <div class="col-8">
                <small>Name : {{$students->name}}</small><br>
                <small>Email : {{$students->email}}</small><br>
                <small>Role : {{$students->allUsers->name}}</small><br>
                <small>Phone : {{$students->phone}}</small><br>
                @if(!empty($students->u_district) && !empty($students->u_municipality) && !empty($students->u_ward))
                <small>Address : {{ $students->u_municipality }} - {{ $students->u_ward}} , {{ $students->u_district }}</small>
            @elseif(!empty($students->u_district) && !empty($students->u_municipality))
                <small>Address: {{ $students->u_municipality }}</small>
            @elseif(!empty($students->u_district))
                <small>Address: {{ $students->u_district }}</small>
            @else
                <small>Address: No address available.</small>
            @endif
            </div>
            <div class="col-4">
                <img src="..." class="h-25 w-25" alt="photo">
            </div>
        </div>

             <div class="row col-12"> 
                @if(!empty($students->consultancy && !$students->branch_id))
                <div class="col-6">
                    <small>Telephone number : {{$students->consultancy->telphone_num}}</small><br>
                    <small>PAN Number : {{$students->consultancy->pan_number}}</small><br>
                    <small>Head Person Name : {{$students->consultancy->head_person_fullname}}</small><br>
                    <small>Head Person Number : {{$students->consultancy->head_person_number}}</small><br>
                </div>
                @endif
               @if(!empty($students->consultancy_id && $students->branch_id))
                <div class="col-6">
                    <h6 class="mt-4 text-danger">Head Details</h6>
                    <small>Consultancy Name :<span  class="fw-bold"> {{$students->consultancy->consultancyDetails->name}}</span></small><br>
                    <small>Head Office Email : {{$students->consultancy->consultancyDetails->email}}</small><br>
                    <small>Head Office Phone : {{$students->consultancy->consultancyDetails->phone}}</small><br>
                    <small>Head Office Address : {{$students->consultancy->consultancyDetails->u_municipality}} - {{$students->consultancy->consultancyDetails->u_ward}} , {{$students->consultancy->consultancyDetails->u_district}}</small><br>
                    <small>Head Office Telephone Number :  {{$students->consultancy->telphone_num}}</small><br>
                    <small>Head office PAN : {{$students->consultancy->pan_number}}</small><br>
                    <small>Head Person Name : {{$students->consultancy->head_person_fullname}}</small><br>
                    <small>Head Person Number :  {{$students->consultancy->head_person_number}}</small><br>
                </div>
                <div class="col-6">
                    <h6 class="mt-4 text-danger">More Details</h6>
                    @foreach($students->consultancy->branch  as $branch)
                    <small>Branch PAN Number: {{$branch->branch_pan}}</small><br>
                    <small>Branch Manager Name : {{$branch->branch_manager_name}}</small><br>
                     <small>Branch Manager Number : {{$branch->branch_manager_phone}}</small><br> 
                    @endforeach

                </div>
                @endif
            </div> 
            @if($students->userBranch)

        <hr>
        <h6 class="text-center ">Branch Documents</h6>
        <hr>
        <div class="col-12 d-flex">
            <div class="col-6">
                <h6 class="text-center text-danger">Valid document of Branch</h6>
                <div  class="d-flex justify-content-center">
                    <img src="{{asset('storage/' . $user->userBranch->branch_valid_document)}}" style="width:90%" alt="...">
                </div>
            </div>
            <div class="col-6">
                <h6 class="text-center text-danger">Branch Head Id card</h6>
                <div  class="d-flex justify-content-center">
                    <img src="{{asset('storage/' . $user->userBranch->branch_manager_idcard)}}" style="width:90%" alt="...">
                </div>
            </div>           
        </div>
        @endif
    </div>
        <div>

        </div>
       </div>
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
           document.getElementById('consultancyViewBranch').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");</script>
@endsection