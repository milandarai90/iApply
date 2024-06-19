@extends('base')
@section('content')

@if(count($classes)>0)
    <div class="container">
        {{-- <form action="">
            <button class="mt-2 mb-2 float-end border border-none" style="font-size:18px; border-radius:20% "><i class="bi bi-search"></i></button>
            <input type="search" name="search" id="search" placeholder="search" class="text-center form-control form-control-sm w-25 mt-2 float-end mb-2">
        </form> --}}
        {{-- @dd($classes) --}}
        <div id="viewClass" class="d-flex mt-3">
            @foreach($classes as $item)
            <div class="col-3 border border-2 border-danger text-light me-2 p-2 " id="showClass">
                <h4 class="fw-bolder text-center">{{$item->class_name}}</h4>
                <hr>
                <div>
                    <span >Time :  {{$item->starting_time}} - {{$item->ending_time}}</span>
                </div>
                <div>
                    <span >Date :  {{$item->starting_date}} - {{$item->ending_date}}</span> 
                </div>
                <div>
                    <span >Students : /{{$item->seats_number}}</span>
                </div>
                <div>
                 <span> Status : </span><small >{{$item->status}}</small>
                </div>
            <hr>
            <div class="d-flex justify-content-center">
                <a href="">more info</a>
            </div>
            </div>
           @endforeach
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
            <h5 class="text-danger">No data available</h5>
        </div>
    </div>

@endif
    <style>
        #showClass{
            background-color: rgb(232, 87, 87);
            border-radius: 3%;
        }
        #showClass span{
            font-weight: 600;
            text-align: center;
        }
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

           document.getElementById('class').classList.add("menu-open");
           document.getElementById('viewClasses').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
 </script>

@endsection