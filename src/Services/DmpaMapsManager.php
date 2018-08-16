<?php

namespace Drupal\dmpa_maps\Services;


use Drupal\Core\Entity\EntityTypeManager;

class DmpaMapsManager implements DmpaMapsManagerInterface {

  protected $entityTypeManager;

  public function __construct(EntityTypeManager $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }
  public function getSupplyChainData($country, $period){

    $storage = $this->entityTypeManager->getStorage('taxonomy_term');
    $termIds = $storage->getQuery()
      ->condition('vid', 'countries')
      ->condition('name', $country)->execute();
    $terms = $storage->loadMultiple($termIds);
    $countryId = current($terms)->id();

    $storage = $this->entityTypeManager->getStorage('node');
    $ids = $storage->getQuery()
      ->condition('type', 'supply_chain_data')
      ->condition('field_country', $countryId)->execute();
    $entities = $storage->loadMultiple($ids);

    drupal_set_message(count($entities));
  }
}