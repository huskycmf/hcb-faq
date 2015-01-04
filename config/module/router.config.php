<?php
return array(
    'routes' => array(
        'hc-backend' => array(
            'child_routes' => array(
                'faq' => include __DIR__ . '/router/faq.config.php'
            )
        )
    )
);
