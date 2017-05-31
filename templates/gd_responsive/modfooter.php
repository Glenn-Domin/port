
<!--<link href="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gtooltip/gtooltip.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gvalidation/gvalidation.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://glenndomin.id.au/libraries/cegcore/assets/css/system_messages.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gtabs/gtabs.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gsliders/gsliders.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gmodal/gmodal.css" media="screen" rel="stylesheet" type="text/css">
<link href="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gdropdown/gdropdown.css" media="screen" rel="stylesheet" type="text/css">-->

<!--<script src="http://glenndomin.id.au/libraries/cegcore/assets/jquery/jquery.js" type="text/javascript"></script>


<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gtooltip/gtooltip.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gvalidation/gvalidation.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gvalidation/lang/en.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/jquery/jquery.inputmask.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gtabs/gtabs.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gsliders/gsliders.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gmodal/gmodal.js" type="text/javascript"></script>
<script src="http://glenndomin.id.au/libraries/cegcore/assets/gplugins/gdropdown/gdropdown.js" type="text/javascript"></script>-->

<!--<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/gjs.js" type="text/javascript"></script>
<script src="https://www.google.com/recaptcha/api.js" type="text/javascript"></script>-->

<script type="text/javascript">jQuery(document).ready(function($){
				$("#chronoform-Contact").gvalidate();

				$("#chronoform-Contact").find(":input").on("check.gvalidation", function(){
					var field = $(this);
					if(field.is(":hidden")){
						if(field.closest(".tab-pane").length > 0){
							var tab_id = field.closest(".tab-pane").attr("id");
							$('a[href="#'+tab_id+'"]').closest(".nav").gtabs("get").show($('a[href="#'+tab_id+'"]'));
						}
					}
					if(field.data("wysiwyg") == "1"){
						field.data("gvalidation-target", field.parent());
					}
				});
				$("#chronoform-Contact").on("success.gvalidation", function(e){
					if($("#chronoform-Contact").data("gvalidate_success")){
						var gvalidate_success = $("#chronoform-Contact").data("gvalidate_success");
						if(gvalidate_success in window){
							window[gvalidate_success](e, $("#chronoform-Contact"));
						}
					}
				});
				$("#chronoform-Contact").on("fail.gvalidation", function(e){
					if($("#chronoform-Contact").data("gvalidate_fail")){
						var gvalidate_fail = $("#chronoform-Contact").data("gvalidate_fail");
						if(gvalidate_fail in window){
							window[gvalidate_fail](e, $("#chronoform-Contact"));
						}
					}
				});
			

				function chronoforms_data_tooltip(formObj){
					formObj.find(":input").each(function(){
						if($(this).data("tooltip") && $(this).closest(".gcore-input, .gcore-input-wide").length > 0){
							var tipped_parent = [];
							if($(this).closest(".gcore-subinput-container").length > 0){
								var tipped_parent = $(this).closest(".gcore-subinput-container");
							}else if($(this).closest(".gcore-form-row, .form-group").length > 0){
								var tipped_parent = $(this).closest(".gcore-form-row, .form-group");
							}
							if(tipped_parent.length > 0){
								var tipped_label = tipped_parent.find("label");
								if(tipped_label.length > 0 && !tipped_label.first().hasClass("tipped_label")){
									tipped_label.first().addClass("tipped_label");
									var $tip = $("<span style='color:#ff0000; font-size:12px; vertical-align:top;'>!</span>");
									$tip.data("content", $(this).data("tooltip"));
									tipped_label.first().append($tip);
								}
							}
						}
					});
					formObj.find(".input-tooltip").gtooltip();
				}
				chronoforms_data_tooltip($("#chronoform-Contact"));
			

				function chronoforms_data_loadstate(formObj){
					formObj.find(':input[data-load-state="disabled"]').prop("disabled", true);
					formObj.find('*[data-load-state="hidden"]').css("display", "none");
					formObj.find(':input[data-load-state="hidden_parent"]').each(function(){
						if($(this).closest(".gcore-subinput-container").length > 0){
							$(this).closest(".gcore-subinput-container").css("display", "none");
						}else if($(this).closest(".gcore-form-row").length > 0){
							$(this).closest(".gcore-form-row").css("display", "none");
						}
					});
				}
				chronoforms_data_loadstate($("#chronoform-Contact"));
			
$(":input").inputmask();

					function chrono_ajax_submit(){
						$(document).on("click", "#chronoform-Contact :input[type=submit]", function(event){
							$("#chronoform-Contact").append("<input type='hidden' name='"+$(this).attr("name")+"' value='"+$(this).val()+"' />");
						});
						
						var files;
						$("input[type=file]").on("change", function(event){
							files = event.target.files;
						});
						
						$(document).on("submit", "#chronoform-Contact", function(event){
							var overlay = $("<div></div>").css({
								"position": "fixed",
								"top": "0",
								"left": "0",
								"width": "100%",
								"height": "100%",
								"background-color": "#000",
								"filter": "alpha(opacity=50)",
								"-moz-opacity": "0.5",
								"-khtml-opacity": "0.5",
								"opacity": "0.5",
								"z-index": "10000",
								"background-image":"url(\"http://glenndomin.id.au/libraries/cegcore/assets/images/loading-small.gif\")",
								"background-position":"center center",
								"background-repeat":"no-repeat",
							});
							if(!$("#chronoform-Contact").hasClass("form-overlayed")){
								$("#chronoform-Contact").append(overlay);
								$("#chronoform-Contact").addClass("form-overlayed");
							}
							var form_action = $("#chronoform-Contact").prop("action");
							var sep = (form_action.indexOf("?") > -1) ? "&" : "?";
							var ajax_url = form_action + sep + "tvout=ajax";
							
							//data processing
							$.ajax({
								"type" : "POST",
								"url" : ajax_url,
								"data" : $("#chronoform-Contact").serialize(),
								"success" : function(res){
									$("#chronoform-Contact").replaceWith(res);
									$("#chronoform-Contact").gvalidate();
									chronoforms_fields_events();
									chronoforms_validation_signs($("#chronoform-Contact"));
									chronoforms_data_tooltip($("#chronoform-Contact"));
									chronoforms_data_loadstate($("#chronoform-Contact"));
									if(typeof chronoforms_pageload_fields_events == "function"){
										chronoforms_pageload_fields_events();
									}
									//chrono_ajax_submit();//this line duplicates submissions, should be removed
								},
							});
							return false;
						});
					}
					chrono_ajax_submit();
				
function chronoforms_fields_events(){
}
chronoforms_fields_events();
function chronoforms_pageload_fields_events(){

}
chronoforms_pageload_fields_events();
			});
		jQuery(document).ready(function($){
			$('[data-g-toggle="tab"]').closest('.nav').gtabs({
				'pane_selector':'.tab-pane',
				'tab_selector':'[data-g-toggle="tab"]',
			});
			$('[data-g-toggle="collapse"]').closest('.panel-group').gsliders({
				'pane_selector':'.panel-collapse',
				'tab_selector':'[data-g-toggle="collapse"]',
				'active_pane_class':'in',
			});
			
			$('[data-g-toggle="modal"]').on('click', function(e){
				e.preventDefault();
				$modal = $($(this).data('g-target'));
				$modal.gmodal({
					'close_selector' : '[data-g-dismiss="modal"]',
				});
				$modal.gmodal('open');
			});
			
			$('.gdropdown').gdropdown();
			$('[data-g-toggle="dropdown"]').on('click', function(e){
				e.preventDefault();
				$(this).parent().find('.gdropdown').gdropdown('toggle');
			});
		});
		</script>

<jdoc:include type="modules" name="footer" style="xhtml" />