<DOCTYPE !html>
<html>
<head>
<link rel="stylesheet" href="css/teststyle.css" />
<script>
function toggleHidden()
{
  res = "none";
  switch (document.getElementById("texthidden").style.display) {
    case "none":
      res = "block";
      break;
    case "block":
      res = "none";
      break;
    }  
  document.getElementById("texthidden").style.display=res;
}
</script>
<title>it works!</title>
</head>
<body>
<h1>This file is inside the docker!</h1>
<hr />
<div class="testtext" onclick="toggleHidden()">Hello cruel world!</div>
<div id="texthidden" style="text-align:center; display: none;">this text is hidden behind the press of a hello text</div>
</body>
</html>