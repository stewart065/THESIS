<?php
session_start();
require 'config.php';
if (empty($_SESSION['TYPE'])) {
  if($_SESSION['TYPE'] != "ADMIN" )
  {
  header("Location: login.php");
  exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
      
        <title>Inquires | Trans-Master APARORS</title>
        <link rel="shortcut icon" href="pictures/logo.png" type="image/x-icon">

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
            <h1 class="navbar-brand ps-3">TRANS-MASTER</h1>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
             
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php?logout'">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <br>
                            <a class="nav-link " href="Dashboard.php">
                                <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <hr>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fas fa-user-friends'></i></div>
                                List of Account
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_admin.php">Admin Account</a>
                                    <a class="nav-link" href="List_customer.php">Customer Account</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="List_employee.php">
                                <div class="sb-nav-link-icon"><i class='fa fa-users'></i></div>
                               List of Employee
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInventory" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fa fa-list'></i></div>
                                INVENTORY
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseInventory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_product.php">Product available</a>
                                    <a class="nav-link" href="List_sold.php">Product Sold</a>
                                </nav>
                            </div>
                            <hr>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsetransaction" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class='fa-solid fa-list-check'></i></div>
                                TRANSACTION
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsetransaction" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="List_product_transaction.php">Product Transaction</a>
                                    <a class="nav-link" href="List_repair_transaction.php">Repair Transaction</a>
                                </nav>
                            </div>
                            <!-- <div class="sb-sidenav-menu-heading">Addons</div> -->
                            <hr>
                            <a class="nav-link text-light" href="List_inquires.php">
                                <div class="sb-nav-link-icon text-light"><i class='fa fa-envelope'></i></div>
                                Inquires
                            </a>
                            <a class="nav-link" href="List_reviews.php">
                                <div class="sb-nav-link-icon "><i class='fa-solid fa-check-to-slot'></i></div>
                                Reviews
                            </a>
                        </div>
                    </div>
                    <?php
                        $sql = "SELECT * from users WHERE customer_id =".$_SESSION['Id'];  
                        $query= $con->query($sql)or die($con->error);
                        while ($row = $query->fetch_assoc()) 
                        {
                    ?>  
                    <div class="sb-sidenav-footer">
                        <div class="small ">Logged in as: <b class="text-light"><?php echo $row['username'];?></b></div>
                    </div>
                    <?php }?> 
                </nav>
            </div>

        </div>
        <div class="container  mt-5">



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                       New room
                    </h5>
                    <button type="button" class="btn-close wew" data-bs-dismiss="modal" aria-label="Close"></button>
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






      <div class="scrollmenu2" >
<template   id="roomTemplate">
<div class="img d-flex position-relative">

<img  src="t.jpg"  class="roomImg position-relative"   height="100" width="100" >

<span class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger" style="border:1px solid white;">hi</span>

</div>
</template>


</div>










                
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
        var typing=false;
var roomId=0;
var id=0;
var i=1;
var initMsgId;
var scrolling=false;
var newR=0;
var pm=false;
const r=0;
logStat();
loadRoom();



document.querySelector("#male").click();
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

var options = $('#categoryCreate option'); var values = $.map(options ,function(option) { return option.value; });

$("#btnAdd").click(function(){
var l= $('#categoryCreate :selected').length;
 
newRoom();

$("#exampleModal").modal("toggle");
var options = $('#categoryCreate option:selected'); var values = $.map(options ,function(option) {newRoomadd(option.value); 

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
 result.forEach(item => {
	         
 	let clone = template.content.cloneNode(true);


clone.querySelector("div.img img.roomImg").setAttribute("data-categoryid", item.roomId);

clone.querySelector("div.img .roomImg").setAttribute("src","profiles/"+ item.profile);


if(item.seen>0){

clone.querySelector("div.img span").innerHTML=item.seen;

clone.querySelector("div.img span").classList.add("seen"+item.roomId);

  
}else{
  clone.querySelector("div.img span").style.display="none";

}
	
clone.querySelector("div.img img.roomImg").onclick=function(){

var room = $(this).data('categoryid');
roomId=room;

showMessage();
showMessage();

	removeTyping();


initMsgId=0;
	
	
$(".roomImg").css("border","none");

$(this).css("border","4px solid white");


roomId=room;
document.querySelector(".seen"+room).style.opacity=0;

setSeen(room);


}
	if(i==1){
clone.querySelector("div.img img.roomImg").click();
}
i++;


  parent.append(clone);



	              });


        });


}


function asR(id){
alert(id);
r=id;
}

function logStat(){
$.ajax({
                url : "stat.php",
               
            })
            .done(function(data){
let result = JSON.parse(data);
if(result.res=="error"){
  
window.location.href="index.php";
}
else{

id=result.res;
}         

                
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





	       if(item.sentBy	!=id){
	received(item.firstname+"  "+item.lastname,item.mes);}
else{

send(item.mes);
    }

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




function setSeen(id){
$.ajax({
url:"msg.setSeen.php",
type:"GET",
data:{
room:id
}

}).done(function(data){

	i=1;
 removeRooms();
loadRoom();
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


</script>
</html>

<style>
      #a{
        color:black;
        text-decoration: none;
    }
    html {
    scroll-behavior: smooth;
}

html ::-webkit-scrollbar {
    width: 0;
    background-color: #111d2c;
    cursor: pointer;
}


 body{
height:auto;
width:100%;

}

.container{
   
display:flex;
flex-direction:column;
align-items:center;
padding-bottom:2%;
}


#chatBox{
height:350px;
width:50%;
background-color:#f5f5f5;
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

.tidot:nth-child(1)
{
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


.wew{
height:100%;
width:100%;

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


.scrollmenu2{
margin-top:55px;
height:100px;
width:50%;
display:flex;
align-items:center;
background-color:#ed5450;
overflow-y:hidden;
overflow-x:auto;
}


.img{
width:auto;
margin-left:	20px;
}
.roomImg{
max-height:70px;
max-width:70px;
border-radius:50%;
background-color:white;
display:inline-block; 
vertical-align:middle;

}

.hide{
display:none;

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

input[type="radio"]
{
  appearance: none;
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
background-color:	#f5f5f5;
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


.wew{
height:100%;
width:100%;

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

.scrollmenu2{

height:130px;
width:100%;
display:flex;
align-items:center;
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




} */


</style>