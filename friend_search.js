$(function(){
    $("#main-page").click(function() {
        window.location = "./main_page.php"
    })

    //search + display
    $("#searchbtn").click(function(e){
        e.preventDefault();
        var text=$("#tosearch").val();
        var fil=$("#filter-opt").val();
        $.ajax({
            url: './backend-api.php', // PHP script URL
            method: 'FINDUSER', // Use GET method
            data: JSON.stringify({filter:fil,keyword:text}), // Send data as query parameters
            contentType: "application/json",
            //dataType: 'json',
            success: function(response) {
              // Handle the response
              displayFriends(response);
            },
            error: function(xhr, status, error) {
              // Handle errors, if any
              console.log("fail");
            }
          });
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
            data: JSON.stringify({ receiver:f_id, sender:u_id,type: 0}), // Send data as query parameters
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

    $i=1;
    $(`#notifications`).on(`click`, function(){
        console.log("notification")
        $(".pop").css("visibility", "collapse");
        $i++;
        $("#pop_not").css("visibility", "visible");
        if($i%2==1){
            $("#pop_not").css("visibility", "collapse");
        }
    });
    $i=1;
    $(`#friends`).on(`click`, function(){
        console.log("friend")
        $(".pop").css("visibility", "collapse");
        $i++;
        $("#pop_frnds").css("visibility", "visible");
        if($i%2==1){
            $("#pop_frnds").css("visibility", "collapse");
        }
    });

    $("#log_out").click(function() {
        window.location = "./Login-Register/logout.php"
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
