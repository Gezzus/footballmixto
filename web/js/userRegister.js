 function userRegister(){
      $.ajax({
          url: "../src/api/registerHandler.php", 
          type: "POST",
          data: {
              username: $( "#username" ).html(),
              password: $( "#password" ).html(),
              nickname: $( "#nickname" ).html(),
              gender:   $( "#gender" ).html(),
              //skill:    $( "#skill" ).html(),
              //email: $( "#email" ).html()
            },
          dataType: "html",
          async: false,
          success: function(result){
                console.log(result);
                var received_response = JSON.parse(result);

                if(received_response.code==1){
                  //console.log(received_response.code);
                  $("#username").css('border', '1px solid red');
                  $("#password").css('border', '1px solid red');
                  $("#nickname").css('border', '1px solid red');
                  $("#error").html("Please complete the missing fields in order to register");
                } else if(received_response.code==2){
                  //console.log("2"+received_response);
                  $("#username").css('border', '1px solid red');
                  $("#error").html("The provided username already exists.<br>Please use a different one.");
                } else{
                  console.log(received_response);
                  console.log(result);
                }
          },
          error: function(status,exception){
            console.log(status);
            console.log(exception);
            }
      });
}