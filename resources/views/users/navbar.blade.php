
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <div class="ms-2">
        <a class="navbar-brand fw-bold fs-3" href="#">iApply</a>
    </div>
    <div>
        <a href="#" class="text-decoration-none text-dark"><li class="list-unstyled">Home</li></a>
    </div>
        <div class="d-flex justify-content-center">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
        <div class="me-2">
            <a href="{{route('loginDisplay')}}"><button class="btn btn-success">Login</button></a>
            <a href="{{route('registerDisplay')}}"><button class="btn btn-primary">Register</button></a>
        </div>  
    </div>
  </nav>
  