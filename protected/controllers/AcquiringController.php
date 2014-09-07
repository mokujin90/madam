<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manekineko
 * Date: 07.09.14
 * Time: 19:43
 * To change this template use File | Settings | File Templates.
 */
class AcquiringController extends BaseController {

    public function actionPaypal(){
        $e=new ExpressCheckout;
        $products=array(
            '0'=>array(
                'NAME'=>'p1',
                'AMOUNT'=>'1.00',
                'QTY'=>'1'
            ),
        );
        $e->setCurrencyCode("EUR");//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)
        $e->setProducts($products); /* Set array of products*/
        $e->returnURL=Yii::app()->createAbsoluteUrl("site/PaypalReturn");
        $e->cancelURL=Yii::app()->createAbsoluteUrl("site/PaypalCancel");
        $result=$e->requestPayment();
        if(strtoupper($result["ACK"])=="SUCCESS")
        {
            /*redirect to the paypal gateway with the given token */
            header("location:".$e->PAYPAL_URL.$result["TOKEN"]);
        }

    }

}