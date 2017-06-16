// JavaScript Document
var SITE = SITE || {};

SITE.fileInputs = function() {
  var $this = $(this),
      $val = $this.val(),
      valArray = $val.split('\\'),
      newVal = valArray[valArray.length-1],
      $button = $this.siblings('.button'),
      $fakeFile = $this.siblings('.file-holder');
  if(newVal !== '') {
    $button.text('File Chosen');
    if($fakeFile.length === 0) {
      $button.before('<span class="file-holder">' + newVal + '</span>');
    } else {
      $fakeFile.text(newVal);
    }
  }
};


$(document).ready(function(){
	$(".checkbox").click(function(e){
			e.preventDefault();					  
			$(this).toggleClass("active");
			if($(this).hasClass("active")){
				console.log($(this).parent().find("input"));
				$(this).parent().find("input").prop("checked", true);
			}else{
				$(this).parent().find("input").prop("checked", true);
			}
	});
	
	
	//$('select').customSelect();
	
	$('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);
	
	$(".chzn-select").chosen(); 
	$(".chzn-select-deselect").chosen({allow_single_deselect:true});
});



