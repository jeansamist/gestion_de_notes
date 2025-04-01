<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
    body {
        background-color: #000;
    }
</style>
</head>
<body class="" style="min-height: 100vh;">

    @include('partials.navbar') <!-- Optional partial include -->

    <div class="d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        @yield('content')
    </div></div>

    <footer>
        <p>&copy; {{ date('Y') }} My Laravel App</p>
    </footer>

</body>
</html>
