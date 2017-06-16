<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Products Administration</title>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="js/jqueryte/jquery-te-1.4.0.css">
<link rel="stylesheet" href="css/admin.css" type="text/css">


<script src="https://code.jquery.com/jquery.js"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/jqueryte/jquery-te-1.4.0.min.js" charset="utf-8"></script>

<style>
/*table{
	width:800px;
	margin:auto;
}

th{
	text-align:left;
}

#container{
	width:899px;
	margin:auto;
	background-color:#fff;
}

#content{
	padding:20px;
}

#top{
	background-color:#333333;
	color:#fff;
	padding:10px;
	margin-bottom:10px;
}

#top a {
	color:inherit;
	font-size:18px;
	font-weight:bold;
}*/
</style>

<script>
jQuery(document).ready(function(){
	$(".editor").jqte();
})
</script>
</head>
<?php $pagename = basename($_SERVER['REQUEST_URI']); ?>
<body>

<!-- Links -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Products Management</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
             <?php if(Authorization::loggedIn()){?><li><a href="logout.php">Logout</a></li><? } ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <?php if(Authorization::loggedIn()){?>
            <li <?php if($pagename == "index.php" || $pagename==""){?>class="active"<?php } ?>><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
				<?php /*<li <?php if($pagename == "users.php" || $pagename=="user.php"){?>class="active"<?php } ?>><a href="users.php"><span class="glyphicon glyphicon-user"></span> Users</a></li> */ ?>
				<li <?php if($pagename == "category.php" || $pagename=="categories.php"){?>class="active"<?php } ?>><a href="categories.php"><span class="glyphicon glyphicon-th-list"></span> Categories</a></li>
				<li <?php if($pagename == "product.php" || $pagename=="products.php"){?>class="active"<?php } ?>><a href="products.php"><span class="glyphicon glyphicon-tag"></span> Products</a></li>
			<? } ?>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      