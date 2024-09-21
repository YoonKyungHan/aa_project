@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop
<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f6f9;
        }
        .login-box {
            width: 360px;
            margin: 0;
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
        }
        .login-card-body {
            padding: 20px;
        }
        .login-logo {
            margin-bottom: 20px;
        }
        .social-auth-links {
            margin-top: 20px;
        }
    </style>
@section('body')
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <div class="login-logo">
                <a href="#"><b>Admin</b>LTE</a>
            </div>
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ route('admin.login') }}" method="POST" onsubmit="return handleLogin(event)">
                @csrf
                <div class="input-group mb-3">
                    <input type="name" class="form-control" placeholder="name" name="name" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <p class="mb-1"><a href="#">I forgot my password</a></p>
            <p class="mb-0"><a href="#" class="text-center">Register a new membership</a></p>
            @can('edit articles')
                <p>You have permission to edit articles.</p>
            @else
                <p>You do not have permission to edit articles.</p>
            @endcan
        </div>
    </div>
</div>
<script>
    function handleLogin(event) {
        // event.preventDefault();
        // const form = event.target;
        // const formData = new FormData(form);

        // fetch(form.action, {
        //     method: 'POST',
        //     body: formData,
        //     headers: {
        //         'X-Requested-With': 'XMLHttpRequest',
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     }
        // })
        // .then(response => {
        //     if (!response.ok) {
        //         throw new Error('Login failed');
        //     }
        //     return response.json();
        // })
        // .catch(error => {
        //     alert('로그인할수 없습니다.');
        // });
    }
</script>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop