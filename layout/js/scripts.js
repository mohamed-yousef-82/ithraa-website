$(document).ready(function(){
// =======================================================================//
// ------------------------------ TOGGLE MENU ---------------------------
// =======================================================================//
$( "#menu-icon" ).click(function() {
$(this).next().slideToggle();
});
// =======================================================================//
// ------------------------ TOGGLE MODAL ---------------------------------
// =======================================================================//
$('#signin').click(function () {
$('.modal').slideToggle(500);
});
// =======================================================================//
// ------------------------------ CONTROL ---------------------------
// =======================================================================//
$("link[href*='theme']").attr("href","css/themes/dark-theme.css");
$(".control li").click(function (){
$("link[href*='theme']").attr("href",$(this).attr('data-style'));
});
$(".control-hide").click(function (){
$(this).find("i").toggleClass("fa-chevron-left fa-chevron-right");
$(".control").toggleClass("control-view control-hidden");
});
$(".control-close").click(function (){
$(".control").fadeOut(100);
});
// =======================================================================//
// ------------------------------ POPUP ----------------------------------
// =======================================================================//
$('[data-popup-open]').click(function (){
var targeted_popup_class = $(this).attr('data-popup-open');
$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
});
$('[data-popup-close]').click(function (){
var targeted_popup_class = $(this).attr('data-popup-close');
$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
});
// =======================================================================//
// ------------------------------ switch-nav -----------------------------
// =======================================================================//
var nav_content = $(".nav").html();
$(".switch-nav").click(function(){
$(this).find("i").toggleClass("fa-list fa-th");
$("main").toggleClass("main-column");
$(".nav-container").toggleClass("side-nav");
$(".main-content").toggleClass("main-content-column");
});
// =======================================================================//
// ------------------------------ SLIDESHOW ---------------------------
// =======================================================================//
// ************************** FIRST SLIDESHOW VIEW ***********************//
$(".slider").hide();
$(".slider:last").show();
$(".slide-show").addClass("thumbnails");
function thumbnails(){
$(".circle").each(function () {
var data = $(this).data("show");
var src = $(data).find("img").attr("src");
$(this).css("background-image", "url(" + src + ")");
});
$(".circle:last").addClass("circle-thumb-animate");
$(".circles").addClass("circles-thumb");
$(".circle").addClass("circle-thumb").removeClass("circle-default");
}
function discs(){
$(".circle:last").removeClass("circle-thumb-animate").addClass("circle-default-animate");
var slider_id = '#'+$(".slider:last").attr("id");
$(".circle").addClass("circle-default").removeClass("circle-thumb").removeClass("circle-default-animate").removeClass("circle-thumb-animate");
$(".circle[data-show='"+slider_id+"']").addClass("circle-default-animate").removeClass("circle-thumb-animate");
$(".circles").addClass("circles-default").removeClass("circles-thumb");
}
if ($(".slide-show").hasClass("thumbnails")) {
  thumbnails();
}
else
if ($(".slide-show").hasClass("discs")) {
discs();
}
// ***************** AUTO ANIMATE FUNCTION OR WHEN CLICK NEXT *************//
function nextgallary(){
$(".slider:last").fadeOut(2000).prev().fadeIn(2000).end().prependTo(".slide-show");
if ($(".slide-show").hasClass("thumbnails")) {
  thumbnails();
var slider_id = "#" + $(".slider:last").attr("id");
$(".circle").addClass("circle-thumb").removeClass("circle-thumb-animate");
$(".circle[data-show='" + slider_id + "']").addClass("circle-thumb-animate");
}
else
if ($(".slide-show").hasClass("discs")) {
// var slider_id = '#'+$(".slider:last").attr("id");
// $(".circle").addClass("circle-default").removeClass("circle-default-animate");
// $(".circle[data-show='"+slider_id+"']").addClass("circle-default-animate");
// $(".circles").addClass("circles-default");
discs();
}
}
// ************************ FUNCTION RUNNING WHEN CLICK PREV ********************//
function prevgallary(){
$(".slider:last").fadeOut(1000).appendTo(".slide-show");
$(".slider:first").fadeIn(1000).appendTo(".slide-show");
if ($(".slide-show").hasClass("thumbnails")) {
var slider_id = '#'+$(".slider:last").attr("id");
$(".circle").addClass("circle-thumb").removeClass("circle-thumb-animate");
$(".circle[data-show='" + slider_id + "']").addClass("circle-thumb-animate");
}
else
if ($(".slide-show").hasClass("discs")) {
var slider_id = '#' + $(".slider:last").attr("id");
$(".circle").addClass("circle-default").removeClass("circle-default-animate");
$(".circle[data-show='"+slider_id+"']").addClass("circle-default-animate");
}
}
// ******************** CALLING AUTO FUNCTION *****************//
slide = setInterval(nextgallary,4000);
// *********************** WHEN CLICK NEXT *******************//
$("#next").click(function () {
clearInterval(slide);
nextgallary();
$("#run").text("Start");
});
// *********************** WHEN CLICK PREV *******************//
$("#prev").click(function () {
clearInterval(slide);
prevgallary();
$("#run").text("Start");
});
// *********************** WHEN CLICK CIRCLE *******************//
$(".circle").click(function(){
clearInterval(slide);
$(".slider").fadeOut();
var data = $(this).attr("data-show");
$(data).fadeIn(1000).appendTo(".slide-show");
$("#run").text("Start");
if ($(".slide-show").hasClass("thumbnails")) {
$(".circle").addClass("circle-thumb").removeClass("circle-thumb-animate");
$(this).addClass("circle-thumb-animate");
}
else
if ($(".slide-show").hasClass("discs")) {
$(".circle").removeClass("circle-default-animate");
$(this).addClass("circle-default-animate");
}
});
// *********************** RUNNING AND STOP SLIDESHOW *******************//
$("#run").text("Stop");
$("#run").click(function(){
if ($(this).text() == "Stop") {
clearInterval(slide);
$(this).text("Start");
}
else {
slide = setInterval(nextgallary,4000);
$(this).text("Stop");
}
});
// *********************** RUNNING AND STOP SLIDESHOW *******************//
$(".button").each(function() {
  var style = $(this).data("view");
  if ($(".slide-show").hasClass(style)) {
    $(".button[data-view='"+style+"']").css("background","#e74c3c");
    }
$(".button").click(function(){
  $(".button").css("background","#ddd");
  $(this).css("background","#e74c3c");
  var current_style = $(this).data("view");
$(".slide-show").removeClass(style).addClass(current_style);
console.log(style)
});
});
// =======================================================================//
// ------------------------------ ITEMS SLIDER HORIZONTAL---------------------------
// =======================================================================//
// ******************************** VARIABLES ****************************//
var index = 0;
var items = $(".items-slider-horizontal ul li").length;
var num = $(".items-slider-horizontal #slide-image").width() / 3;
$(".items-slider-horizontal ul li").width(num);
var animate = num;
var setWidth = $("#slide-image ul li").width() * items;
$(".items-slider-horizontal ul").width(setWidth);
// ************************** AUTO ANIMATE FUNCTION ***********************//
function Fn() {
$(".items-slider-horizontal ul li").animate({ left: "+=" +animate }, 1000).promise().done(function() {
$(this).animate({ left: 0},0);
$(".items-slider-horizontal ul li:first").appendTo("#slide-image ul");
});
}
// **************** WHEN AUTO ANIMATE FUNCTION RUNNING *****************//
if (index
< items - 3) {
Fn();
index++;
}
if (index == items - 3) {
index=0;
}
var goRight =  setInterval(Fn,3000);
// ******************** WHEN CLICK NEXT AND PREV *********************//
$(".items-slider-horizontal #next").click(function () {
clearInterval(goRight);
Fn();
});
$(".items-slider-horizontal #prev").click(function () {
clearInterval(goRight);
$(".items-slider-horizontal ul li").animate({ left: "+=" +animate },0).promise().done(function() {
$(this).animate({left: 0 },1000);
$(".items-slider-horizontal ul li:last").prependTo("#slide-image ul");
});
});
// =======================================================================//
// ------------------------------ ITEMS SLIDER VERTICAL ---------------------------
// =======================================================================//
var indexv = 0;
var itemsv = $(".items-slider-vertical ul li").length;
var numv = $(".items-slider-vertical #slide-row").height() / 3;
$(".items-slider-vertical li").height(numv);
var animatev = numv;
var setWidthv = $(".items-slider-vertical ul li").height() * itemsv;
$(".items-slider-vertical ul").height(setWidthv);
// ************************** AUTO ANIMATE FUNCTION ***********************//
function vertical() {
$(".items-slider-vertical ul li").animate({ bottom: "+=" +animatev }, 1000).promise().done(function() {
$(this).animate({ bottom: 0},0);
$(".items-slider-vertical ul li:first").appendTo(".items-slider-vertical ul");
});
}
// **************** WHEN AUTO ANIMATE FUNCTION RUNNING *****************//
if (indexv
< itemsv - 3) {
vertical();
indexv++;
}
if (indexv == itemsv - 3) {
indexv=0;
}
var goTop =  setInterval(vertical,3000);
// ******************** WHEN CLICK NEXT AND PREV *********************/
$(".items-slider-vertical #next").click(function () {
clearInterval(goTop);
vertical();
});
$(".items-slider-vertical #prev").click(function () {
clearInterval(goTop);
$(".items-slider-vertical ul li").animate({ bottom: "+=" +animatev },0).promise().done(function() {
$(this).animate({bottom: 0},1000);
$(".items-slider-vertical ul li:last").prependTo(".items-slider-vertical ul");
});
});
// =======================================================================//
// -------------------------------- ACCORDION -----------------------------
// =======================================================================//
// $(".item .content").hide();
// $(".item:first-child").find(".content").show();
// $(".item .title").addClass("item-inactive");
// $(".item .title:first").addClass("item-active");
// $(".item .title i").addClass("fa-plus");
// $(".item .title").click(function () {
//   $(".item .title").addClass("item-inactive").removeClass("item-active");
//   $(this).addClass("item-active");
//   $(this).find('i').addClass('fa-plus').removeClass('fa-minus');
// if ($(this).next().is(':hidden')){
//   $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
// $(".item .content").slideUp(500);
// $(this).parent().find(".content").slideDown(500);
//
// }
// return false;
// });
// =======================================================================//
// -------------------------------- ACCORDION2 -----------------------------
// =======================================================================//
$(".item .content").hide();
$(".item:first-child").find(".content").show();
$(".item .title").addClass("item-inactive");
$(".item .title:first").addClass("item-active");
$(".item .title i").addClass("fa-plus-circle");
$('.title').click(function() {
$(".item .title").addClass("item-inactive").removeClass("item-active");
$(this).addClass("item-active").next().slideToggle();
$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');
return false;
});
// =======================================================================//
// -------------------------------- TABS -----------------------------
// =======================================================================//
$(".boxin").hide();
$(".boxin:first-child").show();
$(".tabs li:first").addClass("tab");
$('.tabs').delegate('li:not(.tab)', 'click', function () {
$(this).addClass('tab').siblings().removeClass('tab')
.parents('div.section').find('div.boxin').eq($(this).index()).fadeIn(150).siblings('div.boxin').hide();
});
// =======================================================================//
// ------------------------ counter2 --------------------------------------
// =======================================================================//
function counter() {
$('.number').each(function () {
var t = $(this);
var txt = t.text();
var count = 0;
t.text(count);
function myCount() {
if (count >= txt) {
clearInterval(m);
}else{
count ++;
t.text(count);
}
}
m = setInterval(myCount,10);
});
}
// =======================================================================//
// -------------------------------- PROGRESS BAR ---------------------------
// =======================================================================//
// function perc() {
// $(".myProgress").each(function(){
// var t = $(this);
// var data_width = t.find(".label").data("width");
// var width = 0;
// t.find(".mybar").width(width + "%");
// var id = setInterval(frame, 10);
// function frame() {
// if (width >= data_width) {
// clearInterval(id);
// } else {
// width++;
// t.find(".mybar").width(width + '%');
// t.find(".label").text(width + '%');
// }
// }
// });
//
// }

// =======================================================================//
// ------------------------ SCROLL Nav To Div------------------
// =======================================================================//
// $('.nav li:nth-child(2) a').addClass("active");
// $(window).on("scroll", onScroll);
// $('.nav-left li').find('a[href^="#"]').click(function() {
// $(window).off("scroll");
// $('.nav li a').removeClass('active');
// $(this).addClass('active');
// var hash = $(this).attr('href');
// $('html, body').animate({
// scrollTop: $(hash).offset().top
// }, 1000, 'swing', function () {
// $(window).on("scroll", onScroll);
// });
// });
// function onScroll(event){
// var scrollPos = $(document).scrollTop();
// $(".nav li").find('a[href^="#"]').each(function () {
// var t = $(this);
// var link = t.attr('href');
// if($(link).position().top
// <= scrollPos && $(link).position().top + $(link).height() > scrollPos){
//   $(".nav a").removeClass("active");
//   $("a[href='"+link+"']").addClass("active");
//   }
//   else{
//   $("a[href='"+link+"']").removeClass("active");
//   }
//   });
//   }
  // =======================================================================//
  // ------------------------ FUNCTIONS EXECUTE WHEN SCROLL ------------------
  // =======================================================================//

  // ------------------------- ANIMATE NAV WHITH SCROLL --------------------//
  // $(window).bind('scroll', function() {
  // function nav() {
  // if ($(this).scrollTop() > 120) {
  // if (!$('.nav-container').hasClass("side-nav")) {
  // $('.nav-container').addClass("scroll");
  // }
  // } else {
  // $('.nav-container').removeClass("scroll");
  // }
  // }
  // nav();
  // });
  $(window).on('scroll.bars resize.bars', function() {
  $('.myProgress').each( function(){
  var bottom_of_object = $(this).offset().top + $(this).outerHeight();
  var bottom_of_window = $(window).scrollTop() + $(window).height();
  if( bottom_of_window > bottom_of_object ){
  perc();
  $(window).off(".bars");
  }
  });
  });
  $(window).on('scroll.counter resize.counter', function() {
  $('.number').each( function(){
  var bottom_of_object = $(this).offset().top + $(this).outerHeight();
  var bottom_of_window = $(window).scrollTop() + $(window).height();
  if( bottom_of_window > bottom_of_object ){
  counter();
  $(window).off(".counter");
  }
  });
  });
  // =======================================================================//
  // ------------------------------ Items Filter ----------------------------------
  // =======================================================================//
  $('.items-filter li a').addClass('filter-default');
  $('.all').addClass('filter-active');
  $('[data-filter]').click(function (){
  var data_filter = $(this).attr('data-filter');
  $('.items-filter li a').removeClass('filter-active');
  $(this).addClass('filter-active');
  $('.item-filter-show').fadeOut(0);
  $('[data-filter-item="' + data_filter + '"]').fadeIn(0);
  });
  $('.all').click(function (){
    $('.items-filter li a').removeClass('filter-active');
    $(this).addClass('filter-active');
  $('.item-filter-show').fadeIn(0);
  });
  // =======================================================================//
  // ------------------------ counter --------------------------------------
  // =======================================================================//
  // function counter() {
  // $('.count').each(function () {
  //     $(this).prop('Counter',0).animate({
  //         Counter: $(this).text()
  //     }, {
  //         duration: 4000,
  //         easing: 'swing',
  //         step: function (now) {
  //             $(this).text(Math.ceil(now));
  //         }
  //     });
  // });
  // }
  });
