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
    <div class="col-3 ">
            <a href="{{route('loginDisplay')}}" class="d-flex justify-content-end me-3"><button class="btn btn-success ">Login</button></a>
            {{-- <button class="btn btn-primary">Register</button> --}}
    </div>  
    </div>
  </nav>
        </header>
        <main>
                    <div class=" p-3 mt-5" style="margin-left:30%; margin-right:30%;">
                        <div class="d-flex justify-content-center mb-3 fw-bold fs-4">
                            <span class="text-danger">OTP verification</span>
                        </div>
                        <hr>

                    <div class="mb-2">
                    <form action="{{route('otp_verify')}}" method="POST" class="mt-3 mb-3" id="register_form">
                        @csrf
                        <div class="form-group mb-3">
                          <label for="otp" class="mb-3">Enter a OTP sent to your email.</label>
                          <input type="text" class="form-control" name="otp" id="otp" aria-describedby="fullname" placeholder="Enter OTP" >
                        </div>
                       
                       <div class="d-flex justify-content-center mt-4 mb-3"> <button type="submit" class="btn btn-primary  w-25">Verify OTP</button>
                        </div>
                    </form>
                        <div class="text-center d-flex justify-content-center"> 
                            <span >Didnt receive a code? </span>
                            <form action="{{ route('otp_resend') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{session('register_email')}}"> &nbsp;
                                <button class="border border-light text-primary text-decoration-underline bg-light" type="submit"> Resend</button>
                            </form>
                        </div>
    
                        </div>
                    <div >
                        @if(Session::has('success'))
                        <div class="form-control align-items-center" id="sessionSuccess" style="background-color: rgb(51, 198, 28)">
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
