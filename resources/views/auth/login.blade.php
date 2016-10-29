<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guanxi Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html {
            box-sizing: border-box;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }

        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: -apple-system, BlinkMacSystemFont, “Segoe UI”, “Roboto”, “Oxygen”, “Ubuntu”, “Cantarell”, “Fira Sans”, “Droid Sans”, “Helvetica Neue”, sans-serif;
        }

        .login-form {
            max-width: 450px;
            width: 95%;
        }

        .form-group {
            width: 100%;
            padding: 10px 0;
        }

        .form-group label {
            text-transform: uppercase;
            font-size: 80%;
            color: indianred;
            padding-bottom: 5px;
            display: inline-block;
        }

        .control {
            width: 100%;
            height: 32px;
            padding-left: 8px;
            line-height: 32px;
            font-size: 1em;
        }

        .secondary-login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        label[for=remember]::after {
            content: '';
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid indianred;
            margin-left: 10px;
            vertical-align: bottom;
        }

        #remember:checked + label[for=remember]::after {
            background: indianred;
        }

        #remember {
            display: none;
        }

        .forgot-password {
            color: dodgerblue;
            text-decoration: none;
            padding: 0;
            margin: 0;
        }

        .login-button {
            width: 100%;
            height: 32px;
            border: 0;
            background: indianred;
            color: white;
            text-transform: uppercase;
            font-size: 1em;
        }

        .login-button:hover {
            opacity: .8;
        }

        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
<form action="/admin/login" method="POST" class="login-form">
    {!! csrf_field() !!}
    <h2>Welcome, Login</h2>
    <div class="form-group">
        <label for="email">Email: </label>
        <input type="email" name="email" class="control">
    </div>
    <div class="form-group">
        <label for="password">Password: </label>
        <input type="password" name="password" class="control">
    </div>
    <div class="secondary-login-options form-group">
        <input id="remember" type="checkbox" name="remember">
        <label for="remember">Remember me:</label>
        <a class="forgot-password" href="/admin/password/show/reset">Forgot Password?</a>
    </div>
    <div class="form-group">
        <button class="login-button" type="submit">Login</button>
    </div>
</form>
</body>
</html>