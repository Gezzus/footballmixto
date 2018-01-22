 function userSession($value,$action){
      $.ajax({
          url: "/src/api/sessionHandler.php", 
          type: "GET",
          data: {
        	  "action":$value
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  if($result = JSON.parse(result)) {
                if($result.status == "failure") {                	
                		if($action == "kick") {
                      window.location.href="/index.html";
                    } else if($action == "modal") {
                        $(document).ready(function(){
                          $("#login").hide();
                          $("#logedIn").show();
                          $("loggedUserName").append($result.username);
                        })                    
                    } else if($result.status == "success") {
                	     return null;
                    }
        	     }
            }
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}

