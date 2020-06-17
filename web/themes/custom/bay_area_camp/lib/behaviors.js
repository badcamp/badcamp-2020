(function(Drupal, $) {
  Drupal.behaviors.foundation = {
    attach: function(context) {
      $(context).foundation();
    },
  };

  Drupal.behaviors.sponsorship= {
    attach: function(context) {
      $(context).find('.sponsorship-table td').each(function() {
        if($(this).is(':contains("•")')) {
          $(this).text('');
          $(this).addClass('table-bullet');
        }
      })
    },
  };

})(Drupal, jQuery);
