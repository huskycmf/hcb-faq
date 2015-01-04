<?php
return array(
    // Product
    'HcbFaq-Controller-Collection-List' => array(
        'parameters' => array(
            'paginatorDataFetchService' =>
                'HcbFaq-Service-Collection-FetchQbBuilder',
            'viewModel' => 'HcbFaq-Paginator-ViewModel-JsonModel'
        )
    ),

    'HcbFaq-Controller-View' => array(
        'parameters' => array(
            'fetchService' => 'HcbFaq-Service-FetchService',
            'extractor' => 'HcbFaq-Stdlib-Extractor-Resource'
        )
    ),

    'HcbFaq-Controller-Create' => array(
        'parameters' => array(
            'serviceCommand' => 'HcbFaq-Service-Create',
            'jsonResponseModelFactory' =>
                'HcbFaq-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbFaq-Controller-Collection-Delete' => array(
        'parameters' => array(
            'inputData' => 'HcbFaq-Data-Collection-Entities-ByIds',
            'serviceCommand' => 'HcbFaq-Service-Collection-Delete',
            'jsonResponseModelFactory' =>
                'HcbFaq-Json-View-StatusMessageDataModelFactory'
        )
    ),

    // Localized
    'HcbFaq-Controller-Localized-Collection-List' => array(
        'parameters' => array(
            'fetchService' => 'HcbFaq-Service-FetchService',
            'paginatorDataFetchService' =>
                'HcbFaq-Service-Localized-Collection-FetchArrayCollection',
            'viewModel' => 'HcbFaq-Paginator-ViewModel-JsonModel-Localized'
        )
    ),

    'HcbFaq-Controller-Localized-Update' => array(
        'parameters' => array(
            'inputData' => 'HcbFaq-Data-Localized',
            'fetchService' => 'HcbFaq-Service-FetchService-Localized',
            'serviceCommand' => 'HcbFaq-Service-Localized-UpdateCommand',
            'jsonResponseModelFactory' =>
                'HcbFaq-Json-View-StatusMessageDataModelFactory'
        )
    ),

    'HcbFaq-Controller-Localized-Create' => array(
        'parameters' => array(
            'inputData' => 'HcbFaq-Data-Localized',
            'fetchService' => 'HcbFaq-Service-FetchService',
            'serviceCommand' => 'HcbFaq-Service-Localized-CreateCommand',
            'jsonResponseModelFactory' =>
                'HcbFaq-Json-View-StatusMessageDataModelFactory'
        )
    )
);
