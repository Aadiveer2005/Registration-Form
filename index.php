
<!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration Form</title>
   <style>
       body {
       margin: 0;
       padding: 0;
       font-family: Arial, sans-serif;
       background: url('https://t4.ftcdn.net/jpg/00/69/42/49/360_F_69424905_vxTpRGAcVKni9157VpKAOG6MpTX30etl.jpg') center/cover no-repeat;
       color: #fff;
     }
 
     .container {
       width: 300px;
       margin: 100px auto;
       padding: 20px;
       background-color: rgba(132, 106, 106, 0.7);
       border-radius: 10px;
       box-shadow: 0 0 10px rgba(39, 37, 37, 0.5);
     }
 
     h2 {
       text-align: center;
     }
 
     form {
       display: flex;
       flex-direction: column
     }
 
     label {
       margin-bottom: 8px;
     }
 
     input {
       padding: 10px;
       margin-bottom: 16px;
       border: none;
       border-radius: 4px;
     }
 
     input[type="submit"] {
       background-color:rgb(65, 65, 161);
       color: #fff;
       cursor: pointer;
     }
 
     input[type="submit"]:hover {
       background-color: #45a049;
     }
   </style>
 </head>
 <body>
   <div class="container">
     <h2>Registration Form</h2>
     <form   action="index.php"  method="post" onsubmit="return validateForm()">
       <label for="username">Name:</label>
       <input type="text" id="username" name="username">
 
       <label for="email">Email:</label>
       <input type="email" id="email" name="email">
 
       <label for="dob">Date of Birth:</label>
       <input type="date" id="dob" name="dob">
 
       <label for="number">Phone number:</label>
       <input type="tel" id="number" name="number">
 
       <label for="password">Password:</label>
       <input type="password" id="password" name="password" >
 
 
       <input type="submit" value="Register">
     </form>
   </div>
   <?php

ini_set('display_errors', 1);
error_reporting(E_ALL); 

 $username = $_POST['username'];
 $email = $_POST['email'];
 $dob = $_POST['dob'];
 $number = $_POST['number'];
 $password = $_POST['password'];

 $conn = new mysqli('localhost','root','','code');
 if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
 }
 else {
    $stmt = $conn->prepare("INSERT INTO register (username, email, dob, number, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $username, $email, $dob, $number, $password);
    $stmt->execute();
    echo "REGISTRATION DONE";
    $stmt->close();
    $conn->close();
 }
 echo "REGISTRATION DONE";
 ?>
   
   <script>
     function validateForm() {
       var username = document.getElementById('username').value;
       var email = document.getElementById('email').value;
       var password = document.getElementById('password').value;
       var number = document.getElementById('number').value;
       var dob = document.getElementById('dob').value;
       
 
       if (username === '' || email === '' || password===''  || number === '' || dob === '') {
         alert('Please fill in all fields');
       }
 
       var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       if (!emailRegex.test(email)) {
         alert('Please enter a valid email address');
       }
 
     const dobRegex = /^\d{4}-\d{2}-\d{2}$/;
     if (!dobRegex.test(dob)) {
       alert( "Invalid date of birth format. Please use YYYY-MM-DD.");
      }
 
       const dobDate = new Date(dob);
   if (isNaN(dobDate.getTime())) {
        alert("Invalid date of birth.");
      }
 
  
      const currentDate = new Date();
   if (dobDate > currentDate) {
        alert( "Date of birth cannot be in the future.");
      }
 
     var phoneNumberRegex = /^\d+$/;
     if (!phoneNumberRegex.test(number)) {
       alert("Phone number should contain digits only");
       return false;
     }
 
      if (password.length < 8) {
          alert( "Password must be at least 8 characters long");
          
    }
 
  
       if (!/[a-zA-Z]/.test(password) || !/\d/.test(password)) {
          alert( "Password must contain both letters and numbers");
    }
 
    if (number.length !== 10) {
     alert('Number should be 10 digits');
     }
 
      return true;
 }
 </script>
 </body>
 </html>