<?php

namespace Drupal\badcamp\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\badcamp\Form\CustomDonationForm as CustomDonationForm;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Block(
 *   id = "custom_donation_block",
 *   admin_label = @Translation("Custom Donation Block.")
 * )
 */
class CustomDonationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = [
      'form' =>  $this->formBuilder->getForm(CustomDonationForm::class)
    ];
//    $output = [
//      '#theme' => 'custom_payment',
//    ];
    return $output;
  }
}
