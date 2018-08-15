<?php

namespace Drupal\dmpa_maps\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

class DmpaMapsController extends ControllerBase{

    public function displayMaps(Request $request) {
        $country = $request->query->get('country');
        $year = $request->query->get('year');

        $maps = array(
          'kenya' => ['link' => 'https://code.highcharts.com/mapdata/countries/ke/ke-all.geo.json'],
          'uganda' => ['link' => 'https://code.highcharts.com/mapdata/countries/ug/ug-all.geo.json']
        );

        return array(
            '#type' => 'markup',
            '#theme' => 'dmpa_display_maps',
            '#attached' => array(
                'library' => array(
                    'dmpa_maps/dmpa_maps_highmaps'
                ),
              'drupalSettings' => array(
                'geoField' => json_encode($maps['uganda'])
              )
            ),
        );
    }
}