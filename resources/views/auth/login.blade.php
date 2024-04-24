<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sutra Accessories | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            display: flex;
            width: 80%;
            height: 70%;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background: #fff;
        }

        .left {
            flex: 1;
            background: url('https://via.placeholder.com/400') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left img {
            max-width: 100%;
            height: auto;
        }

        .right {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right h2 {
            font-size: 30px;
            margin-bottom: 30px;
            color: #333;
        }

        .right form {
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        .right input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #f0f0f0;
            color: #333;
            font-size: 16px;
            outline: none;
        }

        .right button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #4caf50;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .right button:hover {
            background-color: #45a049;
        }

        .right p {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .right p a {
            color: #007bff;
            text-decoration: none;
        }

        .right p a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left,
            .right {
                flex: 1;
            }

            .right {
                padding: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="left">
            <img src="https://source.unsplash.com/featured/?shopping,mall" alt="Logo">
        </div>
        <div class="right">
            <h2>Welcome to <a href="{{route('front.home')}}" style="text-decoration: none; color: rgb(79, 79, 240) ">Sutra Accessories!</a></h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input id="email" name="email" type="email" placeholder="Email Address" required />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <input id="password" name="password" type="password" placeholder="Password" required />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <button type="submit">Login</button>

                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </form>
        </div>
    </div>

</body>

</html>
