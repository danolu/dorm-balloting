<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ABH 2024 Room Balloting</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body>
        <section style="background-color: #ca987f;">
            <div class="container py-5">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-8 col-xl-6">
                  <div class="card rounded-3">
                    <img src="{{asset('abh.jpg')}}"
                      class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                      alt="Sample photo">
                    <div class="card-body p-4 p-md-5">
                      <h3 class="mb-2 text-center">ABH 2024 Room Balloting</h3>
                      <p class="mb-2 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Enter your details below to ballot for available rooms. </p>
    

                    @if (session('alert'))
                        <div class="alert alert-warning">
                            {{ session('alert') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <br>

                      <form action="{{route('ballot')}}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror  
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="lastName" placeholder="Enter your last name" required value="{{ old('last_name') }}">
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>
                        @error('last_name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror  
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" name="sex" id="sex">
                                <option @if(!old('sex')) selected @endif disabled>Choose your sex</option>
                                <option @if(old('sex') === "male") selected @endif value="male">Male</option>
                                <option @if(old('sex') === "female") selected @endif value="female">Female</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select your sex.
                            </div>
                        </div>
                        @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                        <div class="mb-3">
                            <label for="matric" class="form-label">Matric Number</label>
                            <input type="number" class="form-control" value="{{ old('matric') }}" name="matric" id="matric" placeholder="Enter your matric number" required minlength="6" maxlength="6">
                            <div class="invalid-feedback">
                                Please enter your matric number.
                            </div>
                        </div>
                        @error('matric')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror  
                        <div class="mb-3">
                            <label for="matricConfirmation" class="form-label">Confirm Matric Number</label>
                            <input type="number" value="{{ old('matric_confirmation') }}" class="form-control" name="matric_confirmation" required minlength="6" maxlength="6" id="matricConfirmation" placeholder="Confirm your matric number">
                            <div class="invalid-feedback">
                                Please confirm your matric number.
                            </div>
                        </div>
                        @error('matric_confirmation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror  
                          
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select" name="level" id="level">
                                <option @if(!old('level')) selected @endif disabled>Select department and level</option>
                                <option @if(old('level')==='500l MBBS') selected @endif value="500l MBBS">500l MBBS</option>
                                <option @if(old('level')==='500l BDS') selected @endif value="500l BDS">500l BDS</option>
                                <option @if(old('level')==='400l Physiotheraphy') selected @endif value="400l Physiotheraphy">400l Physiotheraphy</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select your department and level.
                            </div>
                        </div>
                        @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror  
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-info" type="button">Ballot</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
                })
            })()
        </script>
    </body>
</html>
