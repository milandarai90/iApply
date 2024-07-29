@extends('base')
@section('content')

<div class="container">
   <div class="d-flex justify-content-end">
    <div class="mt-2 col-2 ">
        {{-- <a href="{{route('consultancy.guidelinesAdd')}}?country={{$country}}" class="text-decoration-none"> --}}
            <input type="button" class="form-control bg-success text-light"  value="Add Guidelines">
        {{-- </a> --}}
    </div>
   </div>
<h4 class="ms-3 ">
   Notifications
</h4>
{{-- @if(count($guidelines)>0) --}}
        <div id="table">
            <table class="text-center table table-bordered table-hover mt-2">
                
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
{{-- @else --}}
    {{-- <div class="container">
        <div class="mt-3 d-flex justify-content-center">
            <h5 class="text-danger">No data available</h5>
        </div>
    </div> --}}

{{-- @endif --}}
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

           document.getElementById('notification').classList.add("menu-open");
        //    document.getElementById('guidelines').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
 </script>

@endsection