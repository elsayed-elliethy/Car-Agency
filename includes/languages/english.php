<?php
        function lang ( $phrase ){
             
            static $lang = array (

                    'MESSAGE' => 'welcome',
                    'ADMIN' => 'Administrator'

            );

            return $lang [ $phrase ];

        }
        