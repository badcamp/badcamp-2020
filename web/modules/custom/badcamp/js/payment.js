/**
 * @file
 * Contains the definition of the behaviour jsTestRedWeight.
 */

(function ($, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.customDonationLink = {
    attach: function (context, settings) {
      $('#custom-donation-input').keypress(function(){
        var output = "<a href='/take-payment/custom_badcamp_payment_sponsorship?amount=1000' class='use-ajax button primary' data-dialog-type='modal' data-dialog-options='{&quot;width&quot;:800}'>" + Drupal.t("Enter Payment Information") + "</a>";
        $('#payment-button-link').html(output);
      });
    }
  };
})(jQuery, Drupal, drupalSettings);
