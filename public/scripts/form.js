$( () => {
  $('form').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      type: $(this).attr('method'),
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: data => {
        console.log(data)
      },
      error: resp => {
        console.log(JSON.parse(resp.responseText))
      }
    });
  });

  $('.lot-action').on('click', function () {
    const data = {
      id: parseInt($(this).attr('data-lot-id')),
      status: $(this).attr('data-option')
    };

    $.post({
      url: '/lot/update',
      data: data,
      success: resp => {
        console.log(resp)
      },
      error: resp => {
        console.log(resp)
      }
    });
  })
});