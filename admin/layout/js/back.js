$(function () {
  'use strict';
    //dashboard //vid 74
    $('.toggle-info').click(function(){
      $(this).parent().next('.panel-body').fadeToggle(100);
  
    });
  // trigger the selectboxit
  $("select").selectBoxIt({
    autoWidth:false
  });

  
  //hide placeholder
  $('[placeholder]').focus(function () {
      $(this).attr('data-text' , $(this).attr('placeholder'));
      $(this).attr('placeholder','');

  }) .blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
  });
  

  //add asterisk on required field
  $('input').each(function(){
    if ($(this).attr('required')==='required'){
      $(this).after('<span class="asterisk">*</span>');
    }
  });
  //convert password field to text field on hover
  var passField=$('.password');
  $('.showpass').hover(function(){
      passField.attr('type','text');
  },function(){
    passField.attr('type','password');
  });
  //Confirmation Message On Button
   $('.confirm').click(function(){
     return confirm('Are You Sure?');

   });

   //Category View Option
   $('.name-cat').click(function() { 
        $(this).next('.full-view').fadeToggle(200);
   });
   $('.option span').click(function(){
      $(this).addClass('active').siblings('span').removeClass('active');
        if($(this).data('view')==='full'){  
          $(' .full-view').fadeIn(200);
        } else{
          $(' .full-view').fadeOut(200);
        }

   });

});