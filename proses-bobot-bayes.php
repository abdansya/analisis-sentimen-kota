<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Auto Height</title>
  <style media="screen">
    *{
    padding: 0;margin: 0;
    }
    html, body{
    height: 100%;
    }
    .header{
    height: 10%;
    background: red;
    }

    .main{
    height: 85%;
    background:yellow;
    overflow-y: scroll;
    }
    .main-content{
      padding: 20px;
    }
    .footer{
    height: 5%;
    background: orange;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
  		Header
  	</div>
  	<div class="main">
  		<div class="main-content">
  			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, incidunt qui dolorem excepturi</p>
  			...
  			...
  			...
  			...
  		</div>
  	</div>
  	<div class="footer">
  		Footer
  	</div>
  </div>
</body>
</html>
