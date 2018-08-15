(function ($) {
   // 'use strict';

    Drupal.behaviors.dmpa_maps = {
        attach: function (context, settings) {

            $('.dmpa_maps').once().each(function(index, value) {
              var geoField = drupalSettings.geoField;
              var maps = JSON.parse(geoField);
                console.log(maps.link);
                //if ($(this).attr('data-map')) {
                    var id = $(this).attr('id');

                   //console.log(mapData);

                $.getJSON(maps.link, function (geojson) {
                var data = [{
                    "name": "Namayingo",
                    "value": 582.34,
                    "code": "NA"
                },
                    {
                        "name": "Buikwe",
                        "value": 53.08,
                        "code": "BU"
                    }
                ];

                    // Initiate the chart
                    Highcharts.mapChart(id, {
                      chart: {
                        map: geojson
                      },

                        title: {
                            text: 'Map border options'
                        },

                        mapNavigation: {
                            enabled: true,
                            buttonOptions: {
                                verticalAlign: 'bottom'
                            }
                        },

                        colorAxis: {
                            min: 1,
                            max: 1000,
                            type: 'logarithmic'
                        },

                        series: [{
                            data: data,
                            //mapData: Highcharts.maps['countries/ug/ug-all'],
                            //mapData: mapData,
                            joinBy: ['hc-a2', 'code'],
                            name: 'Population density',
                            borderColor: 'black',
                            borderWidth: 0.2,
                            states: {
                                hover: {
                                    borderWidth: 1
                                }
                            },
                            tooltip: {
                                valueSuffix: '/km²'
                            }
                        }]
                    });
                });



                // end of demo code
                //}
            });
        }
    };
}(jQuery, Drupal, drupalSettings));