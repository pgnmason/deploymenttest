<?php
/**
 * @version		$Id: index.php 21140 2011-04-11 17:10:29Z dextercowley $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();

$templateDir = JPATH_THEMES."/".JFactory::getApplication()->getTemplate()."/";

$style = $this->params->get( 'templateStyle' );

include_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php

?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
		<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
		<script>jQuery.noConflict();</script>
		<script src="<?php echo JURI::base();?>/templates/<?php echo $this->template ?>/js/main.js"></script>
		<script src="<?php echo JURI::base();?>/templates/<?php echo $this->template ?>/js/plugins.js"></script>
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
</head>

<body class="<?php echo (($menu->getActive() == $menu->getDefault()) ? ('front') : ('page')).' '.$active->alias.' '.$pageclass; ?>">
<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
<!-- Add your site or application content here -->
<div id="home"></div>
<nav>
            <div class="container">
                <div id="logo"><a href="#home" class="scroll"></a></div>
                <ul>
                    <li><a class="scroll" href="#about">ABOUT</a></li>
                    <li><a class="scroll" href="#services">SERVICES</a></li>
                    <li><a class="scroll" href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </nav>
	<?php /*?><?php if($this->countModules('header_left')) : ?>
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
	<?php endif; ?><?php */?>
<div id="sticker" style="display: none; height: 0">
            <div class="container">
                <div id="sticker-logo"><a href="#home" class="scroll"></a></div>
                <ul>
                    <li><a class="scroll" href="#about">ABOUT</a></li>
                    <li><a class="scroll" href="#services">SERVICES</a></li>
                    <li><a class="scroll" href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>
		<?php /*?><?php if($this->countModules('header_left_sticker')) : ?>
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
		<?php endif; ?><?php */?>
<div class="cycle-slideshow" data-cycle-slides="div">
            <div class="slide">
                <img src="images/slide-1.jpg"/>
                <p class="bold cycle-overlay">TRIAL PRESENTATIONS<br />
                    <span class="lite normal">subline text will go here.</span>
                </p>
            </div>
            <div class="slide">
                <img src="images/slide-2.jpg"/>
                <p class="bold cycle-overlay">COURT REPORTING<br />
                    <span class="lite normal">subline text will go here.</span>
                </p>
            </div>
            <div class="slide">
                <img src="images/slide-3.jpg"/>
                <p class="bold cycle-overlay">VIDEO DEPOSITIONS<br />
                    <span class="lite normal">subline text will go here.</span>
                </p>
            </div>
        </div>
	<?php /*?><?php if($this->countModules('top_slider')) : ?>
	<div class="slide">
		<jdoc:include type="modules" name="top_slider" style="none" />
		<div class="clear"></div>
	</div>
	<?php endif; ?><?php */?>
<div class="home">
	<div class="container">
                <div class="blurb">
                    <p class="lite">Independently owned since 1979, <span class="red bold">AKF</span> is the <span class="bold">largest court reporting,
                    legal video,</span> and <span class="bold">trial technologies firm</span> in Western Pennsylvania</p>
                </div>
                <div class="take-action">
                    <ul>
                        <li><img src="images/request-transcript-icon.png" alt="Request a Transcript"/><p>REQUEST TRANSCRIPT<br />Text will go here</p></li>
                        <li class="middle"><img src="images/services-icon.png" alt="Services"/><p>SERVICES<br />What do we do?</p></li>
                        <li><img src="images/schedule-icon.png" alt="Schedule now!"/><p class="red">SCHEDULE NOW<br />Let's get started!</p></li>
                    </ul>
                </div>
            </div>
        </div>
		<?php /*?><?php if($this->countModules('content_top')) : ?>
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
		<?php endif; ?><?php */?>
 <div class="spacer"></div>
        <div id="services" class="call-to-action clearfix">
            <div class="container">
                <div class="col-6 float-left">
                    <h1>AKF <span class="bold">SERVICES</span></h1>
                    <p class="lite border-right">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam at dui enim. Ut tincidunt fringilla neque, at egestas ipsum. Praesent elit augue, feugiat posuere quam sed, iaculis suscipit est. Donec nec ultrices orci, sit amet luctus libero. Proin vulputate rhoncus eros, ac scelerisque augue. Donec sit amet magna ante. Fusce vel pulvinar quam, sodales tristique purus. Pellentesque facilisis congue arcu id tincidunt.</p>
                </div>
                <div class="service-list float-left">
                    <ul>
                        <li class="lite"><p>Consulting</p></li>
                        <li class="lite"><p>Court Reporting</p></li>
                        <li class="lite"><p>Digital Services</p></li>
                        <li class="lite"><p>Audio/Vido Synchronization</p></li>
                        <li class="lite"><p>Videoconverencing</p></li>
                        <li class="lite"><p>Video Tech Services</p></li>
                        <li class="lite"><p>Trial Presentation</p></li>
                        <li class="lite"><p>Online Case Management</p></li>
                    </ul>
                </div>
            </div>
        </div>
		<?php /*?><?php if($this->countModules('left_col')) : ?>
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
		<?php endif; ?><?php */?>
