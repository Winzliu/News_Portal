$(document).ready(function(){
  // event ketika di tulis
  $('#search').on('input',function(){
    $('#container').load('search/search.php?keyword=' + encodeURIComponent($('#search').val()));
  })
  $('#search').on('blur',function(){
    setTimeout(() => {
      $('#container').load('search/table.php');
    }, 200);
  })
})