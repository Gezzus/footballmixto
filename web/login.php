
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

        $.ajax({
            url: "user/login",
            contentType: "application/json; charset=utf-8",

            type: "POST",
            data: {
                username:$( "#username" ).html()
            },
            dataType: "json",
            async: false
            /*success: $("#username").html("Exito")*/
        });
      }

</script>

    
     
      <label>Username:</label>
      <input id="username" type="text" class="content team" placeholder="Username">
      <label>Password:</label>
      <input id="password" type="text" class="content team">
      
      <hr>
      <button class="content team" type="submit" onclick="user_login()">Submit</button>
<?php
 include("svg/graph.html")
?>
</body>

</html>


