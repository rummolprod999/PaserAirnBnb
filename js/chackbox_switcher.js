$(document).ready(function(){
   let box = $('input[type=checkbox]');

   box.change(function(){
       if(box.prop('checked')) {
           $('.js_checkBox__img').attr(
               'src',
               '/img/box_active.svg'
           );
       } else{
           $('.js_checkBox__img').attr(
               'src',
               '/img/custom_checkbox.svg'
           );
       }
   });
});