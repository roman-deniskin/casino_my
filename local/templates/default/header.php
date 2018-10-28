<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Casino</title>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Bootstrap -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow" />
    <?=core\files\includer::getCSS('/css/normalize.css');?>
    <?=core\files\includer::getCSS('/css/main.css');?>
    <?=core\files\includer::getJS('/js/jquery.min1.12.4.js');?>
    <?=core\files\includer::getJS('/js/main.js');?>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?core\components\includeComponent::add('preloader', array(), 'default');?>
<div class="header_wrapper">
  <div class="header_content content_container clearfix">
    <div class="header_logo_wrapper top_align">
      <a class="header_logo_a" href="/"><img class="header_logo logo_big" src="<?=core\files\includer::getIMG('img/logo.png');?>"></a>
    </div>
    <?core\components\includeComponent::add('menu', array(), 'default');?>
    <?core\components\includeComponent::add('logout', array(), 'default');?>
  </div>
</div>
<div class="page_wrapper">
  <div class="page_content content_container">