<?php

namespace Drupal\dmpa_maps\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\dmpa_maps\Services\DmpaMapsManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class DmpaMapsController extends ControllerBase {

  private $dmpaMapsManager;

  public function __construct(DmpaMapsManagerInterface $dmpaMapsManager) {
      $this->dmpaMapsManager = $dmpaMapsManager;
  }
  public function displayMaps(Request $request) {
    $country = strtolower($request->attributes->get('country'));
    $year = $request->attributes->get('year');

    $this->dmpaMapsManager->getSupplyChainData($country, $year);

    $maps = [
      'kenya' => ['link' => 'https://code.highcharts.com/mapdata/countries/ke/ke-all.geo.json'],
      'uganda' => ['link' => 'https://code.highcharts.com/mapdata/countries/ug/ug-all.geo.json'],
      'drc' => ['link' => 'https://code.highcharts.com/mapdata/countries/cd/cd-all.geo.json'],
      'ghana' => ['link' => 'https://code.highcharts.com/mapdata/countries/gh/gh-all.geo.json'],
      'madagascar' => ['link' => 'https://code.highcharts.com/mapdata/countries/mg/mg-all.geo.json'],
      'malawi' => ['link' => 'https://code.highcharts.com/mapdata/countries/mw/mw-all.geo.json'],
      'mozambique' => ['link' => 'https://code.highcharts.com/mapdata/countries/mz/mz-all.geo.json'],
      'niger' => ['link' => 'https://code.highcharts.com/mapdata/countries/ne/ne-all.geo.json'],
      'nigeria' => ['link' => 'https://code.highcharts.com/mapdata/countries/ng/ng-all.geo.json'],
      'senegal' => ['link' => 'https://code.highcharts.com/mapdata/countries/sn/sn-all.geo.json'],
      'zambia' => ['link' => 'https://code.highcharts.com/mapdata/countries/zm/zm-all.geo.json'],
      'burkina-faso' => ['link' => 'https://code.highcharts.com/mapdata/countries/bf/bf-all.geo.json'],
    ];

    return [
      '#type' => 'markup',
      '#theme' => 'dmpa_display_maps',
      '#attached' => [
        'library' => [
          'dmpa_maps/dmpa_maps_highmaps',
        ],
        'drupalSettings' => [
          'geoField' => json_encode($maps[$country]),
        ],
      ],
    ];
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('dmpa_maps.manager')
    );
  }
}