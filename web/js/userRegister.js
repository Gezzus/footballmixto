 function userRegister(){
	 
      $.ajax({
          url: "../src/api/registerHandler.php", 
          type: "POST",
          data: {
              "userName": $( "#userName" ).val(),
              "password": $( "#password" ).val(),
              "nickName": $( "#nickName" ).val(),
              "genderId": $( "#genderId" ).val(),
              "skillId": $( "#skillId" ).val()
              //"email": $( "#email" ).val()
            },
            dataType: "html",
            async: false,
            success: function(result){
            	$("#userName").css('border', '1px solid rgba(0,0,0,.1)');
                $("#nickName").css('border', '1px solid rgba(0,0,0,.1)');
                $("#error").html("Loading...<br>");
                $("#error").css('color','black');
          	  
              #console.log(result); // DELETE
          	  if($result = JSON.parse(result)) {
                  if($result.status == "failed") {
                    $("#userName").css('border', '1px solid red');
                    $("#nickName").css('border', '1px solid red');
                    $("#error").html("This username or nickname is already in use.<br>Please pick a different one and try again");
                    $("#error").css('color','red');
                  } else if($result.status == "empty") {
                    $("#userName").css('border', '1px solid red');
                    $("#password").css('border', '1px solid red');
                    $("#nickName").css('border', '1px solid red');
                    $("#error").html("Please complete the fields above and try again");
                    $("#error").css('color','red');
                  } else if($result.status == "success"){	
                    console.log("Redirect after session starts");
                    window.location.href="/index.html";
          	  }
            },
            error: function(status,exception) {
          	  console.log(status);
          	  console.log(exception);
              }
      });
}