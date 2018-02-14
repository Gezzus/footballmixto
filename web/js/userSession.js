 function validateUserSession($validation, $role){
      $.ajax({
          url: "/src/api/userHandler.php",
          type: "GET",
          data: {
              "action": "validate",
        	  "validation": $validation,
              "role":$role
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  //console.log(result);
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
                    //console.log($result);
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
                        				"<a href='admin.html' onclick='' class='nav-link'>Admin</a>" +
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

function getUser() {
    $response = $.ajax({
        url: "/src/api/userHandler.php",
        type: "GET",
        data: {
            "action": "get"
        },
        dataType: "html",
        async: false,
        success: function(result){
                //console.log(result);
        },
        error: function(status,exception) {
        console.log(status);
        console.log(exception);
    }});
    return JSON.parse($response.responseText);
}
 
/*function userGetRole(){
	$.ajax({
		url: "/src/api/userHandler.php",
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

function retrieveUserInfo() {
    $user = getUser();
    console.log($user);
    $(document).ready(function() {
        if ($user.status == "success") {
            var $userInfo = "<h4 class='mt-4'>Username: " + $user.username + "</h4>";
            $("#user-info").append($userInfo);
        } else {
            $error = "<div class=\"alert alert-danger alert-dismissable\" >" +
                "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                "<strong>Hey!</strong> Something odd happened" +
                "</div>";
            $("#error").append($error);
        }
    })
}

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

