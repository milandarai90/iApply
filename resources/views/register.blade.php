<!doctype html>
<html lang="en">
    <head>
        <title>Register</title>
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
    {{-- <div class="d-flex justify-content-end">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
    </div> --}}
    <div class="col-3 ">
            <a href="{{route('loginDisplay')}}" class="d-flex justify-content-end me-3"><button class="btn btn-success ">Login</button></a>
            {{-- <button class="btn btn-primary">Register</button> --}}
    </div>  
    </div>
  </nav>
        </header>
        <main>
                    <div class=" p-3 mt-5" style="margin-left: 25%; margin-right:25%;">
                        <div class="d-flex justify-content-center mb-3 fw-bold fs-4">
                            <span class="text-danger">Register Form</span>
                        </div>
                        <hr>
                    <div>
                    <form action="" method="POST" class="mt-3 mb-3" id="register_form">
                        @csrf
                        <div class="form-group mb-3">
                          <label for="full_name" class="mb-2">Full Name</label>
                          <input type="text" class="form-control" name="name" id="full_name" aria-describedby="fullname" placeholder="Enter Full Name" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" class="form-control" name="email" id="full_name" placeholder="Enter Your Email"  >
                            </div>
                        <div class="form-group mb-3">
                          <label for="password" class="mb-2">Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                         
                        </div>
                        <div class="form-group mb-4 ">
                            <label for="confirm" class="mb-2">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" id="password_confrmation'"   placeholder="Confirm Password" >
                            </div>
                       <div class="d-flex justify-content-center mt-4 mb-3"> <button type="submit" class="btn btn-primary  w-25">Register</button>
                        </div>
                       <div class="mt-4 mb-4">
                        <div class="text-center"> <span >Already have an account?</span></div>
                        <div  class="text-center"> <a href=" ">Login now.</a></div>
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

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
