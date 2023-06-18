$(function() {
  var parsleyOptions = {
    successClass: "has-success",
    errorClass: "has-error",    
    errorsMessagesDisabled: true,
    classHandler: function(_el) {
      return _el.$element.closest(".form-group");
    },
   
  };
  $("#form-container").parsley(parsleyOptions);

  window.Parsley.on("form:error", function(formInstance) {
    $(":focus").parsley().validate();
  });

  window.Parsley.on("field:validated", function(fieldInstance) {
    var element = fieldInstance.$element;

    if (fieldInstance.isValid()) {
      element.removeClass("is-invalid");
    } else {
      element.addClass("is-invalid"); // Add invalid class
      element
        .popover({
          trigger: "manual",
          container: "body",
          placement: "bottom",
          content: function() {
            return fieldInstance.getErrorsMessages().join(";");
          }
        });
        if (element.is(":focus")) {
          element.popover("show");
          setTimeout(function() {
            element.popover("hide");
          }, 3000); // Delay in milliseconds (2 seconds)
        }
    }
  });

  var $sections = $(".form-section");
  var $progress = $(".bullet");
  var $header = $(".header");

  function navigateTo(index) {
    // Mark the current section with the class 'current'
    $sections.removeClass("current").eq(index).addClass("current");
    $progress.eq(index).addClass("active");
    $header.removeClass("current").eq(index).addClass("current");
    // Show only the navigation buttons that make sense for the current section:
    $(".form-navigation .previous").toggle(index > 0);
    var atTheEnd = index >= $sections.length - 1;
    $(".form-navigation .next").toggle(!atTheEnd);
    $(".form-navigation [type=submit]").toggle(atTheEnd);
  }

  function curIndex() {
    // Return the current index by looking at which section has the class 'current'
    return $sections.index($sections.filter(".current"));
  }

  // Previous button is easy, just go back
  $(".form-navigation .previous").click(function() {	
    $(".popover").hide(); 
    $progress.eq(curIndex()).removeClass("active");
    navigateTo(curIndex() - 1);
    $progress.eq(curIndex()).addClass("animate-reverse"); // Add animate-reverse class
    $progress.eq(curIndex()).removeClass("success");
    setTimeout(function() {
      $progress.eq(curIndex()).removeClass("animate-reverse"); // Remove animate-reverse class
    }, 800);
  });

  // Next button goes forward iff current block validates
  $(".form-navigation .next").click(function() {  
    if ($(".form-container").parsley().validate({ group: "block-" + curIndex() })) {
      $(".popover").hide(); 
      $progress.eq(curIndex()).addClass("active");
      $progress.eq(curIndex()).addClass("success");
		navigateTo(curIndex() + 1);
	 }
  });

  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
  $sections.each(function(index, section) {
    $(section).find(".form-field").attr("data-parsley-group", "block-" + index);
  });

  navigateTo(0); // Start at the beginning
});
