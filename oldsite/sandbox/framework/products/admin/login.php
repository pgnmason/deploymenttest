<?php require("inc/admin_top.php");

$auth = new Authorization();

if(isset($_POST[$authmetric])){
	if($auth->login($_POST[$authmetric],$_POST[$pname])){
		header("Location:index.php");
	}else{
		$error = "<strong>Login Failed!</strong><br />".$error;
	}
}

?>
<?php require("inc/admin_header.php");?>


<div class="col-sm-6">
<form method="post" action="login.php">
<h1 class="page-header">Please Login</h1>
<div class="row">
	<label>Username:</label>
	<input type="text" name="<?= $authmetric; ?>"  class="form-control"/>
</div>
<div class="row">
	<label>Password:</label>
	<input type="password" name="<?= $pname; ?>" class="form-control" />
</div>
<div class="row"><input type="submit" value="Login" class="btn btn-lg"/></div>

</form>
</div>
<div class="clr"></div>
<? if(strlen($error) > 0){ ?>
<p class="alert alert-danger"><?php echo $error; ?></p>
<? }?>
<?php require("inc/admin_footer.php");?>