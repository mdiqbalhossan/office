<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />

<body>

    <!-- ..::  header area start ::.. -->
    <x-sidebar />
    <!-- ..::  header area end ::.. -->

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        <x-navbar />
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            <!-- ..::  breadcrumb  start ::.. -->
            <x-breadcrumb title='{{ $title }}' subTitle='{{ $subTitle }}' />
            <!-- ..::  header area end ::.. -->

            @yield('content')

        </div>
        <!-- ..::  footer  start ::.. -->
        <x-footer />
        <!-- ..::  footer area end ::.. -->

    </main>
    @if (Session::has('success'))
        <input type="hidden" name="type" class="notification_type" value="success">
        <input type="hidden" name="success" class="notification_message" value="{{ session('success') }}">
    @endif

    @if (Session::has('error'))
        <input type="hidden" name="type" class="notification_type" value="error">
        <input type="hidden" name="error" class="notification_message" value="{{ session('error') }}">
    @endif

    @if (Session::has('info'))
        <input type="hidden" name="type" class="notification_type" value="info">
        <input type="hidden" name="info" class="notification_message" value="{{ session('info') }}">
    @endif

    @if (Session::has('warning'))
        <input type="hidden" name="type" class="notification_type" value="warning">
        <input type="hidden" name="warning" class="notification_message" value="{{ session('warning') }}">
    @endif
    <!-- ..::  scripts  start ::.. -->
    <x-scripts script="{{ isset($script) ? $script : '' }}" />

    <!-- ..::  scripts  end ::.. -->

</body>

</html>
