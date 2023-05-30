
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <style>
        *{
            margin: 0px auto;
        }

        /*head*/
        .head{
            border-bottom: 10px solid black;
            height: 150px;
            background-color: #9600bf;
            display: flex;
            align-items: center;
        }

        .head div{
            margin-left: 50px;
        }

        .pp{
            border-radius: 50%;
            width: 100px;
            width: 100px;
        }

        #pp_picture{
            margin: 20px;
            margin-left: 50px;
        }

        /*container*/
        .container{
            border: 2px solid rgb(177, 177, 177);
            border-radius: 5px;
            width:500px;
            height:500px;
            margin: 20px auto;
            display:flex;
            flex-direction: column;
        }
        .container>*{
            align-items: center;
            text-align: center;
        }

        .timeline{
            width:500px;
            height:60px;
            padding:15px;
        }
        .timeline *{
            margin:5px;
            border-radius: 5px;
        }

        button:hover{background-color: #9600bf;}

        .friends-part{
           width:100%;
            height:440px;
            overflow-y: scroll;
           
        }

        .friend{
            display:flex;
            margin:2px auto;
            width:80%;
            height:60px;
            background-color: #d4d4d4;
            border-radius: 5px;
            align-items: center;
        }
         .friend img{width:50px;border-radius: 50px;}
        .friend div{
            display: flex;
            width: 10px;
            height: 10px;
            border-radius:20px;
            padding:10px;
            text-decoration: none;
            background-color:white;
            align-items: center;
            justify-content: center;
        }
        .friend div:hover{cursor:pointer;}
    </style>
    <script>
        $(function(){
         
            //search + display
            $("#searchbtn").click(function(e){
                e.preventDefault();
                var text=$("#tosearch").val();
                var filter=$("#filter-opt").val();
               // getResults(text,filter);
                $.ajax({
                    url: './try.php', // PHP script URL
                    method: 'GET', // Use GET method
                    //cache:false,
                    data: { afilter: text, filter_type: filter }, // Send data as query parameters
                    //dataType: 'json',
                    success: function(response) {
                      // Handle the response
                      result=JSON.parse(response);
                      console.log(result);
                      displayFriends(result);
                    },
                    error: function(xhr, status, error) {
                      // Handle errors, if any
                      console.log("fail");
                    }
                  });
            });

            $(".friends-part").on("click",".addFriend",function(){
                id=$(this).attr("id");
                console.log("clicked"+id);
                $.ajax({
                    url: './try.php', // PHP script URL
                    method: 'POST', // Use GET method
                    //cache:false,
                    data: { friend_id:id }, // Send data as query parameters
                    //dataType: 'json',
                    success: function(response) {
                      // Handle the response
                      //response=JSON.parse(response);
                        console.log(response)
                    },
                    error: function(xhr, status, error) {
                      // Handle errors, if any
                      console.log("fail");
                    }
                  });
            })
            
        })

        //insert yaptıktan sonra click eventlerini bind laman lazım yoksa çalışmıyor
        function displayFriends(result){
            $(".friends-part").html("");
            for(var fr of result){

                /*var friend=document.createElement("div");
                friend.innerHTML=`
                    <img src= "images/`+fr["profile_picture"]+`" >
                    <p>`+fr["first_name"]+" "+fr["last_name"]+`</p>
                `;
                friend.classList.add("friend");

                var link=document.createElement("div");
                link.innerHTML="+";
                link.classList.add(fr["user_id"]);
                link.onclick=()=>{
                    console.log("clicked");
                    $.ajax({
                        url: './try.php', // PHP script URL
                        method: 'POST', // Use GET method
                        //cache:false,
                        data: { id:fr["user_id"] }, // Send data as query parameters
                        //dataType: 'json',
                        success: function(response) {
                          // Handle the response
                          console.log("success");
                        },
                        error: function(xhr, status, error) {
                          // Handle errors, if any
                          console.log("fail");
                        }
                      });
                }

                friend.append(link);
                $(".friends-part").append(friend);*/

                $(".friends-part").append(`
                <div class="friend">
                    <img src= "images/`+fr["profile_picture"]+`" >
                    <p>`+fr["first_name"]+" "+fr["last_name"]+`</p>
                    <div id="`+fr["user_id"]+`" class="addFriend">+</div>
               </div>
                `);
            }
   
              
        }
       
    </script>
</head>
<body>
    
    <div class="head">
        <div>
            <a href="./timeline.html"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="pp" id="pp_picture"></a>
        </div>
        <div id="pp_info">
            <h4>John Doe</h4>
            <p>ssssssssssssssssssssssssssssssssssssss</p>
        </div>
    </div>
    <section class="container">
        <div class="timeline">
            <h4>Search For A Friend</h4>
            <input type="text" id="tosearch">
            <select name="filter-option" id="filter-opt">
                <option value="email">mail</option>
                <option value="first_name">first name</option>
                <option value="last_name">last name</option>
            </select>
            <button id="searchbtn">Search</button>
           
        </div>
        <div class="friends-part">
        
        </div>

    </section>
</body>
</html>