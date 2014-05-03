<?php
return array(
    'routes' => array(
        'hc-backend' => array(
            'child_routes' => array(
                'faq' => array(
                    'type' => 'literal',
                    'options' => array(
                        'route' => '/faq'
                    )
                )
            )
        )
    )
);
