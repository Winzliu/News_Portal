$(window).scroll(function(){
  var wScroll = $(this).scrollTop();
  
  if(wScroll > 100){
    $('nav').removeClass('bg-opacity-50')
  }else if(wScroll < 100){
    $('nav').addClass('bg-opacity-50')
  }
})