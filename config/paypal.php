<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/3/16
 * Time: 12:45 PM
 */

return array(
    // set your paypal credential
    'client_id' => 'Ab1S1xCU9r4nik8vtLSBt4MC26mqnmysBxhkapawIQwOZMob_sLhkbYxUNoKwMBC2sSXof6ozyTrflNB',
    'secret' => 'EEVgUESaXN8X4YbjK2AkRNFTZKux2ScQ-ScCEs91_DJkEjaxwlKZosPYIAjOrRm-iWYKF9Yo6_hFaMP5',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);