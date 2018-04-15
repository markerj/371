<?php
        class Constants {

        function __construct($clientURL)
        {
                $this->HOSTNAME=$clientURL;
        }

                public $HOSTNAME = "";
                public $KEY = '7acddac1-a568-43f6-a0b4-cfb0b4616c2f';
                public $SECRET = 'aTmYE74Gtcq8AZEYtQ17u8zGlaMN3rJc';

                public $AUTH_PATH = '/learn/api/public/v1/oauth2/token';
                public $DSK_PATH = '/learn/api/public/v1/dataSources';
                public $TERM_PATH = '/learn/api/public/v1/terms';
                public $COURSE_PATH = '/learn/api/public/v1/courses';
                public $USER_PATH = '/learn/api/public/v1/users';

                public $ssl_verify_peer = FALSE;
                public $ssl_verify_host =  FALSE;
        }
?>
                     