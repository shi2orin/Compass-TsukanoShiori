$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });
});

$(function () {
  $('.ac-label').click(function () {
    $(this).next('div').slideToggle();
    $(this).find(".arrow").toggleClass('open');
  });
});
