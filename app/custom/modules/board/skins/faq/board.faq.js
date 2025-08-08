jQuery(function($) {
  $('.faq_title').on('click', function(e) {
    e.preventDefault();
    var targetId = $(this).attr('href');
    var $target = $(targetId);

    if ($target.hasClass('in')) {
      // 닫기: max-height 0으로 애니메이션
      $target.css('max-height', '0');
      $target.removeClass('in');
    } else {
      // 열기: 현재 열려있는 거 닫기
      $('.panel-collapse.in').each(function() {
        $(this).css('max-height', '0').removeClass('in');
      });

      // 열기: 실제 컨텐츠 높이 측정 후 max-height에 세팅
      $target.addClass('in');
      var scrollHeight = $target.prop('scrollHeight') + 'px';
      $target.css('max-height', scrollHeight);
    }
  });
});