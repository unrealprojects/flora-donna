/* Copyright (C) YOOtheme GmbH, http://www.gnu.org/licenses/gpl.html GNU/GPL */

jQuery(function($){var isInputSupported="placeholder"in document.createElement("input"),isTextareaSupported="placeholder"in document.createElement("textarea");if(isInputSupported&&isTextareaSupported){$.fn.placeholder=function(){return this}}else{$.fn.placeholder=function(){return this.filter((isInputSupported?"textarea":":input")+"[placeholder]").bind("focus.placeholder",clearPlaceholder).bind("blur.placeholder",setPlaceholder).trigger("blur.placeholder").end()}}function args(elem){var newAttrs={},rinlinejQuery=/^jQuery\d+$/;$.each(elem.attributes,function(i,attr){if(attr.specified&&!rinlinejQuery.test(attr.name)){newAttrs[attr.name]=attr.value}});return newAttrs}function clearPlaceholder(){var $input=$(this);if($input.val()===$input.attr("placeholder")&&$input.hasClass("placeholder")){if($input.data("placeholder-password")){$input.hide().next().show().focus()}else{$input.val("").removeClass("placeholder")}}}function setPlaceholder(elem){var $replacement,$input=$(this);if($input.val()===""||$input.val()===$input.attr("placeholder")){if($input.is(":password")){if(!$input.data("placeholder-textinput")){try{$replacement=$input.clone().attr({type:"text"})}catch(e){$replacement=$("<input>").attr($.extend(args($input[0]),{type:"text"}))}$replacement.removeAttr("name").data("placeholder-password",true).bind("focus.placeholder",clearPlaceholder);$input.data("placeholder-textinput",$replacement).before($replacement)}$input=$input.hide().prev().show()}$input.addClass("placeholder").val($input.attr("placeholder"))}else{$input.removeClass("placeholder")}}$(function(){$("form").bind("submit.placeholder",function(){var $inputs=$(".placeholder",this).each(clearPlaceholder);setTimeout(function(){$inputs.each(setPlaceholder)},10)})});$(window).bind("unload.placeholder",function(){$(".placeholder").val("")})});