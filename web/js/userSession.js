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
        	  //console.log("Result in frontend: "+result+"/n<br>");
        	  console.log(result);
        	  if($result = JSON.parse(result)) {
                if($result.status == "success") {
                	window.location.href="/web/index.html?redirected";
                	console.log("redirected");
                }else{
                	
                }
        	  }
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}

