<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>


    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/">

    {{-- menmbahkan file views/layout/css.blade.php disini --}}
    @include('layouts.css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Content wrapper -->
            <div class="content-wrapper px-4">
                <!-- Content -->
                <div class="container-xxl- flex-grow-1 container-p-y">

                    <div class="d-flex w-100 h-100 bg-light shadow rounded">
                        <div class="d-flex flex-grow-1 p-4 ">
                            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center">
                                <h1 class="fw-bolder fs-3">Login Pustakawan</h1>
                                <div class="my-5 w-50 fs-5">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $err)
                                            <p class="alert alert-danger">{{ $err }}</p>
                                        @endforeach
                                    @endif
                                    <form action="{{ route('login.action') }}" class="form" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="input-group input-group-lg">
                                                    <input type="text" class="form-control" name="username" placeholder="Username" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <div class="input-group input-group-lg">
                                                    <input type="password" id="password" class="form-control form-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-eye" id="togglePassword"
                                                           style="cursor: pointer"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="w-50 h-100 bg-primary rounded-start align-items-center justify-content-center d-none d-md-flex">
                            <div class="d-flex flex-column px-4 w-50 h-50 rounded border border-2 justify-content-end align-items-end" style="background-color: rgba(255, 255, 0255, 0.5); border-radius: 3rem !important">
                                <h3 class="fw-bolder text-white">Very good works are waiting for you </h3>
                                <img src="{{ asset('assets/img/login.png') }}" alt="" class="h-75">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- / Content -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->

        </div>

    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    {{-- menmbahkan file views/layout/js.blade.php disini --}}
    @include('layouts.js')

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>

<!-- beautify ignore:end -->
