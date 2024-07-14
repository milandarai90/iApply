<nav class="navbar navbar-expand-lg bg-secondary p-2">
    <DIV class="col-2 d-flex justify-content-center "><a class="navbar-brand text-light fs-6" href="#">Home</a></DIV>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse col-8 d-flex justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
       <h6 class="text-light fw-bold mt-2"> {{Auth::user()->name}}
        @if(Auth::user()->role == 3)
        ,
        {{Auth::user()->consultancy->consultancyDetails->name}}
        @endif
       </h6>
      </ul>                 
    </div>
    <div class="col-2 d-flex justify-content-center">
        <a href="{{route('logout')}}" class="d-flex justify-conteny-end text-decoration-none"><li class="btn btn-primary border border-3 border-primary fw-bold">Logout</li></a>
    </div>
  </nav>