<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
        #form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="file"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            text-align: center;
            color: #1e90ff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Signup Page</h1>
        <div id="form">
             <input type="text" id="name" placeholder="Username" required><br>
            <input type="password" id="password" placeholder="Password" required><br>
            <input type="email" id="email" placeholder="Email" required><br>
           <select name="designation" id="designation">
               <option value="admin">Admin</option>
               <option value="faculty">Faculty</option>
               <option value="student" selected>Student</option>
           </select>
           <input type="file" name="profileImage" id="profileImage">
            <input type="submit" value="Submit" id="submit">
        </div>
           
       
        <div id="errorDiv">

        </div>
        <a href="index.php">Click here to sign in</a>
</div>
    
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
    $('#submit').on('click',function(event) {

        event.preventDefault();

       
        var name = $('#name').val();
        var password = $('#password').val();
        var email = $('#email').val();
        var designation = $('#designation').val();
        var profileImage = $('#profileImage')[0].files[0];
        var valid = true;
        var errorMessage = '';

        if (name === '' || password === '' || email === '') {
            errorMessage += 'Please fill in all required fields.<br>';
            valid = false;
        }

        if (!isValidEmail(email)) {
            errorMessage += 'Invalid email format.<br>';
            valid = false;
        }

        if (valid) {
            
        var formData = new FormData(); 
        formData.append('name', name);
        formData.append('password', password);
        formData.append('email', email);
        formData.append('designation', designation);
        formData.append('profileImage', profileImage); 
        $.ajax({
            url: 'sign_up_process.php',
            type: 'post',
            data: formData,
            processData: false, // Don't process the data (important for handling files)
            contentType: false, // Don't set contentType (important for handling files)
            success: function(response) {
                if (response==='success') {
                    window.location.href = 'index.php';
                } else {
                    $('#errorDiv').html('Error: ' + response);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        
        });
    }else {
            $('#errorDiv').html(errorMessage);
        }
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});

</script>

</body>
</html>

