@extends('base')
@section('content')

@if($bookingData->count()>0)
    <div class="container">
        <form action="">
            <button class="mt-2 mb-2 float-end border border-none" style="font-size:18px; border-radius:20% "><i class="bi bi-search"></i></button>
            <input type="search" name="search" id="search" placeholder="search" class="text-center form-control form-control-sm w-25 mt-2 float-end mb-2">
        </form>
        <div id="table">
            <table class="text-center table table-bordered table-hover mt-2">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th>Classroom</th>
                    <th>Action</th>
                </tr>
                    @foreach ($bookingData as $index => $item)
                <tr>
                    <td>{{$index+1}}</td>
                    <td class="text-danger">{{$item->bookingRequestToUser->name}}</td>
                    @if($item->bookingRequestToUser->u_municipality && $item->bookingRequestToUser->u_ward && $item->bookingRequestToUser->u_district)
                    <td>{{$item->bookingRequestToUser->u_municipality}}-{{$item->bookingRequestToUser->u_ward}},{{$item->bookingRequestToUser->u_district}}</td>
                    @else
                    <td>
                        null
                    </td>
                    @endif
                    <td>{{$item->bookingRequestToUser->email}}</td>
                    @if($item->bookingRequestToUser->phone)
                    <td>{{$item->bookingRequestToUser->phone}}</td>
                    @else
                    <td>null</td>
                    @endif
                    <td>{{$item->bookingRequest_to_course->course}}</td>
                    <td>{{$item->bookingRequest_to_classroom->class_name}}</td>
                    <td>
                    <a href="{{route('branch.rejectedBookingRequest')}}?id={{$item->id}}"><span class="text-danger me-1">Reject</span></a>
                    <a href="{{route('branch.acceptBookingRequest')}}?id={{$item->id}}"> <span class="text-primary">Accept</span></a>
                    </td>
                </tr>
                    @endforeach
            </table>
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
    </div>
@else
    <div class="container">
        <div class="mt-3 d-flex justify-content-center">
            <h5 class="text-danger">No Request is here.</h5>
        </div>
    </div>

@endif
    <style>
        #table{
            font-size: 13px;
        }
    </style>
       <script>
        setTimeout(function () {
            document.getElementById("sessionSuccess").style.display = "none";
            }, 3000); 

        setTimeout(function () {
            document.getElementById("sessionFail").style.display = "none";
            }, 3000); 

            document.getElementById('requests').classList.add("menu-open");
               document.getElementById('bookingRequests').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
 </script>

@endsection