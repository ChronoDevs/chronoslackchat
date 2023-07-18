@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <h1>Login</h1>
                <form action="{{route('auth.login')}}" method="post" id="formLogIn">
                    @csrf
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" name="email" class="form-control" id="email" />
                        </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" id="password">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function verifyToken()
            {
                
            }

            $('#formLogIn').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            let data = response.data;
                            localStorage.setItem('userToken', data.token.plainTextToken)
                            window.location.href='/home';
                        }
                    }, error: function (error) {
                        console.log(error);
                    }
                })
            });
        })
    </script>
@endsection