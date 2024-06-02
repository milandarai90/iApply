@extends('base')
@section('content')
<div class="container">
    <div class="d-flex justify-content-center mt-3 mb-3">
       <div class="border w-75 h-auto rounded border-2 p-4">
        <div>
           <h5 class="text-center ">{{$title}} {{$findTokenUser->name}}</h5>
        </div>
    <hr>
        <div class="row col-12">
            <h6 class="text-danger">Basic Information</h6>
            <div class="col-8">
                <small>Name : {{$findTokenUser->name}}</small><br>
                <small>Email : {{$findTokenUser->email}}</small><br>
                <small>Role : {{$findTokenUser->allUsers->name}}</small><br>
                <small>Phone : {{$findTokenUser->phone}}</small><br>
                @if(!empty($findTokenUser->u_district) && !empty($findTokenUser->u_municipality) && !empty($findTokenUser->u_ward))
                <small>Address : {{ $findTokenUser->u_municipality }} - {{ $findTokenUser->u_ward}} , {{ $findTokenUser->u_district }}</small>
            @elseif(!empty($findTokenUser->u_district) && !empty($findTokenUser->u_municipality))
                <small>Address: {{ $findTokenUser->u_municipality }}</small>
            @elseif(!empty($findTokenUser->u_district))
                <small>Address: {{ $findTokenUser->u_district }}</small>
            @else
                <small>No address available.</small>
            @endif
            </div>
            <div class="col-4">
                <img src="..." class="h-25 w-25" alt="photo">
            </div>
        </div>

             <div class="row col-12"> 
                @if(!empty($findTokenUser->consultancy && !$findTokenUser->branch_id))
                <div class="col-6">
                    <small>Telephone number : {{$findTokenUser->consultancy->telphone_num}}</small><br>
                    <small>PAN Number : {{$findTokenUser->consultancy->pan_number}}</small><br>
                    <small>Head Person Name : {{$findTokenUser->consultancy->head_person_fullname}}</small><br>
                    <small>Head Person Number : {{$findTokenUser->consultancy->head_person_number}}</small><br>
                </div>
                @endif
               @if(!empty($findTokenUser->consultancy_id && $findTokenUser->branch_id))
                <div class="col-6">
                    <h6 class="mt-4 text-danger">Head Details</h6>
                    <small>Consultancy Name :<span  class="fw-bold"> {{$findTokenUser->consultancy->consultancyDetails->name}}</span></small><br>
                    <small>Head Office Email : {{$findTokenUser->consultancy->consultancyDetails->email}}</small><br>
                    <small>Head Office Phone : {{$findTokenUser->consultancy->consultancyDetails->phone}}</small><br>
                    <small>Head Office Address : {{$findTokenUser->consultancy->consultancyDetails->u_municipality}} - {{$findTokenUser->consultancy->consultancyDetails->u_ward}} , {{$findTokenUser->consultancy->consultancyDetails->u_district}}</small><br>
                    <small>Head office PAN : {{$findTokenUser->consultancy->consultancyDetails->pan_number}}</small><br>
                    <small>Head Person Name : {{$findTokenUser->consultancy->consultancyDetails->head_person_fullname}}</small><br>
                    <small>Head Person Number :  {{$findTokenUser->consultancy->consultancyDetails->head_person_number}}</small><br>
                </div>
                <div class="col-6">
                    <h6 class="mt-4 text-danger">More Details</h6>
                    @foreach($findTokenUser->consultancy->branch  as $branch)
                    <small>Branch PAN Number: {{$branch->branch_pan}}</small><br>
                    <small>Branch Manager Name : {{$branch->branch_manager_name}}</small><br>
                     <small>Branch Manager Number : {{$branch->branch_manager_phone}}</small><br> 
                    @endforeach

                </div>
                @endif
            </div> 
        @if($findTokenUser->consultancy)
<hr>
        <h6 class="text-center ">Consultancy Documents</h6>
        <hr>
        <div class="col-12 d-flex">
            <div class="col-6">
                <h6 class="text-center text-danger">Valid document</h6>
                <div class="d-flex justify-content-center">
                    <img src="{{asset('storage/' . $findTokenUser->consultancy->valid_document)}}" alt="..." style="width:90%">
                </div>
            </div>
            <div class="col-6">
                <h6 class="text-center text-danger">Head Person Id card</h6>
                <div class="d-flex justify-content-center">
                    <img src="{{asset('storage/' . $findTokenUser->consultancy->head_person_idcard)}}"  alt="..." style="width:90%">
                </div>
            </div>
            
        </div>
@endif
@if($findTokenUser->userBranch)

        <hr>
        <h6 class="text-center ">Branch Documents</h6>
        <hr>
        <div class="col-12 d-flex">
            <div class="col-6">
                <h6 class="text-center text-danger">Valid document of Branch</h6>
                <div  class="d-flex justify-content-center">
                    <img src="{{asset('storage/' . $findTokenUser->userBranch->branch_valid_document)}}" style="width:90%" alt="...">
                </div>
            </div>
            <div class="col-6">
                <h6 class="text-center text-danger">Branch Head Id card</h6>
                <div  class="d-flex justify-content-center">
                    <img src="{{asset('storage/' . $findTokenUser->userBranch->branch_manager_idcard)}}" style="width:90%" alt="...">
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

       document.getElementById('users').classList.add("menu-open");
       document.getElementById('viewUsers').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
</script>
@endsection