@extends('base')
@section('content')
<div class="container col-12 ">
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
    <div class="d-flex justify-content-center">
   <div class=" mt-2  col-6 border border-secondary p-3">
       <div>
           <h5 class="text-center mb-3 fw-bold">Profile</h5>
       </div>
    <div class="d-flex justify-content-center mt-2">
       <div>
        <div class="d-flex justify-content-center">
        @if($user)
           <img src="{{asset('storage/'.$user->image_path)}}" class="border border-secondary border-2" style="height: 140px; width:180px; border-radius: 50%;" alt="profile.img">
           @endif
        </div><br>
       <div class=" ">
        <a href="{{route('addProfile')}}" class="float-start"><small>insert/change</small></a>
        <a href="" class="float-end text-danger"><small>delete</small></a>
       </div>
       </div>
    </div>
    <hr>
    <div class="d-flex justify-content-center">
        <span class=" fw-bold">{{Auth::user()->name}}</span>
    </div>
    <hr>
        <div class="mt-2">
           <Span>Name = {{Auth::user()->name}}</Span>
           <br>
           <Span>Email = {{Auth::user()->email}}</Span><br>
           @if(empty(Auth::user()->phone))
           <span>Phone = <small><a href="">Add number</a></small></span><br>
           @else
           <span>Phone = {{Auth::user()->phone}}</span>
           @endif
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