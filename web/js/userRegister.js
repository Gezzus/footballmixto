 function userRegiser(){
      $.ajax({
          url: "../src/api/registerHandler.php", 
          type: "POST",
          data: {
              username: $( "#username" ).html(),
              password: $( "#password" ).html(),
              nickname: $( "#nickname" ).html(),
              gender:   $( "#gender" ).html(),
              skill:    $( "#skill" ).html(),
              email: $( "#email" ).html()
            },
          dataType: "html",
          async: false,
          success: function(result){
                var received_response = JSON.parse(result);
                if(received_response.code==200){
                  window.location="../web/index.php"; 
                }
                else{
                  $("#username").css('border', '1px solid red');
                  $("#error").html("The provided username already exists.<br>Please use a new one.");
                }
          },
          error: function(status,exception){
            console.log(status);
            console.log(exception);
            }
      });
}