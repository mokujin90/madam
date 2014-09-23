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
            $license->doPayment();
            $license->save();
            $this->createSaleskingInvoice($license->company_id, $id, 'PayPal');
        }
        $this->redirect($this->createUrl('employee/create'));
    }

    public function actionSofort($companyId,$licenseId){
        $company = Company::model()->findByPk($companyId);
        $license = Company2License::getLicenseById($licenseId);

        // enter your configuration key – you only can create a new configuration key by creating
        // a new Gateway project in your account at sofort.com
        $configkey = '97906:201751:cf345fee0ec56059b7489220b3176739';

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
            $configkey = '97906:201751:cf345fee0ec56059b7489220b3176739';

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


        $license = Company2License::getLicenseById($id);
        $license->doPayment();
        $license->save();
        $this->createSaleskingInvoice($license->company_id, $id, 'Sofort');

        $this->redirect($this->createUrl('company/more'));

        return;
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
    private function createSaleskingInvoice($companyId,$licenseId, $title){
        $company = Company::model()->findByPk($companyId);
        $license = Company2License::getLicenseById($licenseId);

        $pdfTemplateID = Yii::app()->params['SK_PDF_TAMPLATE_ID'];
        $emailTemplateID = Yii::app()->params['SK_EMAIL_TAMPLATE_ID'];
        $domain = Yii::app()->params['SK_DOMAIN'];

        if(!$company->salesking_clinet_id){
            $send = array(
                "contact" => array(
                    "type" => "Client",
                    "phone_office" => "",
                    "organisation" => $company->name,
                    "email" => $company->email,
                    "addresses" => array(
                        array(
                            "address" => array(
                                "address1" => $company->address,
                                "city" => $company->city,
                                "zip" => $company->zip,
                            )
                        )
                    )
                )
            );

            $contactRespond = $this->sendJson($send, "https://$domain.salesking.eu/api/contacts/");
            if(!$contactRespond){
                return;
            }
            $clientID = $contactRespond->contact->id;
            $company->salesking_clinet_id = $clientID;
            $company->save(false);
        } else {
            $clientID = $company->salesking_clinet_id;
        }
        $send = array(
            "invoice" => array(
                "contact_id" => $clientID,
                "title" => "($title) Your invoice No. [number]",
                "status" => "open",
                "line_items" => array(
                    array(
                        "line_item" => array(
                            "name" => $license['license']->getName(),
                            "price_single" => $license['license']->getPrice(),
                        )
                    )
                )
            )
        );
        $this->sendJson($send, "https://$domain.salesking.eu/api/invoices/");
    }
    public function actionSalesking($companyId,$licenseId) {
        $company = Company::model()->findByPk($companyId);
        $license = Company2License::getLicenseById($licenseId);

        $pdfTemplateID = Yii::app()->params['SK_PDF_TAMPLATE_ID'];
        $emailTemplateID = Yii::app()->params['SK_EMAIL_TAMPLATE_ID'];
        $domain = Yii::app()->params['SK_DOMAIN'];

        if($company->salesking_clinet_id){
            $send = array(
                "client" => array(
                    "phone_office" => "",
                    "organisation" => $company->name,
                    "email" => $company->email,
                    "bank_name" => "",
                    "bank_number" => "",
                    "bank_account_number" => "",
                    "bank_iban" => $company->iban,//"AL47212110090000000235698741",
                    "bank_swift" => $company->bic,
                    "bank_owner" => "",
                )
            );
            $contactRespond = $this->sendJson($send, "https://$domain.salesking.eu/api/clients/{$company->salesking_clinet_id}", true);
        } else {
            $send = array(
                "contact" => array(
                    "type" => "Client",
                    "phone_office" => "",
                    "organisation" => $company->name,
                    "email" => $company->email,
                    "bank_name" => "",
                    "bank_number" => "",
                    "bank_account_number" => "",
                    "bank_iban" => $company->iban,//"AL47212110090000000235698741",
                    "bank_swift" => $company->bic,
                    "bank_owner" => "",
                    "addresses" => array(
                        array(
                            "address" => array(
                                "address1" => $company->address,
                                "city" => $company->city,
                                "zip" => $company->zip,
                            )
                        )
                    )
                )
            );
            $contactRespond = $this->sendJson($send, "https://$domain.salesking.eu/api/contacts/");
        }
        $errorAlias = array(
                'bank_iban' => 'IBAN',
                'bank_swift' => 'BIC'
            );
        if (!$contactRespond) {
            if ($this->saleskingError && isset($this->saleskingError->errors)) {
                $fields = array();
                foreach ($this->saleskingError->errors as $error) {
                    $fields[] = isset($errorAlias[$error[0]]) ? $errorAlias[$error[0]] : $error[0];
                }
                Yii::app()->user->setFlash('alert', Yii::t('main', 'Ошибка при создании клиента. Проверьте поля: ') . implode(', ', $fields));
            } else {
                Yii::app()->user->setFlash('alert', Yii::t('main', 'Ошибка при создании клиента. Повторите попытку позже.'));
            }
            $this->redirect('/company/more');
            return;
        }

        if($company->salesking_clinet_id){
            $clientID = $company->salesking_clinet_id;
        } else {
            $clientID = $contactRespond->contact->id;
            $company->salesking_clinet_id = $clientID;
            $company->save(false);
        }

        $send = array(
            "invoice" => array(
                "contact_id" => $clientID,
                "title" => "Your invoice No. [number]",
                "status" => "open",
                "line_items" => array(
                    array(
                        "line_item" => array(
                            "name" => $license['license']->getName(),
                            //"description" => "",
                            "price_single" => $license['license']->getPrice(),
                        )
                    )
                )
            )
        );
        $invoiceRespond = $this->sendJson($send, "https://$domain.salesking.eu/api/invoices/");
        if(!$invoiceRespond){
            Yii::app()->user->setFlash('alert', Yii::t('main', 'Ошибка при создании счета. Повторите попытку позже.'));
            $this->redirect('/company/more');
            return;
        }

        $send = array("template_id" => $pdfTemplateID);

        if(empty($company->email)){
            Yii::app()->user->setFlash('alert', Yii::t('main', 'Поле Email компании не заполнено'));
            $this->redirect('/company/more');
            return;
        }
        if(!$answer = $this->sendJson($send, "https://$domain.salesking.eu/api/invoices/{$invoiceRespond->invoice->id}/print")){
            Yii::app()->user->setFlash('alert', Yii::t('main', 'Ошибка при создании счета(PDF). Повторите попытку позже'));
            $this->redirect('/company/more');
            return;
        }
        $send = array(
            "email" => array("to_addr" => $company->email, "from_addr" => Yii::app()->params['fromEmail']),
            "template_id" => $emailTemplateID,
            "send" => "1",
            "archived_pdf" => "1"
        );
        if(!$this->sendJson($send, "https://$domain.salesking.eu/api/invoices/{$invoiceRespond->invoice->id}/emails")){
            Yii::app()->user->setFlash('alert', Yii::t('main', 'Ошибка при отправке письма на адрес комании') . ' ' . $company->email);
            $this->redirect('/company/more');
            return;
        }

        Yii::app()->user->setFlash('alert', Yii::t('main', 'Счет выслан на почту комании') . ' ' . $company->email);
        $this->redirect('/company/more');
    }

    private $saleskingError;
    private function sendJson($json, $url, $put = false){
        $this->saleskingError = false;
        $username = 'grebenzow@gmail.com';
        $password = 'nezer8865';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$password"); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if($put){
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen(json_encode($json))));
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate

        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ( $status != 201 && $status != 200) {
            if(isset($response->errors)){
                $this->saleskingError = $response;
            }
            return false;
        }
        curl_close($curl);
        return $response;

    }

}