$(function () {
  $('.search_conditions').click(function () {
    $(this).find(".arrow").toggleClass('open');
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $(this).find(".arrow").toggleClass('open');
    $('.subject_inner').slideToggle();
  });
});
