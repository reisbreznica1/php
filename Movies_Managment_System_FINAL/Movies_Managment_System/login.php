
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">

<main class="form-signin">

    <form action="loginLogic.php" method="post">

        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="text"
                   class="form-control"
                   id="username"
                   placeholder="Username"
                   name="username"
                   required>
            <label for="username">Username</label>
        </div>

        <div class="form-floating">
            <input type="password"
                   class="form-control"
                   id="password"
                   placeholder="Password"
                   name="password"
                   required>
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary"
                type="submit"
                name="submit">
            Sign in
        </button>

        <p class="mt-3">
            Don't have an account?
            <a href="index.php">Sign up</a>
        </p>

    </form>

</main>

</body>
</html>
