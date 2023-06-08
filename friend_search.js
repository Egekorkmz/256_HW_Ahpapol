function sanitize(string) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F;',
    };
    const reg = /[&<>"'/]/ig;
    return string.replace(reg, (match)=>(map[match]));
}

$(function(){
    

    //search + display
    $("#searchbtn").click(function(e){
        e.preventDefault();
        $("#errorpart").html(" ")
        var text=$("#tosearch").val();
        var fil=$("#filter-opt").val();
        var u_id=$("#userid").attr("class");

        text=sanitize(text)
        if(text==""){
            $("#errorpart").html("Please fill the field")
            $("#errorpart").css("color","red")
        }
        else{
            $("#errorpart").html(" ")
            $.ajax({
                url: './backend-api.php', // PHP script URL
                method: 'FINDUSER', // Use GET method
                data: JSON.stringify({filter:fil,keyword:text,userId:u_id}), // Send data as query parameters
                contentType: "application/json",
                //dataType: 'json',
                success: function(response) {
                  // Handle the response
                  if(response.length<1){
                    $("#errorpart").html("No users found")
                    $("#errorpart").css("color","black")
                  }
                  displayFriends(response);
                },
                error: function(xhr, status, error) {
                  // Handle errors, if any
                  console.log("fail");
                }
              });
        }

       
    });

    $(".friends-part").on("click",".addFriend",function(){
        var u_id=$("#userid").attr("class");
        var f_id=$(this).attr("id");
        var button=$(this);
        console.log("clicked "+f_id+" "+u_id);
        $.ajax({
            url: './backend-api.php', // PHP script URL
            method: 'POSTREQUEST', // Usse GET method
            //cache:false,
            data: JSON.stringify({ receiver:f_id, sender:u_id,type: 1}), // Send data as query parameters
            contentType: "application/json",
            dataType: 'json',
            success: function(response) {
              // Handle the response
                console.log(response)
                $("#result").html("Friend request is sent");
                $("#result").css("color","green");
                button.css("background-color","green");
                button.css("pointer-events","none");

            },
            error: function(xhr, status, error) {
              // Handle errors, if any
              console.log(error);
              $("#result").html("Friend request couldn't sent");
              $("#result").css("color","red");
            }
          });
    })

    

    $("#go_back").click(function() {
        window.location = "./main_page.php"
    })


})

//insert yaptıktan sonra click eventlerini bind laman lazım yoksa çalışmıyor
function displayFriends(result){
    var u_id=$("#userid").attr("class");
    $(".friends-part").html("");
    for(var fr of result){
        if(fr["user_id"]!=u_id){
            var picture= fr["profile_picture"] ?? "default.png";  
            $(".friends-part").append(`
            <div class="friend">
                <img src= "images/`+picture+`" >
                <p>`+fr["first_name"]+" "+fr["last_name"]+`</p>
                <div id="`+fr["user_id"]+`" class="addFriend">+</div>
           </div>
            `);
        }
    }
}
