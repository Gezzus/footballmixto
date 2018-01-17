 function userLogin(){
      $.ajax({
          url: "/src/api/loginHandler.php", 
          type: "POST",
          data: {
              "username": $( "#username" ).val(),
              "password": $( "#password" ).val()
            },
          dataType: "html",
          async: false,
          success: function(result){
        	  
        	  
        	  if($result = JSON.parse(result)) {
                if($result.status == "failed") {
                  $("#username").css('border', '1px solid red');
                  $("#password").css('border', '1px solid red');
                  $("#error").html("The provided credentials were incorrect.<br>Please try again");
                } else if($result.status == "empty") {
                  $("#username").css('border', '1px solid red');
                  $("#password").css('border', '1px solid red');
                  $("#error").html("Please complete the fields above and try again");
                } else{	
                  console.log("Redirect after session starts");
                  window.location.href="/index.html";
                }
        	  }
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}

