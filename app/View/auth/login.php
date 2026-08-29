<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daxil ol</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Daxil ol</h2>

    <form action="/PHP_Review/Public/auth/login" method="POST">

        <div class="form-group">
            <input
                    type="hidden"
                    name="csrf_token"
                    value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>"
            >
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Emailinizi daxil edin" required>
        </div>

        <div class="form-group">
            <label for="password">Şifrə</label>
            <input type="password" id="password" name="password" placeholder="Şifrənizi daxil edin" required>
        </div>

        <button type="submit">Daxil ol</button>

    </form>

    <div class="register-link">
        Hesabınız yoxdur? <a href="/PHP_Review/Public/auth/register">Qeydiyyatdan keç</a>
    </div>

</div>
</body>
</html>
<?php
    if(!empty($errors)){
        foreach ($errors as $error)
        {
            echo $error;
        }
    }
?>
