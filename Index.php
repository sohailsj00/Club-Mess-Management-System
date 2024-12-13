<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index File</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        #container {
            border: 3px solid red;
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
        }
        h3 {
            margin-top: 0;
            color: red;
        }
        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="IndexFile_code.php" method="post">
        <div class="container" id="container">
            <h3 class="text-center">Login for Mess</h3>
            <div class="form-group">
                <input type="radio" id="member" name="login_group" value="Mess Member Login">
                <label for="member">Mess Member Login</label>
            </div>
            <div class="form-group">
                <input type="radio" id="student" name="login_group" value="Student Login">
                <label for="student">Student Login</label>
            </div>
         
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="login" name="login" value="login">LOGIN</button>
            <p>New Registration <a href="student_regstration_for_mess.php">Click Here</a> Only for student</p>
        </div>
    </form>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    </script>
</body>
</html>
