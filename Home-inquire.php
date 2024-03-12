<?php
session_start();
require 'config.php';
if (empty($_SESSION['TYPE'])) {
  if($_SESSION['TYPE'] != "CUSTOMER" )
  {
  header("Location: login.php");
  exit();
  }
}


if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `product` WHERE CONCAT(`product_id`, `product_name`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `product`";
    $search_result = filterTable($query);
}

// function to connect and execute the query            
function filterTable($query)
{
    $con = mysqli_connect("localhost", "root", "", "capstone");
    $filter_Result = mysqli_query($con, $query);
    return $filter_Result;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Inquire  | Trans-Master APARORS</title>
    <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="topbar">
    <div class="container-fluid text-white">
        <!-- <a class="navbar-brand" href="#">Transmaster</a> -->
        <h4 class="fw-bold">TRANS-MASTER</h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <!-- Left Element -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class=" me-auto mb-2 mb-lg-0">
                <form class="d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="Home.php" method="post">
            </form>
            </ul> 
        </div>
        <div class="collapse navbar-collapse ariban" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">
                <li  ><a href="Home.php" class="nav-link fw-bold ariban">Home</a></li>
                <li class="dropdown">
                    <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">       
                    Reservation
                    </a>
                    <ul class="dropdown-menu justify-content-left ">
                        <li> <a href="Home_product_reservation.php"><button class="dropdown-item" type="button">Product</button></a></li>
                        <li> <a href="Home_repair_reservation.php"><button class="dropdown-item" type="button">Repair</button></a></li>
                    </ul>
                </li>
                <li > <a href="Home_rate.php" class="nav-link fw-bold ariban"> To rate</a></li>
                <li > <a href="Home_rated_product.php" class="nav-link fw-bold ariban">Reviews</a></li>
            </ul>
        </div>
        <div class="collapse navbar-collapse ariban " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-2">
                <li><a href="Home-cart.php" class="nav-link ariban" ><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li > <a href="Home-inquire.php" class="nav-link ariban"><i class="fa-solid fa-message"></i></a></li>
                <li class="dropdown">
                    <a class="nav-link ariban fw-bold dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">       
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    </a>
                    <ul class="dropdown-menu justify-content-left ">
                        <li> <a href="Home_history_product.php"><button class="dropdown-item" type="button">Product</button></a></li>
                        <li> <a href="Home_history_repair.php"><button class="dropdown-item" type="button">Repair</button></a></li>
                    </ul>
                </li>
                <?php              
                  $sql ="SELECT concat (firstname,' ',lastname) as `name` , profile FROM users WHERE customer_id =".$_SESSION['Id'];  
                  $search_result = $con->query($sql);
                   if (!$search_result) {
                    echo 'error';
                   }
                 while ($row = mysqli_fetch_object($search_result)) { 
                      $uname = $row->name;
                     $profile = $row->profile;

                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ariban eyy" id="navbarDropdown" href="#" role="button"
                     data-bs-toggle="dropdown" aria-expanded="false"> <img style="width:30px; height:30px;" 
                      class="rounded-circle"src="profiles/<?php echo $profile; ?>">
                      <?php echo $uname; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-dark" href="view-profile.php">My profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-dark" href="logout.php?logout'">Logout</a></li>
                    </ul>
                </li>
                <?php }?> 
            </ul>
        </div>
    </div>
</nav>
<div class="container  mt-5" >
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                       New room
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
<form id="rf">

<div id="body">
					
<div>
  <input type="radio" id="male" name="gender" value="pm">
  <label for="male">Private Message</label>
</div>

<div>
  <input type="radio" id="female" name="gender">
  <label for="female">Group</label>
</div>


</div>
					
<span>Users: </span>
 <select  class="form-control" id="categoryCreate">	
<template id="optionForCreateModal">
 <option>
</option> 
</template>
 
</select> 

				</form>
			</div>	



                
                <div class="modal-footer">

      <button type="button" class="btn btn-primary" id="btnAdd">Create Room</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              
                </div>
            </div>
            </div>


</div>




<!--

      <div class="scrollmenu2">
<template   id="roomTemplate">
<div class="img">
<img  src="t.jpg"  class="roomImg" height="100" width="100">
</div>
</template>


</div>
-->









                
    <div id="chatBox">

<template   id="typing">
      <div class="chatRow">
 
      <div class="ticontainer" >
  <div class="tiblock">
    <div class="tidot"></div>
    <div class="tidot"></div>
    <div class="tidot"></div>
  </div>
</div>


      </div>
</template>


<template   id="receive">
      <div class="chatRow2">
 
      <div class="ticontainer2" >

<h1  class="sa"> name</h1>
  <p> s</p>
        </div>


      </div>
</template>



<template   id="send">
      <div class="chatRow3">
 
      <div class="ticontainer3" >
  <p> s</p>
        </div>


      </div>
</template>


     </div>








<div id="inputDiv" >

   <div id="boxDiv">
 <input type="text" id="box" style="border: 1px solid white"></input>

   </div>




<div id="sendDiv" style="background-color:#ed5450;">

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Stock" id="sendbtn" style="background-color:#ed5450; border:none;">
            <i class="fa fa-paper-plane"></i>
        </button>

   </div>

    



</div>


</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
var typing=false;
var roomId=0;
var id=0;
var initMsgId=0;
var scrolling=false;
var newR=0;
var pm=false;
logStat();
myRoomId();
document.querySelector("#male").click();
var greeted=false;

setTimeout(function(){ 
showMessage();



loop();

},1);


$("#male").click(function(){
$("#categoryCreate").prop("multiple",false);
pm=true;
});



$("#female").click(function(){

$("#categoryCreate").prop("multiple",true);

pm=false;
});



$("#box").focus(function(){
setTyping(true);
});

$("#box").focusin(function(){
scrolling=true;
});


$("#box").focusout(function(){
scrolling=false;
$('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);

});

$("#box").focusout(function(){

setTyping(false);
});

var options = $('#categoryCreate option'); var values = $.map(options ,function(option) { return option.value; });




function logStat(){
$.ajax({
                url : "stat.php",
               
            })
            .done(function(data){
let result = JSON.parse(data);
if(result.res=="error"){
  
window.location.href="index.html";
}
else{

id=result.res;
}         

                
});

}







function newRoomId(){
var rid;
$.ajax({
                url : "newRoomId.php"
            })
            .done(function(data){
let result = JSON.parse(data);
newR=result.res;


  });

}



function myRoomId(){
var rid;
$.ajax({
                url : "myRoomId.php"
            })
            .done(function(data){
let result = JSON.parse(data);

if(result.res=="error"){
	
	
newRoom();
myRoomId();
Greetings();
}else{
roomId=result.res;

}
  });

}



$("#btnAdd").click(function(){
var l= $('#categoryCreate :selected').length;
 


newRoom();

$("#exampleModal").modal("toggle");
var options = $('#categoryCreate option:selected'); 
	var values = $.map(options ,function(option) {
newRoomadd(option.value); 

removeRooms();
loadRoom();
});


}  );

function newRoom(){
$.ajax({
                url : "newRoom.php"
            })
            .done(function(data){

  });


}



function newRoomadd(n){
$.ajax({
                url : "newRoom2.php",
               type:"GET",
                data:{
               user2: n
                  }
            })
            .done(function(data){

  });


}

  




function loadRoom(){

  $.ajax({


           url : "rooms.php"




         })
            .done(function(data){
let result = JSON.parse(data);


var template = document.querySelector("#roomTemplate");

var parent = document.querySelector(".scrollmenu2");

                var i=1;
 result.forEach(item => {
	         
 	let clone =        template.content.cloneNode(true);


clone.querySelector("div.img img.roomImg").setAttribute("data-categoryid", item.roomId);

clone.querySelector("div.img .roomImg").setAttribute("src","uploads/"+ item.Pic);





clone.querySelector("div.img img.roomImg").onclick=function(){

var room = $(this).data('categoryid');


showMessage();
showMessage();

	removeTyping();

 roomId=0;
initMsgId=0;
	
	
$(".roomImg").css("border","none");

$(this).css("border","4px solid white");


roomId=room;



}




if(i==1){
clone.querySelector("div.img img.roomImg").click();
}
i++;

  parent.append(clone);



	              });


        });


}



function showMessage(){
var s =parseInt(initMsgId);
$.ajax({
                url : "message.php",
               type:"GET",
               data:{
               room:roomId,
               init:s

             },
cache: false
            })
            .done(function(data){
let result = JSON.parse(data);




removeTyping();

        result.forEach(item => {


if(initMsgId<item.id){
//initMsgId=item.Id;

	       if(item.sentBy==id){
	
	
  send(item.mes);

}
else{
  received("Trans-Master",item.mes);

    }
	}
	
	if(greeted==false){
// Greetings();
greeted=true;
}

// alert('success');
if(scrolling==false){
$('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);

}

});

  });
}

function load(){

$.ajax({
                url : "msg.get.php",
               type:"GET",
               data:{
               room:roomId

             }
            })
            .done(function(data){
let result = JSON.parse(data);

                

                result.forEach(item => {

	         var typeid= item.typingAt;
/*
	  if(typeid==roomId){

   if(!typing){

  
		showTyping();
   typing=true;

    }

		}

    else{
    if(typing){
   
			removeTyping();
   typing=false;}

			}*/
	



	         });

});


}
  
function received(k,n){

var template = document.querySelector("#receive");

var parent = document.querySelector("#chatBox");

let clone = template.content.cloneNode(true);

clone.querySelector("div.chatRow2 div.ticontainer2 p").innerHTML=n;

clone.querySelector("div.chatRow2 div.ticontainer2 h1").innerHTML=k;

parent.append(clone);

}



function send(n){

var template = document.querySelector("#send");

var parent = document.querySelector("#chatBox");

let clone = template.content.cloneNode(true);

clone.querySelector("div.chatRow3 div.ticontainer3 p").innerHTML=n;

parent.append(clone);

}




function showTyping(){
var template = document.querySelector("#typing");

var parent = document.querySelector("#chatBox");

let clone = template.content.cloneNode(true);

parent.append(clone);

}


function removeTyping(){

var parent = document.querySelector("#chatBox");
var template2 = document.querySelector("#receive");


var template3 = document.querySelector("#send");


var template = document.querySelector("#typing");


while(parent.firstChild) { 
parent.removeChild(parent.lastChild);
 }

/*
var child =parent.querySelector('#typing');
parent.removeChild(child);*/
parent.append(template2);
parent.append(template3);

}


function removeRooms(){

var parent = document.querySelector(".scrollmenu2");


var template = document.querySelector("#roomTemplate");


while(parent.firstChild) { 
parent.removeChild(parent.lastChild);
 }

parent.append(template);

}










function loop(){
setTimeout(function(){ 
showMessage();

loop();

},1);
}



function setTyping(n){
var stat=0;
if(n){
stat=roomId;

}
$.ajax({
                    url  : "msg.update.php",
                    type : "GET",
                    data :  {
                      type :stat,
Id :roomId
                    }
                })
                .done(function(data){
              
});

}


function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}





$("#sendbtn").click(function(){

var mess = document.querySelector("#box").value;
if(mess==""){
alert("empty");
}else{



$.ajax({
                url : "send.php",
               type:"GET",
               data:{
               room:roomId,
              mes:mess
             }
            })
            .done(function(data){
let result = JSON.parse(data);



   
});



document.querySelector("#box").value="";
}


});



function Greetings(){
$.ajax({
url:"msg.recentDate.php"



})
.done(function(data){

var result=JSON.parse(data);
if(result.res=="Yes"){
	
	received("Good Day Sir/ma'am! How can we help you");
	
	}



});
}

</script>
</html>
<style>
  #topbar{
    background: radial-gradient(
    56.58% 56.58% at 50.09% 39.71%,
    #ed5450 27.08%,
    #bd1e2e 100%
  );
  }
    
    .eyy{
      font-size:10px;
    }
 
  a{
    text-decoration:none; 
  }
       .ariban{
        color:white;
    }
    .ariban li a:hover{
        color:white;
        border-bottom: 3px solid #00f;
    }


    body{
height:auto;
width:100%;
}
.container{
display:flex;
flex-direction:column;
align-items:center;
}
#chatBox{
height:350px;
width:50%;
overflow-y:auto;
border:1px solid #ed5450;
}
.chatRow{
width:100%;
height:70px;
background-color:black;
display:flex;
align-items:center;
transition:1.5s;
}
.chatRow2{
width:100%;
height:auto;
padding:10px;
display:flex;
align-items:center;
transition:1.5s;
}
.chatRow3{
width:100%;
height:auto;
padding:10px;
display:flex;
flex-direction:row-reverse;
align-items:center;
transition:1.5s;
}
.tiblock {
    align-items: center;
    display: flex;
    height: 100%;
}
.ticontainer{
height:40%;
background-color:white;
width:20%;
padding-left:5%;
margin-left:5%;
border-radius: 2px 13px 13px 13px;
}
.ticontainer2{
height:auto;
background-color:white;
width:auto;
max-width:55%;
padding-left:2%;
margin-left:2%;
padding-top:1%;
padding-right:1%;
border-radius: 2px 13px 13px 13px;
}
.ticontainer3{
height:auto;
background-color:#adbce6;
width:auto;
max-width:55%;
padding-left:2%;
padding-right:2%;
margin-left:2%;
padding-top:1%;
border-radius: 13px 2px 13px 13px;
}
.ticontainer .tidot {
    background-color: #90949c;
}
.tidot {
    -webkit-animation: mercuryTypingAnimation 1.5s infinite ease-in-out;
    border-radius: 50%;
    display: inline-block;
    height:25%;
    margin-right: 2%;
    width: 15%;
}
@-webkit-keyframes mercuryTypingAnimation{
0%{
  -webkit-transform:translateY(0px)
}
28%{
  -webkit-transform:translateY(-5px)
}
44%{
  -webkit-transform:translateY(0px)
}
}
.tidot:nth-child(1){
-webkit-animation-delay:200ms;
}
.tidot:nth-child(2){
-webkit-animation-delay:300ms;
}
.tidot:nth-child(3){
-webkit-animation-delay:400ms;
}
#inputDiv{
width:50%;
height:50px;
display:flex;
align-items:center;
}
#boxDiv{
 background-color:#ed5450;
