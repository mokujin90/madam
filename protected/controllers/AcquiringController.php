<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Manekineko
 * Date: 07.09.14
 * Time: 19:43
 * To change this template use File | Settings | File Templates.
 */
class AcquiringController extends BaseController {
    public function init(){
        Yii::import('application.vendors.*');
        require_once('sofort/payment/sofortLibSofortueberweisung.inc.php');
        require_once('sofort/core/sofortLibNotification.inc.php');
        require_once('sofort/core/sofortLibTransactionData.inc.php');
    }
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

    public function actionSofort($companyId,$licenseId){
        $company = Company::model()->findByPk($companyId);
        $license = Company2License::getLicenseById($licenseId);




        // enter your configuration key – you only can create a new configuration key by creating
        // a new Gateway project in your account at sofort.com
        $configkey = '97766:201258:e39859925b61204a9b5bfe743bffd6b0';

        $Sofortueberweisung = new Sofortueberweisung($configkey);
        $Sofortueberweisung->setAmount($license['license']->getPrice());
        $Sofortueberweisung->setCurrencyCode('EUR');
        //$Sofortueberweisung->setSenderSepaAccount('SFRTDE20XXX', 'DE06000000000023456789', '1Max Mustermann');
        $Sofortueberweisung->setSenderCountryCode('DE');
        $Sofortueberweisung->setReason('TERMIN License');
        $Sofortueberweisung->setSuccessUrl(Yii::app()->createAbsoluteUrl("acquiring/SofortReturn",array('id'=>$license->id, 'trx' => '-TRANSACTION-')), true);
        $Sofortueberweisung->setAbortUrl(Yii::app()->createAbsoluteUrl("company/more"));
// $Sofortueberweisung->setNotificationUrl('http://www.google.de', 'loss,pending');
// $Sofortueberweisung->setNotificationUrl('http://www.yahoo.com', 'loss');
// $Sofortueberweisung->setNotificationUrl('http://www.bing.com', 'pending');
// $Sofortueberweisung->setNotificationUrl('http://www.sofort.com', 'received');
// $Sofortueberweisung->setNotificationUrl('http://www.youtube.com', 'refunded');
// $Sofortueberweisung->setNotificationUrl('http://www.youtube.com', 'untraceable');
        //$Sofortueberweisung->setNotificationUrl('http://www.twitter.com');
        $Sofortueberweisung->setCustomerprotection(true);

        $Sofortueberweisung->sendRequest();

        if($Sofortueberweisung->isError()) {
            //SOFORT-API didn't accept the data
            echo $Sofortueberweisung->getError();
        } else {
            //buyer must be redirected to $paymentUrl else payment cannot be successfully completed!
            $paymentUrl = $Sofortueberweisung->getPaymentUrl();
            header('Location: '.$paymentUrl);
        }
    }
    public function actionSofortReturn($id, $trx){
// enter your configuration key – you only can create a new configuration key by creating
// a new Gateway project in your account at sofort.com
            $configkey = '97766:201258:e39859925b61204a9b5bfe743bffd6b0';

// read the notification from php://input  (http://php.net/manual/en/wrappers.php.php)
// this class should be used as a callback function
// $SofortLib_Notification = new SofortLibNotification();

// $TestNotification = $SofortLib_Notification->getNotification(file_get_contents('php://input'));

// echo $SofortLib_Notification->getTransactionId();
// echo '<br />';
// echo $SofortLib_Notification->getTime();
// echo '<br />';

            $SofortLibTransactionData = new SofortLibTransactionData($configkey);

// If SofortLib_Notification returns a transaction_id:
//$SofortLibTransactionData->addTransaction($TestNotification);

//$SofortLibTransactionData->addTransaction(array('00907-01222-50F00112-D86E', '00907-01222-50EFFC79-7E33'));
//$SofortLibTransactionData->addTransaction(array('00907-37660-51D2CD5E-8182'));
            $SofortLibTransactionData->addTransaction($trx);
//$SofortLibTransactionData->setTime('2012-11-14T18:00+02:00', '2012-12-13T00:00+02:00');
//$SofortLibTransactionData->setNumber(5, 1);

            $SofortLibTransactionData->sendRequest();


            $output = array();
            $methods = array(
                'getAmount' => '',
                'getAmountRefunded' => '',
                'getCount' => '',
                'getPaymentMethod' => '',
                'getConsumerProtection' => '',
                'getStatus' => '',
                'getStatusReason' => '',
                'getStatusModifiedTime' => '',
                'getLanguageCode' => '',
                'getCurrency' => '',
                'getTransaction' => '',
                'getReason' => array(0,0),
                'getUserVariable' => 0,
                'getTime' => '',
                'getProjectId' => '',
                'getRecipientHolder' => '',
                'getRecipientAccountNumber' => '',
                'getRecipientBankCode' => '',
                'getRecipientCountryCode' => '',
                'getRecipientBankName' => '',
                'getRecipientBic' => '',
                'getRecipientIban' => '',
                'getSenderHolder' => '',
                'getSenderAccountNumber' => '',
                'getSenderBankCode' => '',
                'getSenderCountryCode' => '',
                'getSenderBankName' => '',
                'getSenderBic' => '',
                'getSenderIban' => '',
            );

            foreach($methods as $method => $params) {
                if(count($params) == 2) {
                    $output[] = $method . ': ' . $SofortLibTransactionData->$method($params[0], $params[1]);
                } else if($params !== '') {
                    $output[] = $method . ': ' . $SofortLibTransactionData->$method($params);
                } else {
                    $output[] = $method . ': ' . $SofortLibTransactionData->$method();
                }
            }

            if($SofortLibTransactionData->isError()) {
                echo $SofortLibTransactionData->getError();
            } else {
                echo implode('<br />', $output);
            }
    }
}