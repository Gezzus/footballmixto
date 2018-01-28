 function userLogin(){
      $.ajax({
          url: "/src/api/loginHandler.php", 
          type: "POST",
          data: {
              "userName": $( "#userName" ).val(),
              "password": $( "#password" ).val()
            },
          dataType: "html",
          async: false,
          success: function(result){
        	  $("#userName").css('border', '1px solid rgba(0,0,0,.1)');
              $("#password").css('border', '1px solid rgba(0,0,0,.1)');
              $("#error").html("Loading...<br>");
              $("#error").css('color','black');
        	  
            
        	  if($result = JSON.parse(result)) {
                if($result.status == "failed") {
                  $("#userName").css('border', '1px solid red');
                  $("#password").css('border', '1px solid red');
                  $("#error").html("The credentials provided are incorrect.<br>Please try again.");
                  $("#error").css('color','red');
                } else if($result.status == "empty") {
                  $("#userName").css('border', '1px solid red');
                  $("#password").css('border', '1px solid red');
                  $("#error").html("Please complete the fields above and try again");
                  $("#error").css('color','red');
                } else if($result.status == "success"){	
                  console.log("Redirect after session starts");
                  window.location.href="/web/index.html";
                }
        	  }
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}

