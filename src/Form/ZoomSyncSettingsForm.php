<?php

namespace Drupal\openy_gc_zoom_sync\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * ZoomSync settings form for configure variables.
 */
class ZoomSyncSettingsForm extends ConfigFormBase {
  /**
   * @return string
   */
  public function getFormId() {
    return 'zoom_sync_setting_form';
  }

  /**
   * @return string[]
   */
  protected function getEditableConfigNames() {
    return ['openy_gc_zoom_sync.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('openy_gc_zoom_syncs.settings');

    $form['help'] = [
      '#type' => 'markup',
      '#markup' => $this->t('This configuration form provides settings of Zoom meetings integration.'),
    ];

    $form['data_service_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Data Service Url'),
      '#default_value' => $config->get('data_service_url'),
      '#description' => $this->t('Data Service Url'),
    ];

    $form['data_service_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Data Service Token'),
      '#default_value' => $config->get('data_service_token'),
      '#description' => $this->t('Data Service Token'),
      '#maxlength' => 1000,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save the config.
    $config = $this->config('openy_gc_zoom_sync.settings');

    $config->set('data_service_token', $form_state->getValue('data_service_token'));
    $config->set('data_service_url', $form_state->getValue('data_service_url'));
    $config->save();

    parent::submitForm($form, $form_state);
  }
}
