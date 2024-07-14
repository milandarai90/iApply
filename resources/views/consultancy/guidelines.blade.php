@extends('base')
@section('content')

@if(count($country)>0)
    <div class="container me-2">
        <div class="mt-3">
            <h4 class="ms-4">Select a country to see a guidelines for.</h4>
        </div>
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 mt-2 ms-3">

                @foreach($country as $item)
             <a href="hh" class="text-decoration-none text-light">
                <div class="col me-3 bg-success " id="showCountry">
                    <div class="p-5 text-center">
                        <span>{{$item->name}}</span>
                    </div>
                  </div>
             </a>
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
            <h5 class="text-danger">No class available</h5>
        </div>
    </div>

@endif
    <style>
       
        #showCountry{
            border-radius: 3%;
        }
        #showCountry :hover{
            box-shadow: 10px 10px 20px rgba(36, 36, 36, 0.5);
        }
        #showCountry span{
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