<?php
        function lang ( $phrase ){
             
            static $lang = array (

                    'MESSAGEE' => 'اسلام ناصف الشويمي',
                    'ADMIN' => 'Administrator'

            );

            return $lang [ $phrase ];

        }