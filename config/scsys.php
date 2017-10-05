<?php
//\Config::get('scsys.OPERATION.EDIT')

return [

  'UNDEFINED' => '0',

  'MODULES'   =>  [
                  'SIIE' => '5',
                  'MMS' => '1',
                  'QMS' => '2',
                  'WMS' => '3',
                  'TMS' => '4',
                ],

  'TP_USER' => ['ADMIN' => '1',
                  'DEFAULT' => '2'],

	'PRIVILEGES' => ['NA' => '1',
                    'READER' => '2',
                    'AUTHOR' => '3',
                    'EDITOR' => '4',
                    'MANAGER' => '5'],

  'OPERATION' => ['CREATE' => '0',
                  'EDIT' => '1',
                  'DEL' => '2'],

  'STATUS' => [
                'ACTIVE' => '0',
                'DEL' => '1',
                'CLOSED' => '1',
                'OPENED' => '0',
              ],

  'FILTER' => ['DELETED' => '1',
                'ACTIVES' => '2',
                'ALL' => '3']
];
