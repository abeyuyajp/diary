$(function () {
  $('#translate-button').on('click', function(e) {
      e.preventDefault();

      var textarea = $('#before-translate').val();
      
      $.ajax({
        type: 'POST',
        url: '/translate/ajax',
        data: {translate: textarea},
        dataType: 'json',
        headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},

    }).done(function(data){
        $('#before-translate').empty();
        //$('#after-translate').text(data.translation);
        $('#after-translate').append(`<p>${data.translation}</p>`)

      }).fail(function(){
        alert('error');
      });
  });
});