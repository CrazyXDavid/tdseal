<html>
<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
input{
    font-size: 2em;
    line-height: 2em;
    width: 50em;
}
button{
    font-size: 2em;
    line-height: 2em;
}
</style>
</head>
<body>
<form method="GET" autocomplete="off">
<input type="text" name="url"><button type="submit" name="submit">Submit</button>

<?php
$opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Accept-language: en\r\n" .
                "Cookie: foo=bar\r\n"
    )
  );
  
  $context = stream_context_create($opts);

if(isset($_GET["submit"])){
    $url = $_GET["url"];
    $html = file_get_contents($url, false, $context);
    $title = explode("</h1>", explode("<h1 class=\"tv-title\">", $html)[1])[0];
    print("<input type=\"text\" id=\"title\" value=\"$title\"><button type=\"button\" onClick=\"selectTitle()\">Copy</button><br/>");
    $img = explode("\" alt", explode("<img src=\"", $html)[1])[0];
    print("<input type=\"text\" id=\"img\" value=\"$img\"><button type=\"button\" onClick=\"selectImg()\">Copy</button><br/>");
}

?></form>
<script>
    $(document).ready(function(){
        $("#img").mouseenter(function(){
            selectImg();
        })
        $("#title").mouseenter(function(){
            selectTitle();
        })
    })
    function selectTitle(){
        document.getElementById("title").select();
    }
    function selectImg(){
        document.getElementById("img").select();
    }
</script></body>
</html>
