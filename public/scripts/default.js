$(() => {
  let dbValue;
  const URL = document.URL;
  const $section = $('.section-lots-list');
  const UPDATE_TIMEOUT = 1000;

  $.get({
    url: '/counter',
    success: data => {
      dbValue = JSON.parse(data).value;
    }
  });

  // Запрос на проверку изменений в базе каждые UPDATE_TIMEOUT
  setInterval(() => {
    $.get({
      url: '/counter',
      success: processUpdate
    })
  }, UPDATE_TIMEOUT);

  // Обновление данных, если база была изменнеа
  const processUpdate = data => {
    if (dbValue !== JSON.parse(data).value) {
      updatePageAjax();
      dbValue = JSON.parse(data).value;
    }
  };

  // Обновление текущей страницы без перезагрузки
  const updatePageAjax = () => {
    $.get({
      url: URL,
      success: data => {
        $section.html($(data).find('.section-lots-list').html());
        lotUpdateListener();
      }
    });
  };

  // Форма добавления лотов
  $('form').on('submit', function (event) {
    event.preventDefault();
    $('.error-message').remove();
    $(this).find('.error').removeClass('error');
    $.ajax({
      type: $(this).attr('method'),
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: resp => {
        // Сброс данных формы и обновление списка
        this.reset();
        $(this).find('.active, .filled').removeClass('active filled');
        alert(JSON.parse(resp));
        updatePageAjax();
        dbValue++;
      },
      error: resp => {
        data = JSON.parse(resp.responseText);
        // Вывод ошибок под полями
        for (let key in data) {
          let $element = $('[name="' + key + '"]');
          $element.parents('.form-field').append(errorMessage(data[key]));
          $element.parents('.form-field').addClass('error');
        }
      }
    });
  });

  // DOM элемент с текстом ошибки
  const errorMessage = text => `<div class="error-message">${text}</div>`;

  // Изменение статуса лота
  const lotUpdateListener = () => $('.lot-action').on('click', function () {
    const data = {
      id: parseInt($(this).attr('data-lot-id')),
      status: $(this).attr('data-option')
    };

    $.post({
      url: '/lot/update',
      data: data,
      success: resp => {
        alert(JSON.parse(resp));
        updatePageAjax();
        dbValue++;
      },
      error: resp => {
        console.log(resp)
      }
    });
  });

  lotUpdateListener();
});