width:70%;
height:100%;
display:flex;
justify-content:center;
align-items:center;
}
input{
box-sizing:border-box;
width:95%;
background-color:white;
height:85%;
}
#sendDiv{
width:30%;
height:100%;
display:flex;
align-items:center;
justify-content:center;
box-sizing:border-box;
background-color:white;   
}
.btn{
height:100%;
width:100%;
}
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
.sa{
	font-size:9px;
	font-weight:900;
	}
#body{
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: system-ui, sans-serif;
}
input[type="radio"] + label
{
  cursor: pointer;
  position: relative;
  padding-left: 30px;
  line-height: 20px;
}
input[type="radio"] + label::before
{
  content: "";
  display: inline-block;
  width: 20px;
  aspect-ratio: 1;
  border: 1px solid #686de0;
  border-radius: 50%;
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  opacity: 1;
  transition: all 0.3s;
}
input[type="radio"] + label::after
{
  content: "";
  display: inline-block;
  width: 10px;
  aspect-ratio: 1;
  border: 1px solid #686de0;
  background: #686de0;
  border-radius: 50%;
  position: absolute;
  left: 5px;
  top: 50%;
  transform: translateY(-50%);
  opacity: 0;
  transition: all 0.3s;
}
input[type="radio"]:checked + label::after
{
  opacity: 1;
}


