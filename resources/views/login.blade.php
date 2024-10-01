<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Tambahkan link ke Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Link ke Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('{{ asset('../style/images/bg.png') }}');
            background-size: cover;
            background-position: center;
        }

        input {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow untuk input */
        }

        .card-shadow {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Shadow untuk card */
        }

        footer {
            font-size: 12px;
            text-align: center;
            color: #ffffff;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black opacity-50 z-0"></div>

    <!-- Container Utama -->
    <div class="min-h-screen flex items-center justify-center relative opacity-90 z-10">

        <!-- Logo di atas card -->
        <div class="absolute top-0 flex flex-col justify-center items-center w-full mt-5 mb-6">
            <img src="{{ asset('../style/images/smk.png') }}" alt="Logo Web" class="h-20 w-20 bg-white p-2 rounded-full shadow-lg mb-2">
            <h1 class="text-white text-xl font-bold">SISTEM INFORMASI</h1>
            <h6 class="text-white text-sm font-medium mb-4">Manajemen Pembelajaran Kejuruan</h6>
        </div>

        <!-- Card Form Login dengan shadow -->
        <div class="bg-amber-900 p-8 pt-16 rounded-xl card-shadow w-full max-w-md bg-opacity-50 relative mt-12 ">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="">
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-white">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus placeholder="masukkan email"
                        class="bg-white mt-1 block w-full px-3 py-2 border border-white rounded-full shadow-md focus:outline-none focus:ring-white focus:border-white sm:text-sm">
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <input type="password" id="password" name="password" placeholder="masukkan password"
                        class="bg-white mt-1 block w-full px-3 py-2 border border-gray-300 rounded-full shadow-md focus:outline-none focus:ring-white focus:border-white sm:text-sm ">
                </div>

                <!-- Tombol Login -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-amber-900 text-white font-semibold rounded-full hover:bg-amber-800 shadow-lg focus:outline-none focus:ring-white focus:border-white">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer dengan Copyright -->
    <footer class="absolute bottom-0 w-full pb-4">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </footer>

</body>

</html>
