@extends('base')
@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-center mt-3 ">
        <h5 class="text-danger">Country</h5>
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
        <form action="{{route('superadmin.postGeneralCountry')}}" method="POST" class="p-4 border border-2 w-50" style="border-radius: 3%" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">Country Name</label><br>
      <input type="text" class="form-control mt-2" name="country" id="name" placeholder="Enter country name">
      <div class="mt-1" id="validateMsg">
        @error('country')
          <span class="text-danger">{{$message}}</span>
      @enderror
      </div>
    </div><br>
    <label class="mb-2" for="countryImage">Choose a Country Flag or Map.</label>
        <div class="input-group mb-4">
        <input type="file" class="form-control" name="countryImage" id="countryImage" required>
        </div>
    <div class="d-flex justify-content-center"><button type="submit" class="btn btn-success">Add Country</button></div>
  </form>
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

 document.getElementById('generalCountry').classList.add("menu-open");
 document.getElementById('addGeneralCountry').classList.add("menu-open","bg-secondary" ,"bg-opacity-25","text-light","rounded");
</script>
@endsection