$(() => {
  const $input = $('.form-field input');

  $input.on('focus', function () {
    $(this).parent('.form-field').addClass('active');
  });

  $input.on('focusout', function () {
    if ($(this).val() === '') {
      $(this).parent('.form-field').removeClass('active filled');
    } else {
      $(this).parent('.form-field').removeClass('active');
      $(this).parent('.form-field').addClass('filled');
    }
  });

  $('.dropdown-el').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).toggleClass('expanded');
    $('#'+$(e.target).attr('for')).prop('checked',true);
    if ($('[name="currency"]:checked').val() === 'none') {
      $(this).parent('.form-field').removeClass('active');
    } else {
      $(this).parent('.form-field').addClass('active');
    }
  });

  $('#create-amount').on('keypress keyup blur', function(event) {
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which !== 46
      || $(this).val().indexOf('.') !== -1)
      && (event.which < 48 || event.which > 57)) {
      event.preventDefault();
    }
  });

  $(document).on('click', () => {
    $('.dropdown-el').removeClass('expanded');
  });

  if ($input.val() !== '') {
    $input.parent('.form-field').addClass('filled');
  }

  if ($('[name="currency"]:checked').val() !== 'none') {
    $('.form-field.select-block').addClass('active');
  }
});