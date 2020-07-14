<?php

namespace Drupal\badcamp\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class CustomDonationForm
 *
 * @package Drupal\badcamp\Form
 */
class CustomDonationForm extends FormBase {

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['container'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'box-container', 'class' => 'text-align-center'],
    ];

    $form['container']['input'] = [
      '#type' => 'number',
      '#title' => $this->t('Donation Amount'),
      '#required' => TRUE,
      '#min' => 10,
      '#step' => .01,
    ];

    $form['cancel'] = [
      '#type' => 'link',
      '#title' => $this->t('Skip'),
      '#url' => Url::fromRoute('badcamp_register.page', ['type' => 'confirm']),
    ];

    $form['container']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Make Donation'),
      '#ajax' => [
        'callback' => '::ajaxResponse',
        'wrapper' => 'box-container'
      ]
    ];


    // The box contains some markup that we can change on a submit request.
    $form['container']['link'] = [
      '#type' => 'markup',
      '#markup' => '',
    ];

    return $form;
  }

  /**
   * @param $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return mixed
   */
  public function ajaxResponse($form, FormStateInterface $form_state) {
    $element = $form['container'];
    $amount = $form_state->getValue('input');

    if ($amount !== NULL){
      $url = Url::fromRoute('badcamp.payment',
        ['type' => 'custom_badcamp_payment_sponsorship'],
        ['query' => ['amount' => $amount]]
      );

      $output = $this->t('<a href="@link" class="use-ajax button primary" data-dialog-type="modal" data-dialog-options="{&quot;width&quot;:800}">@text</a>',
        ['@link' => $url->toString(), '@text' => 'Donate $'. number_format($amount,2) ]
      );

      $element['box']['#markup'] = $output;
    }

    return $element;
  }

    /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'custom_donation_form';
  }
}
