@extends('base')
@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Add Guidelines</h5>
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
        <form action="{{route('superadmin.postGeneralCountryGuidelines')}}?id={{$id}}" method="POST" class="p-2 border border-2 w-75" style="border-radius: 3%" enctype="multipart/form-data">
            @csrf
            
            <div class="d-flex mt-2">
                <div class="col-4"><label for="course">Add Guidelines</label></div>
                <div class="col-8">
                   <textarea name="guidelines" id="guidelines" class="form-control" cols="10" rows="5" required></textarea>
                    <div class="mt-1">
                        @error('course')
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
    <script>
        setTimeout(function () {
            document.getElementById("sessionSuccess").style.display = "none";
            }, 3000); 

        setTimeout(function () {
            document.getElementById("sessionFail").style.display = "none";
            }, 3000); 

           document.getElementById('generalCountry').classList.add("menu-open");
           document.getElementById('viewGeneralCountry').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
    </script>
@endsection