<div id="about" class="border-top">
            <div class="cycle-slideshow" data-cycle-slides="div">
                <div class="slide">
                    <img src="images/slide-2-1.jpg" class="first"/>
                </div>
                <div class="slide">
                    <img src="images/slide-2-2.jpg"/>
                    <p class="cycle-overlay lay-right">Quote will go here.<br />
                        <span class="normal"> - Ed Fulesday <span class="lite italic">CEO</span></span>
                    </p>
                </div>
                <div class="slide">
                    <img src="images/slide-2-3.jpg"/>
                    <p class="cycle-overlay lay-left">Quote will go here.  Quote will go here.<br />
                        <span class="normal"> - Christine Bratkovich <span class="lite italic">Controller</span></span>
                    </p>
                </div>
                <div class="slide">
                    <img src="images/slide-2-4.jpg"/>
                </div>
                <div class="slide">
                    <img src="images/slide-2-5.jpg"/>
                </div>
            </div>
        </div>
		<?php /*?><?php if($this->countModules('bottom_slider')) : ?>
		<div class="slide">
			<jdoc:include type="modules" name="bottom_slider" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?><?php */?>
<div class="about">
	<div class="container">
		<jdoc:include type="component" />
	</div>
</div>
<div id="contact"></div>
<div class="contact border-top">
	<div class="container clearfix">
		<div class="float-right">
		<div class="form">
                        <p><span class="bold">CONTACT FORM</p>
                        <p class="lite">For more information,<br /> 
                        please fill out the form below.</p>
                        <br /><br />
                        <form action="" method="post" enctype="text/plain">
                            <input type="text" name="name" placeholder="NAME"><br>
                            <input type="text" name="email" placeholder="EMAIL"><br>
                            <textarea type="text" name="project" placeholder="QUESTIONS/COMMENTS"></textarea><br>
                            <input id="submit-btn" type="submit" value="SUBMIT">
                        </form>
                    </div>
                    <div id="form-btn" class="click">
                        <p>CONTACT FORM</p>
                    </div>
                </div>
			<?php /*?><?php if($this->countModules('contact_form')) : ?>
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
			<?php endif; ?><?php */?>
		<h1>CONTACT <span class="bold">US</span></h1>
		<br />
		<br />
		<div class="col-3 float-left">
			<div class="border-right">
				<div class="contact-padding-r">
				<div class="mail-phone-person">
                                <img src="images/phone-icon.png" alt="Phone Number"/><p class="bold">1.888.AKF.DEPO</p><br />
                                <img src="images/mail-icon.png" alt="Email Us!"/><p class="bold">depo@akf.com</p>
                            </div>
                            <br />
                            <p><span class="red">AKF Pittsburgh</span><br />
                            <span class="normal">436 Blvd of the Allies<br />
                            Pittsburgh, PA 15219</span><br />
                            <span class="bold">P: 412.281.3712<br />
                            F: 412.261.2537</span></p>
                            <br /><br />
                            <p><span class="red">AKF Greensburg</span><br />
                            <span class="normal">101 North Main Street<br />
                            Suite 105<br />
                            Greensburg, PA 15601</span><br />
                            <span class="bold">P: 724.853.7700<br />
                            F: 724.853.7800</span></p>
                            <br /><br />
                            <p><span class="red">AKF Erie</span><br />
                            <span class="normal">Palace Business Center<br />
                            1001 State Street, 14th Floor<br />
                            Erie, PA 15601</span><br />
                            <span class="bold">P: 814.453.5700<br />
                            F: 814.453.5780</span></p>
                        </div>
                    </div>               
                </div>
					<?php /*?><?php if($this->countModules('footer_left')) : ?>
					<div class="mail-phone-person">
						<jdoc:include type="modules" name="footer_left" style="none" />
						<div class="clear"></div>
					</div>
					<?php endif; ?><?php */?>
		<div class="col-3 float-left">
                    <div class="contact-padding-l">       
					<div class="mail-phone-person">
                            <img src="images/person-icon.png" alt="Direct Contact"/><p><span class="red">DIRECT CONTACT</span></p>
                        </div>

                        <div id="dd" class="wrapper-dropdown" tabindex="1">
                            <span>DIRECT CONTACT</span>
                            <ul class="dropdown">
                                <li><a href="#">ED FULESDAY</a></li>
                                <li><a href="#">CHRISTINE BRATKOVICH</a></li>
                                <li><a href="#">JOE HAGAN</a></li>
                                <li><a href="#">JILL DUNKER</a></li>
                                <li><a href="#">MATTHEW D RETHAGE</a></li>
                                <li><a href="#">SHERRI KOVACH</a></li>
                                <li><a href="#">LESLI KRAFT</a></li>
                            </ul>
                        </div>
                        <div id="select-holder"></div>
						<br/>
						<p id="ed"><span class="bold">Ed Fulesday</span><br /> 
                        <span class="italic normal">Company President</span><br />
                        <span class="bold">ed@akf.com<br />
                        412.261.2323 x 4000</span></p>
                        <br /><br />
                        <p id="christine"><span class="bold">Christine Bratkovich</span><br />
                        <span class="italic normal">Director of Client Services</span><br />
                        <span class="bold">chrissy@akf.com<br />
                        412.261.2323 x 4004</span></p>
                        <br /><br />
                        <p id="joe"><span class="bold">Joe Hagan</span><br />
                        <span class="italic normal">VideoTech Services</span><br />
                        <span class="bold">video@akf.com<br />
                        412.261.2323 x 4003</span></p>
                        <br /><br />
                        <p id="jill"><span class="bold">Jill Dunker</span><br />
                        <span class="italic normal">Manager, Production Department</span><br />
                        <span class="bold">Production@akf.com<br />
                        412.261.2323 x 4001</span></p>
                    </div>
                </div>

                       <?php /*?><?php if($this->countModules('footer_middle')) : ?>
					<div class="mail-phone-person">
						<jdoc:include type="modules" name="footer_middle" style="none" />
						<div class="clear"></div>
					</div>
					<?php endif; ?><?php */?>
		<div class="col-3 float-left last-col">
		<p id="matt"><span class="bold">Matthew D Rethage</span><br /> 
                    <span class="italic normal">Manager, Legal Technologies</span><br />
                    <span class="bold">tech@akf.com<br />
                    412.261.2323 x 4002</span></p>
                    <br /><br />
                    <p id="sherri"><span class="bold">Sherri Kovach</span><br />
                    <span class="italic normal">Manager, Scheduling Department</span><br />
                    <span class="bold">depo@akf.com<br />
                    412.261.2323 x 2000</span></p>
                    <br /><br />
                    <p id="leslie"><span class="bold">Leslie Kraft</span><br />
                    <span class="italic normal">Manager, Billing Department</span><br />
                    <span class="bold">billing@akf.com<br />
                    412.261.2323 x 2008</span></p>
                </div>
            </div>
        </div>
			<?php /*?><?php if($this->countModules('footer_right')) : ?>
			<div class="direct_contact" tabindex="1">
				<jdoc:include type="modules" name="footer_right" style="none" />
				<div class="clear"></div>
			</div>
			<?php endif; ?><?php */?>
<footer>
		<div class="container clearfix">
                <p class="float-left">&copy; Copyright 2013 AKF</p>
                <p class="float-right align-right">site design and development by <a href="http://bluetomatodesign.com/"><img src="images/blue_tomato.png"alt ="Blue Tomato"/>blue tomato</a></p>
            </div>
		<?php /*?><?php if($this->countModules('footer_bottom')) : ?>
		<div class="copyright">
			<jdoc:include type="modules" name="footer_bottom" style="none" />
			<div class="clear"></div>
		</div>
		<?php endif; ?><?php */?>
</footer>

        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>js/plugins.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>js/main.js"></script>

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
</html>
