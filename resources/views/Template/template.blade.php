<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <!-- link bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- link bootsrtrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-lagi.png') }}">
    {{-- jquery --}}


    @stack('style')
    {{-- <title>Floating Action Buttons</title> --}}
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f0f0f0;
        }

        .buttons {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .buttons a {
            width: 50px;
            height: 50px;
            background-color: #2c8633;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .buttons a:hover {
            background-color: #226928;
            transform: scale(1.1);
        }

        .buttons a i {
            font-style: normal;
        }
    </style>
</head>

<body>
    @if (Auth::check())
            <div class="buttons">
                {{-- <a href="{{ route('login') }}" title="Login">
                    <i class="bi bi-person-fill"></i>
                </a> --}}
                <a href="{{ route('report.article') }}" title="Home">
                    <i class="bi bi-house-door"></i>
                </a>
                <a href="{{ route('monitoring') }}" title="Alert">
                    <i class="bi bi-exclamation-lg"></i>
                </a>
                <a href="{{ route('report.create') }}" title="Edit">
                    <i class="bi bi-pen-fill"></i></i>
                </a>
                <a href="{{ route('logout') }}" title="Edit">
                    <i class="bi bi-box-arrow-right"></i>               
                </a>
            </div>
    @endif
        @yield('content-dinamis')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        @stack('script')
</body>

</html>
