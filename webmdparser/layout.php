<?php
if(!empty($_GET["title"])){
  $title = htmlspecialchars($_GET["title"]);
}else{
  $title = "";
}
if(!empty($_GET["contents"])){
  $contents = htmlspecialchars($_GET["contents"]);
}else{
  $contents = "";
}
?>
<!DOCTYPE html>
<html lang="ja"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $title;?></title>
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="" rel="shortcut icon" type="image/x-icon">
<link rel='stylesheet' type='text/css' href='webmdparser/style.css'>
</head>
<body>
<div id="page">
<?php echo $contents;?>
</div>
</body>
</html>