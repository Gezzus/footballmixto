 function userSession($action){
      $.ajax({
          url: "/src/api/sessionHandler.php", 
          type: "GET",
          data: {
        	  "action":$action
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  if($result = JSON.parse(result)) {
              console.log($result);
                if($result.status == "failure") {                	
                		if($action == "kick") {
                      window.location.href="/index.html";
                    }
                    else if($action == "modal") {
                        $(document).ready(function(){
                       // TBD $("").hide();
                       // TBD $("").show();
                        })     
                    }
                } else if($result.status == "success") {
                	     return null;
                    }
        	     }
            },
            error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}

