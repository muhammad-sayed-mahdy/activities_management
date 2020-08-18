<html lang="en">
<title>Task1</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/activities_management.css') }}" />

<style>
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>
<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <img src="/images/Logo-new.png" alt="logo" style="width:90%">
    <h3 class="w3-padding-32" style="color:#2E3091"><b>Employees Management System</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Activities Management</a>
    <a href="Tasks" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Tasks</a>
    <a href="Customers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Customers</a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Employees Management System</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->

<!-- !Top Bar! -->
<div class="navbar">
  <a class="active" href="#"><i class="fa fa-fw fa-bell"></i>Notifications</a>
  <a href="#"><i class="fa fa-fw fa-search"></i> Search</a>
  <a href="#"><i class="fa fa-fw fa-envelope"></i> Mail</a>
  <a href="#"><i class="fa fa-fw fa-user"></i> Dr. Mahmoud</a>
</div>

<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
  <div class="w3-container" style="margin-top:80px" id="showcase">
    <h1 class="w3-jumbo"><b>Activities Management</b></h1>
    <h1 class="w3-xxxlarge w3-text-red"><b>Current Activity</b></h1>
    <hr style="width:50px;border:5px solid red;float:left;" class="w3-round">
  </div>

  <!-- Table -->
<button class="button button1">Save Draft</button>    <!-- to can re-edite the activity and timer stop -->
<button class="button button2" id="start" onclick="change()">Start Activity</button> <!-- start timer again -->
<button class="button button3">End Activity</button> <!-- end timer and close activity, edite not allowed -->
<button class="button button4">End Task</button> <!-- add new activity for this task id not allowed -->
<button class="add_delete"><i class="fa fa-fw fa-plus"></i>New Activity</button> <!-- add new activity for same task id -->
<button class="add_delete" onclick="showAndHide()"><i class="fa fa-fw fa-exchange"></i>Change Activity</button> <!-- view or edite actvity -->

<!-- lists -->
<div id="show_hide" style="display:none;">
	<select class="cars car" id="cars" size=4>
	  <option value="volvo" class="cars" disabled selected>Choose Activity:</option>
	  <option value="saab" class="cars">Code Activity-Title</option>
	  <option value="opel" class="cars">Code Activity-Title</option>
	  <option value="audi" class="cars">Code Activity-Title</option>
	</select>
</div>

  <div>
      <h3>Select Task</h3>
    <select class="mm">
      <option value="" disabled selected class="mm">Choose your task</option>
      <option value="1" class="mm">Code1 Task-Title</option>
      <option value="2" class="mm">Code2 Task-Title</option>
      <option value="3" class="mm">Code3 Task-Title</option>
    </select>
  </div>

    <div>
      <h3>Select Customer</h3>
    <select class="mm">
      <option value="" disabled selected class="mm">Choose your customer</option>
      <option value="1" class="mm">Code1 Customer-Name</option>
      <option value="2" class="mm">Code2 Customer-Name</option>
      <option value="3" class="mm">Code3 Customer-Name</option>
    </select>
  </div>


 <form>
  <h3 for="fname" >Activity Title</h3>
  <input type="text" id="fname" name="fname" style="width:65%;height:50px;">
  <h3 for="lname">Activity Description</h3>
  <textarea  id="lname" name="lname" class="textArea"></textarea>
  <h3 for="lname">Activity Points</h3>
  <textarea  id="lname" name="lname" class="textArea"></textarea>
</form>

<div style="margin-top:20px;padding-right:58px">
<button><i class="fa fa-fw fa-cloud-upload" style="font-size:20px;"></i>Upload Attachments</button>
</div>

    <div>
        <label>attachment1.png</label>
        <button style="background-color:Transparent;border: none;cursor:default;"><i class="fa fa-fw fa-minus-circle" style="font-size:20px;color:red;"></i></button>
    </div>
    <div>
        <label>attachment2.txt</label>
        <button style="background-color:Transparent;border: none;cursor:default;"><i class="fa fa-fw fa-minus-circle" style="font-size:20px;color:red;"></i></button>
    </div>
<!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">© Copyright <a href="https://www.robot-valley.com" title="W3.CSS" target="_blank" class="w3-hover-opacity">Robot-Valley</a></p></div>

</body>

<script type = "text/JavaScript">
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

function selectedRow(){

                var index,
                    table = document.getElementById("main");

                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         // remove the background from the previous selected row
                        if(typeof index !== "undefined"){
                           table.rows[index].classList.toggle("selected");
                        }
                        console.log(typeof index);
                        // get the selected row index
                        index = this.rowIndex;
                        // add class selected to the row
                        this.classList.toggle("selected");
                        console.log(typeof index);
                     };
                }

            }
selectedRow();

function showAndHide() {
  var x = document.getElementById("show_hide");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

</script>

</html>
