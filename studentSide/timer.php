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
            
              var appendHours = document.getElementById("hours");
              var appendMinutes = document.getElementById("minutes");
              var appendSeconds = document.getElementById("seconds");
              var startButton = document.getElementById('startButton');
              var startTime = document.getElementById('startTime');
              var buttonPause = document.getElementById('pause');
              var stopButton = document.getElementById('stopButton');
              var stopTime = document.getElementById('stopTime')
              var Interval ;
            
              startButton.onclick = function() {  
                // startButton.disabled=true;
                buttonPause.disabled=false;
                stopButton.disabled=false;
                if (startButton.className == "btn btn-lg btn-primary"){
                  startButton.className = "btn btn-lg btn-secondary";
                }
                if (buttonPause.className == "btn btn-lg btn-secondary"){
                    buttonPause.className = "btn btn-lg btn-primary";
                }
                if (stopButton.className == "btn btn-lg btn-secondary"){
                    stopButton.className = "btn btn-lg btn-primary";
                }
              }
              startTime.onclick = function(){
                clearInterval(Interval);
                Interval = setInterval(startTimer, 1000);
              }
              
              buttonPause.onclick = function() {
                clearInterval(Interval);
                startButton.disabled=false;
                buttonPause.disabled=true;
                stopButton.disabled=false;
                if (startButton.className == "btn btn-lg btn-secondary"){
                  startButton.className = "btn btn-lg btn-primary";
                }
                if (buttonPause.className == "btn btn-lg btn-primary"){
                    buttonPause.className = "btn btn-lg btn-secondary";
                }
                if (stopButton.className == "btn btn-lg btn-secondary"){
                  stopButton.className = "btn btn-lg btn-primary";
                }
              }
              
              stopTime.onclick = function() {
                clearInterval(Interval);
                hours = "00";
                minutes = "00";
                seconds = "00";
                appendHours.innerHTML = hours;
                appendMinutes.innerHTML = minutes;
                appendSeconds.innerHTML = seconds;
                startButton.disabled=false;
                buttonPause.disabled=true;
                stopButton.disabled=true;
                if (startButton.className == "btn btn-lg btn-secondary"){
                  startButton.className = "btn btn-lg btn-primary";
                }
                if (buttonPause.className == "btn btn-lg btn-primary"){
                    buttonPause.className = "btn btn-lg btn-secondary";
                }
                if (stopButton.className == "btn btn-lg btn-primary"){
                  stopButton.className = "btn btn-lg btn-secondary";
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
          <!-- start Button trigger modal -->          
          <button id="startButton" type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#staticBackdrop1">Start Time</button>
          <!-- Modal -->
            <div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                      
                      <div class = "form-group">
                        <input class="form-control" type="text" name="startP" placeholder="Write page number here" required value="<?php echo $startPage?>">
                      </div>
                    
                      <div class="form-group">
                        <input id="startTime" class="form-control button" type="submit" name="startTime" value="Submit">
                      </div>
                    
                    </form>
                  </div>
          
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
          
                </div>
              </div>
            </div>

          <!-- pause -->
            <button id="pause" type="button" class="btn btn-lg btn-secondary" disabled>Pause Time</button>
          
          <!-- Button trigger modal -->
          <button id=stopButton type="button" class="btn btn-lg btn-secondary" disabled data-toggle="modal" data-target="#staticBackdrop">Stop Time</button>
          <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
          
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Stop Time</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <div class="modal-body">
                    
                    <form action="timer.php" method="POST" autocomplete="">
          
                      <div class="form-group">
                        <label for="stopPage" class="col-form-label">Last page read:</label>
                      </div>
                
                      <div class = "form-group">
                        <input class="form-control" type="text" name="endPage" placeholder="Write page number here" required value="<?php echo $endPage ?>">
                      </div>
                      
                      <div class="form-group">
                        <input class="form-control button" type="submit" name="stopTime" value="Submit" >
                      </div>
                    
                    </form>
                  </div>
          
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
          
                </div>
              </div>
            </div>





        </div>
        <hr class="my-4">    
      </div>
    </div>
        

</body>
</html>