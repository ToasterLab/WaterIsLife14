<html>
<head>
	<title>RI Maurick Water Conference 2014</title>
	<meta name="viewport" content="width=device-width, user-scalable=0"/> <!--320-->
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>-->
	<!--<script type="text/javascript" charset="utf-8" src="js/jquery.tubular.1.0.js"></script> -->
</head>
<body id='bd'>
	<center>
	
	<div style="position: relative; width: 0; height: 0">
		<div style="position: absolute; left: -200px; top: 0px">
			<img id='wil' src='water_is_life.png' style="z-index=1"/>
		</div>
	</div>
	<div id="player"><iframe id="ytplayer" type="text/html" width="640" height="360" src="https://www.youtube.com/embed/8gx4Qw5uIV8?autoplay=1&controls=0&enablejsapi=1&loop=1&modestbranding=1&rel=0&showinfo=0&autohide=1&iv_load_policy=3" frameborder="0" allowfullscreen></iframe></div>
	<!-- 1. The <iframe> (and video player) will replace this <div> tag. 8gx4Qw5uIV8-->
    
	<div id='extra_text'></div>

    <script>
		var a=16;
		//Resize of screen
		window.addEventListener("resize", function() {
			document.getElementById("wil").width=Math.floor(418*screen.width/1366);
			document.getElementById("wil").height=Math.floor(137*screen.height/768);
			if( !done )
			{
				document.getElementById("abc").height=screen.height-a;
				document.getElementById("abc").width=Math.min((screen.height-a)*16/9,screen.width);
			}
		}, false);
		
		//Check for 
		// Find matches
		var done = false;
		var mql = window.matchMedia("(orientation: portrait)");
		
		
		if(mql.matches) {
				// Changed to portrait
				//1366x768
				document.getElementById("wil").width=Math.floor(418*screen.width/1366);
				document.getElementById("wil").height=Math.floor(137*screen.height/768);
				alert("This site is best viewed in landscape mode");
			}
			else {
				// Changed to landscape
				document.getElementById("wil").width=Math.floor(418*screen.width/1366);
				document.getElementById("wil").height=Math.floor(137*screen.height/768);
			}

		// Add a media query change listener
		mql.addListener(function(m) {
			if(m.matches) {
				// Changed to portrait
				document.getElementById("wil").width=Math.floor(418*screen.width/1366);
				document.getElementById("wil").height=Math.floor(137*screen.height/768);
				if( !done )
				{
					document.getElementById("abc").height=screen.height-a;
					document.getElementById("abc").width=Math.min((screen.height-a)*16/9,screen.width);
				}
				//alert("This site is best viewed in landscape mode");
			}
			else {
				// Changed to landscape
				document.getElementById("wil").width=Math.floor(418*screen.width/1366);
				document.getElementById("wil").height=Math.floor(137*screen.height/768);
				if(!done)
				{
					document.getElementById("abc").height=screen.height-a;
					document.getElementById("abc").width=Math.min((screen.height-a)*16/9,screen.width);
				}
			}
		});
		
		document.getElementById("wil").width=Math.floor(418*screen.width/1366);
		document.getElementById("wil").height=Math.floor(137*screen.height/768);
		document.getElementById("ytplayer").height=screen.height-a;
		document.getElementById("ytplayer").width=Math.min((screen.height-a)*16/9,screen.width);
		
		//function update_video()
		//{
		  // 2. This code loads the IFrame Player API code asynchronously.
		  var tag = document.createElement('script');
		  //<iframe width="640" height="360" src="//www.youtube.com/embed/8gx4Qw5uIV8?feature=player_embedded" frameborder="0" allowfullscreen></iframe>

		  tag.src = "https://www.youtube.com/iframe_api";
		  var firstScriptTag = document.getElementsByTagName('script')[0];
		  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		  // 3. This function creates an <iframe> (and YouTube player)
		  //    after the API code downloads.
		  var player;
		  function onYouTubeIframeAPIReady() {
			player = new YT.Player('ytplayer', {
			  events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			  }
			});
		  }

		  // 4. The API will call this function when the video player is ready.
		  function onPlayerReady(event) {
			//alert("Hai");
			//event.target.playVideo();
			setTimeout(function(){is_started(event)},1000);
		  }
		  
		  function is_started(event)
		  {
			//alert("Hai");
			//alert(event.data);
			if (done)
			{
				//alert("Started");
				//Don't do anything
			}
			else
			{
				//alert("Not Started");
				//Replace with image
				document.getElementById("player").innerHTML="<img id='abc' style='z-index=-1;' src='bkgrnd.png'/>";
				document.getElementById("wil").src="water_is_life.png";
			}
		  }

		  // 5. The API calls this function when the player's state changes.
		  //    The function indicates that when playing a video (state=1),
		  //    the player should play for six seconds and then stop.
		  
		  function onPlayerStateChange(event) {
			//alert(event.data);
			if (event.data==2)
			{
				//alert("Paused");
				event.target.playVideo();
			}
			//alert("Hai");
			//alert(event.data);
			done=true;
			/*if (event.data == YT.PlayerState.PLAYING && !done) {
			  setTimeout(stopVideo, 6000);
			  done = true;
			}*/
		  }
		  function stopVideo() {
			player.stopVideo();
		  }
		//}
    </script>
	</center>
</body>
</html>
