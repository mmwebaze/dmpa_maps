<?php

namespace Drupal\dmpa_maps\Services;


interface DmpaMapsManagerInterface {
  public function getSupplyChainData($country, $period);
}