<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: blue;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: lightskyblue;
        }
        a {
            text-align: center;
            color: #1e90ff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Page</h1>
        <form id="login">
            <input type="text" id="name" placeholder="Username"><br>
            <input type="password" id="password" placeholder="Password"><br>
            <input type="submit" value="Login" id="submit"><br>
            <a href="sign_up.php">Click here to sign up</a>
        </form>
        <div id="message" class="text-red"></div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#login").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'login.php',
                type: 'Post',
                data: {name:$('#name').val(), password:$("#password").val()},
                success: function(data){
                    
                    if(data=="pending"){
                        
                        $("#message").html("Your account status is pending/disabled");
                    }
                    else if(data=="fail"){
                        $("#message").html("Your password or id is incorrect");
                    }
                    else{
                        
                        window.location.href = 'dashboard.php';
                    }
                }

            }
                 
            );
        });
    });
        
    
</script>
</body>

</html>
