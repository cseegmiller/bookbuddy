<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Timer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        nav{
            padding-left: 100px!important;
            padding-right: 100px!important;
            background: #6665ee;
            font-family: 'Poppins', sans-serif;
        } 
        nav a.navbar-brand{
            color: #fff;
            font-size: 30px!important;
            font-weight: 500;
        }
        button a{
            color: #6665ee;
            font-weight: 500;
        }
        button a:hover{
            text-decoration: none;
        }
        .jumbotron {
        background-color: white;
        }
        .btn-light{
            background-color:#fff;
            border: 2px solid #6665ee;
        }
        .btn-primary{
            background-color: #6665ee;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Book Buddy</a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    
    <div class="container">
      <br><button type="button" class="btn btn-light"><a href="home.php">Go Back</a></button>
      
      <div class="jumbotron">
        <h1 class="display-4">Reading Timer</h1>
        <p class="lead">Keep track of how long you read and how many pages you read here!</p>
        <hr class="my-4">
        <h2 class="text-center"><span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span></h2>
            <script>
              window.onload = function () {
              
              var seconds = 00; 
              var minutes = 00; 
              var hours = 00; 
            
              var appendHours = document.getElementById("minutes")
              var appendMinutes = document.getElementById("minutes")
              var appendSeconds = document.getElementById("seconds")
              var buttonStart = document.getElementById('start');
              var buttonPause = document.getElementById('pause');
              var buttonStop = document.getElementById('stop');
              var Interval ;
            
              buttonStart.onclick = function() {  
                clearInterval(Interval);
                 Interval = setInterval(startTimer, 1000);
                buttonStart.disabled=true;
                buttonPause.disabled=false;
                buttonStop.disabled=false;
                if (buttonStart.className == "btn btn-lg btn-primary"){
                    buttonStart.className = "btn btn-lg btn-secondary";
                }
                if (buttonPause.className == "btn btn-lg btn-secondary"){
                    buttonPause.className = "btn btn-lg btn-primary";
                }
                if (buttonStop.className == "btn btn-lg btn-secondary"){
                    buttonStop.className = "btn btn-lg btn-primary";
                }
              }
              
              buttonPause.onclick = function() {
                clearInterval(Interval);
                buttonStart.disabled=false;
                buttonPause.disabled=true;
                buttonStop.disabled=false;
                if (buttonStart.className == "btn btn-lg btn-secondary"){
                    buttonStart.className = "btn btn-lg btn-primary";
                }
                if (buttonPause.className == "btn btn-lg btn-primary"){
                    buttonPause.className = "btn btn-lg btn-secondary";
                }
                if (buttonStop.className == "btn btn-lg btn-secondary"){
                    buttonStop.className = "btn btn-lg btn-primary";
                }
              }
              
              buttonStop.onclick = function() {
                clearInterval(Interval);
                hours = "00";
                minutes = "00";
                seconds = "00";
                appendHours.innerHTML = hours;
                appendMinutes.innerHTML = minutes;
                appendSeconds.innerHTML = seconds;
                buttonStart.disabled=false;
                buttonPause.disabled=true;
                buttonStop.disabled=true;
                if (buttonStart.className == "btn btn-lg btn-secondary"){
                    buttonStart.className = "btn btn-lg btn-primary";
                }
                if (buttonPause.className == "btn btn-lg btn-primary"){
                    buttonPause.className = "btn btn-lg btn-secondary";
                }
                if (buttonStop.className == "btn btn-lg btn-primary"){
                    buttonStop.className = "btn btn-lg btn-secondary";
                }
              }
              
              function startTimer () {
                seconds++; 
                if(seconds <= 9){
                  appendSeconds.innerHTML = "0" + seconds;
                }
                if (seconds > 9){
                  appendSeconds.innerHTML = seconds; 
                } 
                if (seconds > 59) {
                  minutes++;
                  appendMinutes.innerHTML = "0" + minutes;
                  seconds = 0;
                  appendSeconds.innerHTML = "0" + 0;
                }
                if (minutes > 9){
                  appendMinutes.innerHTML = minutes;
                }
                if (minutes > 59){
                    hours++;
                    appendHours.innerHTML = "0" + hours;
                    minutes = 0;
                }
              }
            
             }
            </script>
        <br>
        <div class="row justify-content-around">
          <!-- <button id="start" type="button" class="btn btn-lg btn-primary">Start Time</button> -->
          <button id="pause" type="button" class="btn btn-lg btn-secondary" disabled>Pause Time</button>
          <button id="stop" type="button" class="btn btn-lg btn-secondary" disabled>Stop Time</button>
        </div>
        <hr class="my-4">    
      </div>
    </div>
        
<!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Start Time</button>

<!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Start Time</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          
          <form action="timer.php" method="POST" autocomplete="">

            <div class="form-group">
              <label for="startPage" class="col-form-label">Starting page number:</label>
            </div>
            
            <div class="form-group">
                <input class="form-control" type="date" name="dateSubmit" placeholder="date" required value="<?php echo $dateSubmit ?>">
            </div>
            <div class = "form-group">
              <input class="form-control" type="text" name="startPage" placeholder="Write page number here" required value="<?php echo $startPage ?>">
            </div>
            <div class = "form-group">
              <input class="form-control" type="text" name="endPage" placeholder="Write page number here" required value="<?php echo $endPage ?>">
            </div>
            <div class = "form-group">
              <input class="form-control" type="text" name="totalPage" placeholder="Write page number here" required value="<?php echo $totalPage ?>">
            </div>
            <div class = "form-group">
              <input class="form-control" type="text" name="minutes" placeholder="Write page number here" required value="<?php echo $minutes ?>">
            </div>
            <div class="form-group">
              <input class="form-control button" type="submit" name="startTime" value="Submit">
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

</body>
</html>