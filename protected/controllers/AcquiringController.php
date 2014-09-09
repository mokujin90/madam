<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manekineko
 * Date: 07.09.14
 * Time: 19:43
 * To change this template use File | Settings | File Templates.
 */
class AcquiringController extends BaseController {

    public function actionPaypal($companyId,$licenseId){
        $company = Company::model()->findByPk($companyId);
        $license = Company2License::getLicenseById($licenseId);
        $e=new ExpressCheckout;
        $products=array(
            '0'=>array(
                'NAME'=>$license['license']->getName(),
                'AMOUNT'=>$license['license']->getPrice(),
                'QTY'=>'1'
            ),
        );
        $e->setCurrencyCode("EUR");//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)
        $e->setProducts($products); /* Set array of products*/
        $e->returnURL=Yii::app()->createAbsoluteUrl("acquiring/PaypalReturn",array('id'=>$license->id));
        $e->cancelURL=Yii::app()->createAbsoluteUrl("company/more");
        $result=$e->requestPayment();
        if(strtoupper($result["ACK"])=="SUCCESS")
        {
            /*redirect to the paypal gateway with the given token */
            header("location:".$e->PAYPAL_URL.$result["TOKEN"]);
        }
    }

    public function actionPaypalReturn($id){
        $e=new ExpressCheckout;
        $paymentDetails=$e->getPaymentDetails($_REQUEST['token']);
        if($paymentDetails['ACK']=="Success")
        {

            $ack=$e->doPayment($paymentDetails);  //2.Do payment
            $license = Company2License::getLicenseById($id);
            $license->is_agree=1;
            $license->save();
        }
        $this->redirect($this->createUrl('employee/create'));
    }

}