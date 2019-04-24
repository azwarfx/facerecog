//------------------------------------
// emotionUi.js
// a collection of javascript functions to enable user interactions
// dependencies: jquery.js, clipboard.js, highchartsApp.js
// created: April 2016
// last modified August 2017
// author: Steve Rucker
//------------------------------------


// show/hide UI toolbar containing webcam, upload and URL
if (utils.getUrlVars()["ui"] && utils.getUrlVars()["ui"] == "no") {
	$(".ui-buttons").hide();
}
else {
	$(".ui-buttons").show();
}
// show/hide options panel
if (utils.getUrlVars()["option-panel"] && utils.getUrlVars()["option-panel"] == "yes") {
	$(".options-panel").show();
}
else {
	$(".options-panel").hide();
}

$(".video-thumbnail img").eq(0).css("opacity","1");

// show/hide Highcharts tooltip
$("#highcharts-containers").mouseover(function () {
	$(".highcharts-tooltip").show();
});
$("#highcharts-containers").mouseout(function () {
	$(".highcharts-tooltip").hide();
});

// provide functionality for Copy to Clipboard button
var clipboard = new Clipboard('.copy-json-button');

$(".media-thumbnail").click(function(e) {
	e.preventDefault();
	if (emoDemoApp.apiCredentials && !emoDemoApp.processing) {
		$(".video-wrapper").show();
		$("#video").attr("src","");
		$(".show-image").attr("src","");
		$("#highcharts-titles, #highcharts-containers, .video-controls").hide();
		$(".media-thumbnail img").css("opacity","0.7");
		$(this).find("img").css("opacity","1");
		var mediaType = "video";
		if ($(this).hasClass("image-thumbnail")) {
			mediaType = "image";
			$(".show-image")
				.attr("mediaId",$(this).attr("href"))
				.show();
		}
		else {
			$("#video")
				.attr("mediaId",$(this).attr("href"))
				.show();
			$(".video-controls").show();
		}
		emoDemoApp.resetElements();
		emoDemoApp.examplesModule(mediaType);
	}
});

// show/hide JSON
$(".show-json").click(function (e) {
	e.preventDefault();
	$(".highcharts-container").hide();
	$(".json-response-container").show();
	emoDemoApp.errorTemplate("json-template","Retrieving JSON response...",false, false);
	setTimeout(function() {
		$(".json-response").html("<pre>" + utils.syntaxHighlight(emoDemoApp.jsonResponse) + "</pre>");
		$(".copy-json-button").show();
		emoDemoApp.errorTemplate("json-template","",false, false);
	},200)
});
$(".hide-json").click(function (e) {
	e.preventDefault();
	$(".highcharts-container").show();
	$(".json-response-container").hide();
	setTimeout(function() {
		$(".json-response").html("");
	},200)
	$(".copy-json-button").hide();
});
// toggle autoscale in Highcharts, depending on Autoscale checkbox
$("#autoscale").change(function () {
	if ($(this).prop("checked")) {
		highchartsApp.autoscale = true;
	}
	else {
		highchartsApp.autoscale = false;
	}
	$("#highcharts-containers").empty();
	highchartsApp.trackVideo = false;
	highchartsApp.displayData();
});
// toggle autoscale in Highcharts, depending on Autoscale checkbox
$("#featurepoints").change(function () {
	if ($(this).prop("checked")) {
		$("#displayCanvas").show();
	}
	else {
		$("#displayCanvas").hide();
	}
});
$(".webcam-button").click(function(e){
	e.preventDefault();
	if (!emoDemoApp.processing) {
		// emoDemoApp.resetElements();
		$(".video-wrapper").hide();
		$(".webcam-video-container").show();
		$(".face-overlay").hide();
		$(".webcam-counter").html("");
		$(".video-thumbnail img").css("opacity","0.7");
		emoDemoApp.errorTemplate("video-container-template","Waiting for webcam...",true);
		$("#highcharts-titles, #highcharts-containers").hide();
		// create new video element
		$( "#webcamVideo" ).remove();
		$( ".webcam-video-container" ).append( $( '<video id="webcamVideo"></video>' ) );
		$("#webcamVideo").show();
		emoDemoApp.webcamModule();
	};
});
// disable upload button if processing is 
// taking place from another module
$("#upload").click(function(e) {
	if(emoDemoApp.processing) {
		e.preventDefault();
	}
});
// submit form automatically
// when file is selected
$("#upload").change(function(){
    $('#mediaUploadForm').submit();
});
$(".url-from-web").click(function(){
	$(this).val("");
});
$(document).keydown(function(){
	if(window.event.keyCode=="13"){
        $(".submit-button").click();
    }
});
$( window ).resize(function() {
  emoDemoApp.setElementDimensions();
});
// wait until dom is loaded to grab config vars
// $(function() {
//     // slider
// 	$(".polltimeout-slider").slider({
// 		range: "min",
// 	    min: 10,
// 	    max: emoDemoApp.config.pollTimeout,
// 	    slide: function( event, ui ) {
// 	        $("#optionPollTimeout").val(ui.value);
// 	    }
// 	});
// 	$(".polltimeout-slider").slider("value", emoDemoApp.config.pollTimeout);
// 	$("#optionPollTimeout").click(function(){
// 		$(this).val("");
// 	});
// 	$("#optionPollTimeout").keypress(function(event){
// 		if (utils.isNumber(event)) {
// 			setTimeout(function(){
// 				var thisVal = $("#optionPollTimeout").val();
// 				var newVal = "";
// 				if (thisVal < 10 || thisVal > emoDemoApp.config.pollTimeout) {
// 					$(".option-error").html("Out of range");
// 					$("#optionPollTimeout").val("");
// 					$(".polltimeout-slider").slider("value", emoDemoApp.config.pollTimeout);
// 				}
// 				else {
// 					$(".option-error").html("");
// 					$(".polltimeout-slider").slider("value", thisVal);
// 				}
				
// 			},1500)
// 		}
// 		else {
// 			return false;
// 		}
// 	});
// });





 
