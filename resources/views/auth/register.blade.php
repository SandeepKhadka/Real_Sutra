<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Sutra Accessories | Register</title>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8 mt-16">
        <div class="flex justify-center items-center">
            <div class="max-w-5xl flex bg-white p-8 rounded-md shadow-md">
               
                <div class="w-4/5 p-4">
                    <h2 class="text-2xl font-bold mb-6">Create Your Account</h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <strong>Oh sorry!</strong> There were some issues with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <input id="name" name="name" type="text" required
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600"
                            placeholder="{{ __('Full Name') }}" />

                        <input id="username" name="username" type="text" required
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600"
                            placeholder="{{ __('User Name') }}" />

                        <input id="email" name="email" type="text" required
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600"
                            placeholder="{{ __('Email Address') }}" />

                        <input id="phone" name="phone" type="number" required
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600"
                            placeholder="{{ __('Phone Number') }}" />

                        <input id="password" name="password" type="password" required
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600"
                            placeholder="{{ __('Password') }}" />

                        <input id="password-confirm" name="password_confirmation" type="password" required
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600"
                            placeholder="{{ __('Confirm Password') }}" />

                        <select name="gender" id="gender"
                            class="form-input w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white border border-gray-300 rounded focus:outline-none focus:border-blue-600">
                            <option value="" disabled selected>--Select Gender--</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>

                        <button type="submit"
                            class="w-full mt-4 bg-green-500 text-white font-medium py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring focus:border-blue-300">
                            {{ __('Register') }}
                        </button>
                    </form>

                    <p class="text-sm font-semibold mt-4">
                        Already Registered?
                        <a href="{{ route('login') }}"
                            class="text-blue-600 hover:text-blue-700">{{ __('Login') }}</a>
                    </p>
                </div>
                <div class="flex-shrink-0 w-3/5">
                    <img src="https://source.unsplash.com/featured/?shopping,mall" alt="Sutra Accessories" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
