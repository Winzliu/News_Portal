$(document).ready(function(){
  // event ketika di tulis
  $('#search').on('input',function(){
    $('#container').load('search.php?keyword=' + $('#search').val());
  })
  $('#search').on('blur',function(){
    setTimeout(() => {
      $('#container').load('table.php');
    }, 200);
  })
})