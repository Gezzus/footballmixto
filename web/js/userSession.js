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
                    window.location.href="/web/index.html";
                } 		
        	    } else if($result.status == "success") {
                    console.log($result);
                    if($validation == "logedIn") {
                    	
                    $(document).ready(function() {
                    $buttons = 	"<li class='nav-item'>" +
	                            "<a href='profile.html' class='nav-link'>Profile</a>" +
	                            "</li>" +
	                            "<li class='nav-item'>" +
	                            "<a href='#' onclick='userSessionTerminate()' class='nav-link'>Logout</a>" +
	                            "</li>";
                            $("#navigationBar").append($buttons);
                        })
                    if($result.roleId == "2"){
                    	$(document).ready(function() {
                        	$buttons = "<li class='nav-item'>" +
                        				"<a href='#' onclick='' class='nav-link'>Admin</a>" +
                        				"</li>";
                        	$("#navigationBar").append($buttons);
                    	})
                    }
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
 
/*function userGetRole(){
	$.ajax({
		url: "/src/api/sessionHandler.php", 
        type: "GET",
        data: {
      	  "validation":"logedIn",
            "role":"admin"
        },
        dataType: "html",
        async: false,
        success: function(result){
        	$(document).ready(function() {
        	$buttons = "<li class='nav-item'>" +
        				"<a href='#' onclick='' class='nav-link'>Admin</a>" +
        				"</li>";
        	$("#navigationBar").append($buttons);
        	})
        },
        error: function(status,exception) {
        	if($result = JSON.parse(result)) {
        		
        	}
        }
	})
}*/

function userSessionTerminate() {
  $.ajax({
    url: "/src/api/logoutHandler.php",
    type:"POST",
    data: {

    },
    dataType:"html",
    async: false,
    success: function(result){
      console.log(result);
      if($result = JSON.parse(result)) {
        if($result.status="success"){
          window.location.href = "/web/index.html"
        } else {
          // SOMETHING WENT WRONG PAGE
        }
      } else {

      }
    }
  })
}

