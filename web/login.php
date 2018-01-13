
<html>
<head>

<?php include("header.html"); ?>
<!--<script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min"></script>-->
 <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<script type="text/javascript">
    function user_test(){

      $( "#password" ).html("Test");

      $( "#username" ).css( "border", "3px solid red" );

    }


    function user_login(){
      
      $( "#username" ).css( "border", "3px solid red" ); 

      .ajax({
        url: "footballmixto/new/login_handler.php", 

        type: "POST",
        data: {
            username:$( "#username" ).html()
        },
        dataType: "html",
        async: false,
        /*success: $("#username").html("Exito")*/
        function(data){
          console.log(data);
        }
        
        });

      }

</script>

    
     
      <label>Username:</label>
      <input id="username" type="text" class="content team" placeholder="Username">
      <label>Password:</label>
      <input id="password" type="text" class="content team">
      
      <hr>
      <button class="content team" type="submit" onclick="user_login()">Submit</button>  
      
     
        <a href="register.php"><button type="submit" class="content team" style="min-width:80%" >Register</button></a><br>
        <button style="min-width:80%" class="content team" onclick=window.open("https://api.instagram.com/oauth/authorize/?client_id=d31abc6eb2d94c418c5b5ddc14df11cd&redirect_uri=http://172.20.10.81&response_type=code","_child","width=500,height=500")>Login with Instagram</button><br>

         <button style="min-width:80%" class="content team" onclick=window.open("","_child","width=500,height=500")>Login with Facebook</button><br>

         <button style="min-width:80%" class="content team" onclick=window.open("","_child","width=500,height=500")>Login with LinkedIn</button><br>

<?php
 include("svg/graph.html")
?>
</body>

</html>


