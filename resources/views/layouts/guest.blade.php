<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @include('layouts.partials.__head')
</head>

<body>

    <section class="auth bg-base d-flex flex-wrap">
        @yield('content')
    </section>

    @include('layouts.partials.__script')

</body>

</html>