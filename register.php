<?php
require('server.php');
?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" content="width=device-width, initial-scale=1.0">
 
</head>
<body>
	<div class="login_page">
  		
    		<form method="POST" name="myform" onsubmit= "return validate_form()" action="">
<table>

      <tr>
            <th><label for="name_o">Name</label></th>
            <td><input type="text" id="name_o" name="name_o" value="<?php echo $name; ?>" required/> <span><?php if($error_dis1 != ""){echo $error_dis1;} ?></span></td>

      </tr>

      <tr>
      	<p id="error_user"></p>
      </tr>


        <tr>
            <th><label for="user">username</label></th>
            <td><input type="text" id="user" name="user" value="<?php echo $user; ?>" required/> <span><?php if($error_dis2 != ""){echo $error_dis2;} ?></span></td>
      </tr>

      <tr>
      	<p id="error_username"></p>
      </tr>
            
       

         <tr>
            <th><label for="number">Mobile No.</label></th>
            <td><input type="number" id="number" name="number" value="<?php echo $mobile; ?>" required/> <span><?php if($error_dis4 != ""){echo $error_dis4;} ?></span></td>
      </tr>

      <tr>
      	<p id="error_num"></p>
      </tr>

       <tr>
            <th><label for="email">Email</label></th>
            <td><input type="text" id="email" name="email" value="<?php echo $email; ?>" required/> <span><?php if($error_dis3 != ""){echo $error_dis3;} ?></span></td>
      </tr>
        
       <tr>
       	<p id="error_email"></p>
       </tr>


        

         <tr>
            <th><label for="password">Password</label></th>
            <td><input type="password" id="password" name="password" required/> <span><?php if($error_dis5 != ""){echo $error_dis5;} ?></span></td>
      </tr>
       
         <tr>
      	<p id="error_password"></p>
      </tr>

      		 <tr>
            <th><label for="confirm">Confirm Password</label></th>
            <td><input type="password" id="confirm" name="confirm" required/> <span><?php if($error_dis1 === ""){echo $error_dis1;} ?></span></td>
      </tr>
        
          <tr>
      	<p id="error_confpass"></p>
      </tr>

          <tr>
        <p id="ajax_user"></p>
      </tr>

</table>  
      		 <input type="submit" value="Submit" name="reg_page" />
      		 <div id="warning"></div>

      		 <p class="login_">Already registered? <a href="login.php">Log in!!</a></p>

      	</form>
  
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
var c= 0, d= 0, e= 0, f= 0, g= 0, h= 0, i= 0;



//Ajax
 
$(document).ready(function () {
    $("#user").blur(function () {
      var username = $(this).val();
      if (username == '') {
      $("#ajax_user").html("");
      }else{
      $.ajax({
url: "ajax_user.php?user_ajax="+username
}).done(function( data ) {
  $("#ajax_user").html(data);
  }); 
      } 
      });
    });



	function validate_form(){
	var name = document.forms["myform"]["name_o"].value;
	var pass = document.forms["myform"]["password"].value;
	var email = document.forms["myform"]["email"].value;
	var pass1 = document.forms["myform"]["confirm"].value;
	var number = document.forms["myform"]["number"].value;
	

//Warning Labels
  if(c==0||d==0||e==0||f==0||g==0||h==0||i==0){
    document.getElementById('warning').innerHTML="";
   }


    if(c>=2||d>=2||e>=2||f>=2||g>=2||h>=2||i>=2){
    document.getElementById('warning').innerHTML="Don't mess with me by submitting wrong information";
   }




	var alphabets = /^[A-Za-z]+$/; //cannot contain special characters
    if(name.match(alphabets))
    {
    document.getElementById('error_user').innerHTML="";
    c = 0;
    }
    else
    {
    document.getElementById('error_user').innerHTML="*Please enter Valid Name with Alphabets... :)*";
    c++;
    return false;
    }



	if(pass.length<7||pass.length>13){
        document.getElementById('error_password').innerHTML="*Please enter a password of length 7 to 12*";
        d++;
        return false;
	}
	else{
		document.getElementById('error_password').innerHTML="";
		 d = 0;
	}


	if(pass!=pass1){
		 document.getElementById('error_confpass').innerHTML="*Password didnot match...XD*";
		 e++;
		 return false;
	}
	else{
		document.getElementById('error_confpass').innerHTML="";
		 e = 0;
	}



    var mail = /^[^@]+@[^@.]+\.[a-z]+$/i;
    if(email.match(mail))
    {
   document.getElementById('error_email').innerHTML="";
    f = 0;
    }
    else
    {
 document.getElementById('error_email').innerHTML="*Did you just make up that email... :(  *";
    f++;
 return false;
     }



    var agematch = /^[0-9]+$/;
    
    if(age<5||age>150){
    	 document.getElementById('error_age').innerHTML="*Too old or too younger *";
    	 g++;
    	 return false;
    }
    else if(age.match(agematch))
    {
    document.getElementById('error_age').innerHTML="";
     g = 0;
    }


    var alpha = /^[A-Za-z]+$/;
    if(city.match(alpha))
    {
    document.getElementById('error_city').innerHTML="";
     h = 0;

    }
    else
    {
    document.getElementById('error_city').innerHTML="*Enter a valid city*";
    h++;
    	 return false;
    }

    var mob = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
;
    if(number.match(mob))
    {
    document.getElementById('error_num').innerHTML="";
     i = 0;
     
    }
    else
    {
     document.getElementById('error_num').innerHTML="*Enter a valid phone number*";
     i++;
    	 return false;
    }

}

</script>

</body>
</html>
