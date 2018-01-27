 function userSession($validation,$role){
      $.ajax({
          url: "/src/api/sessionHandler.php", 
          type: "GET",
          data: {
        	  "validation":$validation,
            "role":$role
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  if($result = JSON.parse(result)) {
              if($result.status == "failed") {                	
                if($validation == "logedIn"){
                  if($role == "admin"){
                    window.location.href="/web/index.html#restricted"; 
                   } else {
                    window.location.href="/web/login.html#restricted";
                   }
                } else if($validation == "logedOut") {
                    window.location.href("/web/index.html");
                } 		
        	    } else if($validation == "success") {
                console.log($result);
              }
            }
          },
            error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}

