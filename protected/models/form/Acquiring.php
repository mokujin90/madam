<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manekineko
 * Date: 07.09.14
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */
class Acquiring extends CFormModel{
    const SOFORT_ID = 97657;
    const SOFORT_URL = 'https://secure.ultracart.com/cgi-bin/UCSofortSuccess';

    static $paypal=array(
        'url'=>'https://www.paypal.com/cgi-bin/webscr',
        'mail'=>'multik@nxt.ru',
        'return' => '/company/more',
        'currency'=>'RUB',

    );

}