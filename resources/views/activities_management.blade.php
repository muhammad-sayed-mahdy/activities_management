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

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
<button class="button button1 disabled" disabled form="activity_inputs" id="saveButton">Save Draft</button>    <!-- to can re-edite the activity and timer stop -->
<button class="button button2 disabled" disabled id="startButton" onclick="change()">Start Activity</button> <!-- start timer again -->
<button class="button button3 disabled" disabled id="endActivityButton">End Activity</button> <!-- end timer and close activity, edite not allowed -->
<button class="button button4 disabled" disabled id="endTaskButton">End Task</button> <!-- add new activity for this task id not allowed -->
<button class="add_delete" id="newActivityButton" form="new_activity"><i class="fa fa-fw fa-plus"></i>New Activity</button> <!-- add new activity for same task id -->
<button class="add_delete" id="changeActivityButton" onclick="showAndHide()"><i class="fa fa-fw fa-exchange"></i>Change Activity</button> <!-- view or edite actvity -->

<!-- lists -->
<div id="show_hide" style="display:none;">
	<select class="cars car" id="change_activity" form="activity_inputs" name="id" size=4>
    <option value="" class="cars" disabled selected>Choose Activity:</option>
    @foreach ($activities as $activity)
      <option value="{{$activity->id}}" class="cars">{{$activity->id}} {{$activity->title}}</option>  
    @endforeach
	</select>
</div>

@error('id')
    <p class="is_danger">You must select a valid activity</p>
@enderror

@error('activity')
  <p class="is_danger">{{$message}}</p>
@enderror

@error('attachments')
  <p class="is_danger">{{$message}}</p>
@enderror

  <div>
      <h3>Select Task</h3>
      @error('task_id')
          <p class="is_danger">{{ $message }}</p>
      @enderror
    <select class="mm" form="activity_inputs" id="task_id" name="task_id">
      <option value="" disabled selected class="mm" id="default_task">Choose your task</option>
      @foreach ($tasks as $task)
        <option value="{{$task->id}}" id="task_{{$task->id}}" class="cars">{{$task->id}} {{$task->title}}</option>  
      @endforeach
    </select>
  </div>

    <div>
      <h3>Select Customer</h3>
      @error('customer_id')
          <p class="is_danger">{{ $message }}</p>
      @enderror
    <select class="mm" form="activity_inputs" id="customer_id" name="customer_id">
      <option value="" disabled selected class="mm" id="default_customer">Choose your customer</option>
      @foreach ($customers as $customer)
        <option value="{{$customer->id}}" id="customer_{{$customer->id}}" class="cars">{{$customer->id}} {{$customer->name}}</option>  
      @endforeach
    </select>
  </div>

  <form action="/" method="POST" id="new_activity">
    @csrf
  </form>

 <form action="/" method="POST" id="activity_inputs" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <h3 for="title" >Activity Title</h3>
  @error('title')
          <p class="is_danger">{{ $message }}</p>
  @enderror
  <input type="text" id="title" name="title" style="width:65%;height:50px;">
  <h3 for="description">Activity Description</h3>
  @error('description')
          <p class="is_danger">{{ $message }}</p>
  @enderror
  <textarea  id="description" name="description" class="textArea"></textarea>
  <h3 for="points">Activity Points</h3>
  @error('points')
          <p class="is_danger">{{ $message }}</p>
  @enderror
  <textarea  id="points" name="points" class="textArea"></textarea>
</form>

<div style="margin-top:20px;padding-right:58px">
  <input type="file" class="hidden" name="attachments[]" id="attachments" form="activity_inputs" multiple>
  <label for="attachments" class="custom-file-upload"><i class="fa fa-fw fa-cloud-upload" style="font-size:20px;"></i>Upload Attachments</label>
</div>

  <div id="attachments_area">
  </div>

  <p class="hidden" id="upload_info"><i class="fa fa-info-circle"></i> Save Draft to complete uploading attachments</p>
<!-- End page content -->
</div>

<!-- W3.CSS Container -->
<div class="w3-light-grey w3-container w3-padding-32" style="margin-top:75px;padding-right:58px"><p class="w3-right">© Copyright <a href="https://www.robot-valley.com" title="W3.CSS" target="_blank" class="w3-hover-opacity">Robot-Valley</a></p></div>

</body>

<script type = "text/JavaScript" src="{{url('js/app.js')}}"></script>

</html>
