 function userSession($value){
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
                		$("#loggedInModal").removeAttr("hidden");
                	});                	
                }else if($result.status == "success") {
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