@media screen and (min-width: 320px) and (max-width: 480px) {
  #chatBox{
height:500px;
width:100%;
overflow-y:auto;
}
.chatRow{
width:100%;
height:70px;
background-color:black;
display:flex;
align-items:center;
transition:1.5s;
}
.chatRow2{
width:100%;
height:auto;
padding:10px;
display:flex;
align-items:center;
transition:1.5s;
}
.chatRow3{
width:100%;
height:auto;
padding:10px;
display:flex;
flex-direction:row-reverse;
align-items:center;
transition:1.5s;
}
.tiblock {
    align-items: center;
    display: flex;
    height: 100%;
}
.ticontainer{
height:40%;
background-color:white;
width:20%;
padding-left:5%;
margin-left:5%;
border-radius: 2px 13px 13px 13px;
}
.ticontainer2{
height:auto;
background-color:white;
width:auto;
max-width:55%;
padding-left:2%;
margin-left:2%;
padding-top:1%;
padding-right:1%;
border-radius: 2px 13px 13px 13px;
}
.ticontainer3{
height:auto;
background-color:#adbce6;
width:auto;
max-width:55%;
padding-left:2%;
padding-right:2%;
margin-left:2%;
padding-top:1%;
border-radius: 13px 2px 13px 13px;
}
.ticontainer .tidot {
    background-color: #90949c;
}
.tidot {
    -webkit-animation: mercuryTypingAnimation 1.5s infinite ease-in-out;
    border-radius: 50%;
    display: inline-block;
    height:25%;
    margin-right: 2%;
    width: 15%;
}
@-webkit-keyframes mercuryTypingAnimation{
0%{
  -webkit-transform:translateY(0px)
}
28%{
  -webkit-transform:translateY(-5px)
}
44%{
  -webkit-transform:translateY(0px)
}
}
.tidot:nth-child(1){
-webkit-animation-delay:200ms;
}
.tidot:nth-child(2){
-webkit-animation-delay:300ms;
}
.tidot:nth-child(3){
-webkit-animation-delay:400ms;
}
#inputDiv{
width:100%;
height:72px;
background-color:yellow;
display:flex;
align-items:center;
}
#boxDiv{
width:70%;
height:100%;
display:flex;
justify-content:center;
align-items:center;
}
input{
box-sizing:border-box;
width:95%;
background-color:white;
height:85%;
}
#sendDiv{
width:30%;
height:100%;
display:flex;
align-items:center;
justify-content:center;
box-sizing:border-box;  
background-color:white;
}
.btn{
height:100%;
width:100%;
}
i{
font-size:28px;

}
.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}
.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}
.sidebar a:hover {
  color: #f1f1f1;
}
p{
width:100%;
height:100%;
overflow-wrap:break-word;
}
.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color:white;
  color: white;
  padding: 10px 15px;
  border: none;
}
.openbtn:hover {
  background-color: #444;
}
#main {
  transition: margin-left .5s;
  padding: 16px;
}
navbar{
background-color:#adbce6;
}
.scrollmenu2{
height:130px;
width:100%;
display:flex;
align-items:center;
background-color:#adbce6;	
overflow-y:hidden;
overflow-x:auto;
}
.img{
width:auto;
margin-left:	20px;
}
.roomImg{
max-height:100px;
max-width:100px;
border-radius:50%;
display:inline-block; vertical-align:middle;
}
.hide{
display:none;

}
.sa{
	font-size:9px;
	font-weight:900;
	}
#body{
 
  height: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: system-ui, sans-serif;
}
}
</style>
