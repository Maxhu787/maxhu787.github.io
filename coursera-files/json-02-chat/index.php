<?php
session_start();
if (isset($_POST['reset'])) {
  $_SESSION['chats'] = array();
  header("Location: index.php");
  return;
}
if (isset($_POST['message'])) {
  if (!isset($_SESSION['chats'])) $_SESSION['chats'] = array();
  $_SESSION['chats'][] = array($_POST['message'], date(DATE_RFC2822));
  header("Location: index.php");
  return;
}
?>
<html>
<title>g4o2 chat</title>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');

  body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #121212;
    color: #ffffff;
    opacity: 87%;
  }

  #chatcontent {
    height: 40vh;
    width: 97vw;
    overflow: auto;
    border: solid 5px #353935;
  }


  #chatcontent::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    background-color: #353935
      /*#F5F5F5*/
    ;
  }

  #chatcontent::-webkit-scrollbar {
    width: 10px;
    background-color: #F5F5F5;
  }

  #chatcontent::-webkit-scrollbar-thumb {
    background-color: #F90;
    background-image: -webkit-linear-gradient(45deg,
        rgba(255, 255, 255, .2) 25%,
        transparent 25%,
        transparent 50%,
        rgba(255, 255, 255, .2) 50%,
        rgba(255, 255, 255, .2) 75%,
        transparent 75%,
        transparent)
  }


  .time {
    font-size: 12px;
    color: orange;
    margin-left: 10px;
  }

  .msg {
    color: white;
    font-weight: 100;
    font-size: 16px;
    margin-left: 10px;
  }

  #message-input {
    height: 36px;
    font-size: 14px;
    width: 70%;
    margin-left: 2px;
    padding-left: 12px;
    border-radius: 5px;
    border: none;
    background-color: #d1d1d1;
    transition: all .2s ease-in-out;
  }

  #message-input:focus {
    outline: none !important;
    border: 3px solid #ffa500;
    box-shadow: 0 0 0px #719ECE
  }

  #page-header {
    margin-top: -1.7%;
    margin-left: 0.3%;
  }

  h1 {
    font-family: 'Orbitron', arial;
    color: orange;
    font-size: 8vw;
    text-transform: uppercase;
    user-select: none;
  }

  #guide {
    height: 20vh;
    width: 52.4vw;
    margin-top: -7.3%;
    margin-bottom: 1.5%;
    background-color: #343434;
    border-radius: 10px;
    padding: 10px;
  }

  ::placeholder {
    padding-left: 0px;
  }

  :-ms-input-placeholder {
    padding-left: 0px;
  }

  #form {
    margin-top: 1.3%;
  }

  #submit {}

  #reset {}

  .button {
    height: 35px;
    font-size: 16px;
    width: 10%;
    border: none;
    cursor: pointer;
    border-radius: 3px;
    padding: 8px;
    color: orange;
    background-color: #343434;
    transition: all .2s ease-in-out;
  }

  .button:hover {
    background-color: #121212;
    transition: all .2s ease-in-out;
    color: #ffa500;
  }

  .spinner {
    margin-left: 20%;
    margin-right: 20%;
    margin-top: 7vh;
    width: 10vw;
  }
</style>
</head>

<body>
  <section id="page-header">
    <h1>g4o2&nbsp;chat</h1>
    <section id="guide">
      <p>Press <kbd>Enter</kbd> to submit message</p>
      <p>Press <kbd>Esc</kbd> to deselect</p>
      <p>Press <kbd>/</kbd> to select </p>
    </section>
  </section>
  <section>
    <div id="chatcontent">
      <img class="spinner" src="spinner.gif" alt="Loading..." />
    </div>
    <form id='form' autocomplete="off" method="post" action="index.php">
      <div>
        <input id='message-input' type="text" name="message" size="60" placeholder="Enter message and submit" />
        <input class='button' id="submit" type="submit" value="Chat" />
        <input class='button' id='reset' type="submit" name="reset" value="Reset" />
        <!--<a href="chatlist.php" target="_blank">chatlist.php</a>-->
      </div>
    </form>
  </section>
  <script type="text/javascript" src="jquery.min.js">
  </script>
  <script type="text/javascript">
    let input = document.getElementById('message-input');
    input.focus();
    input.select();
    let pageBody = document.getElementsByTagName('body')[0];
    window.addEventListener("keydown", event => {
      if ((event.keyCode == 191)) {
        if (input === document.activeElement) {
          return;
        } else {
          input.focus();
          input.select();
          event.preventDefault();
        }
      }
      if ((event.keyCode == 27)) {
        if (input === document.activeElement) {
          document.activeElement.blur();
          window.focus();
          event.preventDefault();
        }
      }
    });
    /*
    below function just for scrolling chat to bottom on load
    for some reason I cant get it to work the .load() way
    so I'm using a weird solutions
    which is to set srolling var to false on load
    when scroll set to true
    if scroll var is false run the chatScroll() function
    else it will not run it and you can scroll to wherever u like 
    without chatScroll interfering 
    */
    var scroll = false;

    function chatScroll() {
      let chat = document.getElementById('chatcontent')
      chat.scrollTop = chat.scrollHeight;
    }

    function updateMsg() {
      //window.console && console.log('Requesting JSON');
      $.getJSON('chatlist.php', function(rowz) {
        //window.console && console.log('JSON Received');
        //window.console && console.log(rowz);
        $('#chatcontent').empty();
        for (var i = 0; i < rowz.length; i++) {
          arow = rowz[i];
          var time = '<p class="time">' + arow[1] + '</p>';
          var msg = '<p class="msg">' + arow[0] + '<br/></p>';
          $('#chatcontent').append(time);
          $('#chatcontent').append(msg)
        }
        let chat = document.getElementById('chatcontent')
        $(chat).scroll(function() {
          scroll = true;
        });
        if (!scroll) {
          chatScroll()
        }
        setTimeout('updateMsg()', 100);

      });
    }
    $(document).ready(function() {
      $.ajaxSetup({
        cache: false
      });
      updateMsg();
    })
  </script>
</body>