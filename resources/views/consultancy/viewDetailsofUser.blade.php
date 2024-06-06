@extends('base')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center mt-3 mb-3">
       <div class="border w-75 h-auto rounded border-2 p-4">
        <div>
           <h5 class="text-center ">{{$title}}
            @if(!empty($user->consultancy_id && $user->branch_id))
            {{$user->consultancy->consultancyDetails->name}} ,
            @endif
            {{$user->name}}</h5>
        </div>
    <hr>
        <div class="row col-12">
            <h6 class="text-danger">Basic Information</h6>
            <div class="col-8">
                <small>Name : {{$user->name}}</small><br>
                <small>Email : {{$user->email}}</small><br>
                <small>Role : {{$user->allUsers->name}}</small><br>
                <small>Phone : {{$user->phone}}</small><br>
                @if(!empty($user->u_district) && !empty($user->u_municipality) && !empty($user->u_ward))
                <small>Address : {{ $user->u_municipality }} - {{ $user->u_ward}} , {{ $user->u_district }}</small>
            @elseif(!empty($user->u_district) && !empty($user->u_municipality))
                <small>Address: {{ $user->u_municipality }}</small>
            @elseif(!empty($user->u_district))
                <small>Address: {{ $user->u_district }}</small>
            @else
                <small>Address: No address available.</small>
            @endif
            </div>
            <div class="col-4">
                <img src="..." class="h-25 w-25" alt="photo">
            </div>
        </div>

             <div class="row col-12"> 
                @if(!empty($user->consultancy && !$user->branch_id))
                <div class="col-6">
                    <small>Telephone number : {{$user->consultancy->telphone_num}}</small><br>
                    <small>PAN Number : {{$user->consultancy->pan_number}}</small><br>
                    <small>Head Person Name : {{$user->consultancy->head_person_fullname}}</small><br>
                    <small>Head Person Number : {{$user->consultancy->head_person_number}}</small><br>
                </div>
                @endif
               @if(!empty($user->consultancy_id && $user->branch_id))
                <div class="col-6">
                    <h6 class="mt-4 text-danger">Head Details</h6>
                    <small>Consultancy Name :<span  class="fw-bold"> {{$user->consultancy->consultancyDetails->name}}</span></small><br>
                    <small>Head Office Email : {{$user->consultancy->consultancyDetails->email}}</small><br>
                    <small>Head Office Phone : {{$user->consultancy->consultancyDetails->phone}}</small><br>
                    <small>Head Office Address : {{$user->consultancy->consultancyDetails->u_municipality}} - {{$user->consultancy->consultancyDetails->u_ward}} , {{$user->consultancy->consultancyDetails->u_district}}</small><br>
                    <small>Head Office Telephone Number :  {{$user->consultancy->telphone_num}}</small><br>
                    <small>Head office PAN : {{$user->consultancy->pan_number}}</small><br>
                    <small>Head Person Name : {{$user->consultancy->head_person_fullname}}</small><br>
                    <small>Head Person Number :  {{$user->consultancy->head_person_number}}</small><br>
                </div>
                <div class="col-6">
                    <h6 class="mt-4 text-danger">More Details</h6>
                    @foreach($user->consultancy->branch  as $branch)
                    <small>Branch PAN Number: {{$branch->branch_pan}}</small><br>
                    <small>Branch Manager Name : {{$branch->branch_manager_name}}</small><br>
                     <small>Branch Manager Number : {{$branch->branch_manager_phone}}</small><br> 
                    @endforeach

                </div>
                @endif
            </div> 
            @if($user->userBranch)

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