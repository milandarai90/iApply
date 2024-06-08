<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
           
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
    <div class="ms-2 col-3">
        <a class="navbar-brand fw-bold fs-3" href="#">iApply</a>
    </div>
    <div class="d-flex justify-content-center col-6">
        <a href="#" class="text-decoration-none text-dark "><li class="list-unstyled">Home</li></a>
    </div>
      
        <div class=" col-3">
            {{-- <button class="btn btn-success">Login</button> --}}
            <a href="{{route('registerDisplay')}} " class="me-3 d-flex justify-content-end"><button class="btn btn-primary">Register</button></a>
        </div>  
    </div>
  </nav>
        </header>
        <main>
            <div class=" p-3 mt-5" style="margin-left: 25%; margin-right:25%;">
                <div class="d-flex justify-content-center mb-3 fw-bold fs-4">
                    <span class="text-danger">Login Form</span>
                </div>
                <hr>
            <div>
                <form action="{{route('loginCheck')}}" class="w-100 p-3" method="POST">
                         @csrf
                    <label for="email" >Email</label><br>
                    <input type="email" class="mt-3 mb-2 form-control w-100" placeholder="Enter email" id="email" name="email">
                      <div class="mt-2 mb-2">
                    </div>              
                    <label for="password" >Password</label><br>
                    <input type="password" class="mt-3 mb-2 form-control" name="password" placeholder="Enter a password" id="password">
                       <div class="mt-2 mb-2">
                       </div>
                    <div class="d-flex justify-content-center mt-4">            
                        <button type="submit" class="btn btn-success">Login</button>  
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
                </form>
            </div>
           
        </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script>
            setTimeout(function () {
       document.getElementById("sessionSuccess").style.display = "none";
       }, 3000); 
       setTimeout(function () {
       document.getElementById("sessionFail").style.display = "none";
       }, 3000); 
     </script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
