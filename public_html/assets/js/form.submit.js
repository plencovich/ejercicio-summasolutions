$(document).ready(function () {

  function swalError(message) {
    swal({
      title: 'Ups!',
      html: message,
      showCancelButton: false,
      confirmButtonClass: "btn btn-danger",
      animation: true,
      focusConfirm: false,
      focusCancel: false,
      buttonsStyling: false,
      confirmButtonColor: '#ed5565',
      confirmButtonText: 'Cerrar',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(function (result) {
      swal.close();
    });
  }

  function swalOk(responseData) {
    swal({
      title: 'Listo!',
      html: responseData.message,
      showCancelButton: false,
      confirmButtonClass: "btn btn-success",
      animation: true,
      focusConfirm: false,
      focusCancel: false,
      buttonsStyling: false,
      confirmButtonColor: '#5cb85c',
      confirmButtonText: 'Cerrar',
      allowOutsideClick: false,
      allowEscapeKey: false
    }).then(function (result) {
      $(location).prop('href', responseData.redirUrl);
    });
  }

  function show_loading() {
    swal({
      html: 'Aguarde un instante...',
      allowEscapeKey: false,
      allowOutsideClick: false,
      onOpen: function () {
        swal.showLoading();
      }
    });
  }

  $("form").on("submit", function (e) {
    e.preventDefault();
    var init = 0;

    $('.required').each(function () {
      if ($(this).val().length == 0) { init++; }
    });
    if (init != 0) {
      swalError('Todos los campos son requeridos.');
      return;
    }

    var formAction = $(this).attr('action');
    var dataString = new FormData(this);

    show_loading();

    $.ajax({
      type: "POST",
      url: formAction,
      dataType: "json",
      data: dataString,
      cache: false,
      processData: false,
      contentType: false
    })
    .done(function (responseData) {
      if (responseData.validation == false) {
        swalError(responseData.message);
      } else {
        swalOk(responseData);
      }
    })
    .fail(function (xhr) {
      console.log(xhr.responseText);
    });
  });

  $("select[name=typeEmployee]").on('change', function () {
    show_loading();
    var typeEmployee = $(this).val();
    var getTypeEmployee = $(this).attr('data-ajax-url');

    if (typeEmployee.length != 0) {
      var dataString = {
        typeEmployee: typeEmployee
      };
      $.ajax({
        type: "POST",
        url: getTypeEmployee,
        dataType: "json",
        data: dataString,
        cache: false
      }).done(function (data) {
        $('#questionTxt').empty().append(data.questionText);
        $('#subType').empty();
        $('#subTypeDiv').removeClass('d-none');
        if (data.listSubTypes.length != 0) {
          $.each(data.listSubTypes, function (i, item) {
            $('#subType').append($('<option>', {
              value: item.est_id,
              text: item.est_name
            }));
          });
        }
        swal.close();
      }).fail(function (xhr) {
        console.log(xhr.responseText);
      });
    } else {
      $('#subTypeDiv').addClass('d-none');
      $('#questionTxt').empty();
      $('#subType').empty();
      swal.close();
    }
  });
});
