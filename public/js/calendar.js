$(function () {
  $('.js-modal-open').on('click', function () {
    var day = day;
    var reservePart = reservePart;
    $('.day').text(day);
    $('.reservePart').text(reservePart);
    return false;
  });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });
});
