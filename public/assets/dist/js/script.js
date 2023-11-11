function storeOrUpdate(url, form, table = null) {
  $('.modal-content').append('<div class="overlay d-flex justify-content-center align-items-center"> <i class = "fas fa-4x fa-sync-alt fa-spin" > </i> </div>');
  var data = new FormData(form);
  return $.ajax({
    enctype: 'multipart/form-data',
    url: url,
    type: "POST",
    dataType: 'json',
    processData: false,
    contentType: false,
    data: data,
    success: function (data) {
      $('.modal').modal('hide');
      $('.spinner-grow').remove();
      form.reset();
      if (table != undefined) {
        table.ajax.reload(null, false);
        table.draw();
      }
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: data.status,
        text: data.text
      })
      if (data.route) {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: data.status,
          text: data.text,
          showConfirmButton: false,
          timer: 900
        })
        setTimeout(function () {
          window.location = data.route;
        }, 900)
      }
      $('.overlay').remove();
    },
    error: function (data) {
      console.log(data);
      $('#submit').html('Simpan');
      $('.overlay').remove();
      $('.spinner-grow').remove();
      if (data.responseJSON.errors) {
        var message = [];
        $.each(data.responseJSON.errors, function (key, value) {
          message.push(value);
        });
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Gagal',
          text: message,
          showConfirmButton: true
        });
      } else if (data.responseJSON.error) {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'GAGAL',
          text: data.responseJSON.error,
          showConfirmButton: true
        });
      }
      else {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'GAGAL',
          text: data.responseJSON.text,
          showConfirmButton: true
        });
      }
    }
  });
}

function destroy(url, table = null) {
  Swal.fire({
    title: 'Konfirmasi',
    text: "Data akan Di Hapus ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.value) {
      return $.ajax({
        url: url,
        type: 'DELETE',
        success: function (data) {
          table != null ? table.ajax.reload(null, false) : '';
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: data.status,
            text: data.text,
            showConfirmButton: false,
            timer: 900
          })
        },
        error: function (data) {

          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'GAGAL',
            text: data.responseJSON.text,
            showConfirmButton: true
          });
        }
      });
    }
  })
}
