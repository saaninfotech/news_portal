<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Helper class for the Paypal Payment Process. This class supports the Express Checkout and the
 * Direct Payment methods by Paypal.
 *
 * @author: Saurabh Sinha
 * @created on: 02/15/13 3:29 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class PaypalPayment
{
    //This is the return URL. The URL where the Paypal willl return on your site after the completion of the payment process
    static $_returnURL;

    //This is the Cancel URL. The URL where the page will be navigated if the user cancel the payment process.
    static $_cancelURL;

    //This is the Amount value. This is the amount for which the transaction will be carried out.
    static $_amountValue;

    //This is the Currency Type. The tpye of currency in which the transaction is done.
    static $_currencyCodeType;

    //This is the Payment Type. This describes the kind of payment being processed.
    static $_paymentType;

    //This is the Description. This is the description of the payment process being carried out.
    static $_description;

    //This is the Token returned from the transaction.
    static $_token;

    //This is the Payer ID returned from any transaction.
    static $_payerID;

    /**
     * @purpose: This function sets the variables required for the Express checkout to be carried out.
     * @author: Saurabh Sinha
     *
     * @param $returnURL
     * @param $cancelURL
     * @param $amountValue
     * @param $currencyCodeType
     * @param $paymentType
     * @param $description
     */
    static public function setVariablesForExpChkOut($returnURL, $cancelURL, $amountValue, $currencyCodeType, $paymentType, $description)
    {
        self::$_returnURL = $returnURL;
        self::$_cancelURL = $cancelURL;
        self::$_amountValue = $amountValue;
        self::$_currencyCodeType = $currencyCodeType;
        self::$_paymentType = $paymentType;
        self::$_description = nl2br($description);
    }

    /**
     * @purpose: This function initiates the express checkout and returns an array om completion.
     * @author: Saurabh Sinha
     * @return mixed
     */
    static public function initExpressCheckout()
    {
        $nvpstr = "&PAYMENTREQUEST_0_AMT=" . self::$_amountValue;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=" . self::$_paymentType;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_DESC=" . self::$_description;
        $nvpstr = $nvpstr . "&RETURNURL=" . self::$_returnURL;
        $nvpstr = $nvpstr . "&CANCELURL=" . self::$_cancelURL;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_CURRENCYCODE=" . self::$_currencyCodeType;

        $_SESSION["currencyCodeType"] = self::$_currencyCodeType;
        $_SESSION["PaymentType"] = self::$_paymentType;

        //'---------------------------------------------------------------------------------------------------------------
        //' Make the API call to PayPal
        //' If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.
        //' If an error occured, show the resulting errors
        //'---------------------------------------------------------------------------------------------------------------
        $resArray = self::hashCall("SetExpressCheckout", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            self::$_token = urldecode($resArray["TOKEN"]);
            self::redirectToPaypal();
        }

        return $resArray;
    }

    /**
     * @purpose: This function redirects to paypal with the Token value for the transaction to be carried out.
     * @author: Saurabh Sinha
     */
    static function redirectToPaypal()
    {
        $payPalURL = PAYPAL_URL . self::$_token;
        header("Location: " . $payPalURL);
    }

    /**
     * @purpose: This function sets the Payer ID value.
     * @author: Saurabh Sinha
     *
     * @param $payerID
     */
    static function setPayerID($payerID)
    {
        self::$_payerID = $payerID;
    }

    /**
     * @purpose: This function sets the Token value.
     * @author: Saurabh Sinha
     *
     * @param $tokenID
     */
    static function setTokenID($tokenID)
    {
        self::$_token = $tokenID;
    }

    /**
     * @purpose: This function get the shipping details and the complete transaction details in an array.
     * @author: Saurabh Sinha
     *
     * @param $amountValue
     * @param $paymentType
     * @param $currencyCodeType
     *
     * @return mixed
     */
    static function getShippingDetails($amountValue, $paymentType, $currencyCodeType)
    {

        $nvpstr = "&PAYMENTREQUEST_0_AMT=" . $amountValue;
        $nvpstr = $nvpstr . "&TOKEN=" . self::$_token;
        $nvpstr = $nvpstr . "&PAYERID=" . self::$_payerID;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=" . $paymentType;
        $nvpstr = $nvpstr . "&PAYMENTREQUEST_0_CURRENCYCODE=" . $currencyCodeType;

        //'---------------------------------------------------------------------------
        //' Make the API call and store the results in an array.
        //'	If the call was a success, show the authorization details, and provide
        //' 	an action to complete the payment.
        //'	If failed, show the error
        //'---------------------------------------------------------------------------

        // Add request-specific fields to the request string.
        //$nvpStr = "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyID";

        $resArray = self::hashCall("DoExpressCheckoutPayment", $nvpstr);
        $ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
            self::$_payerID = $resArray['PAYERID'];
        }

        return $resArray;
    }

    /**
     * @purpose: This function generates the hash url for the transaction to be carried out and then makes a CURL request
     * for the transaction process.
     * @author: Saurabh Sinha
     *
     * @param $methodName
     * @param $nvpStr
     *
     * @return mixed
     */
    static function hashCall($methodName, $nvpStr)
    {
        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PAYPAL_API_ENDPOINT);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        //turning off the server and peer verification(TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
        //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php
        if (PAYPAL_USE_PROXY) {
            curl_setopt($ch, CURLOPT_PROXY, PAYPAL_PROXY_HOST . ":" . PAYPAL_PROXY_PORT);
        }

        //NVPRequest for submitting to server
        $nvpreq = "METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode(PAYPAL_VERSION) . "&PWD=" . urlencode(PAYPAL_API_PASSWORD) . "&USER=" . urlencode(PAYPAL_API_USERNAME) . "&SIGNATURE=" . urlencode(PAYPAL_API_SIGNATURE) . $nvpStr . "&BUTTONSOURCE=" . urlencode(PAYPAL_SBNCODE);

        //setting the nvpreq as POST FIELD to curl
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

        //getting response from server
        $response = curl_exec($ch);

        //converting NVPResponse to an Associative Array
        $nvpResArray = self::deformatNVP($response);
        $nvpReqArray = self::deformatNVP($nvpreq);
        $_SESSION['nvpReqArray'] = $nvpReqArray;

        if (curl_errno($ch)) {
            // moving to display page to display curl errors
            $_SESSION['curl_error_no'] = curl_errno($ch);
            $_SESSION['curl_error_msg'] = curl_error($ch);

            //Execute the Error handling module to display errors.
        } else {
            //closing the curl
            curl_close($ch);
        }

        return $nvpResArray;
    }


    /**
     * @purpose: This function sets the variables required for the Direct Payment to be carried out.
     * @author: Saurabh Sinha
     *
     * @param $amountValue
     * @param $currencyCodeType
     * @param $paymentType
     */
    static public function setVariablesForDirectPayment($amountValue, $currencyCodeType, $paymentType)
    {
        self::$_amountValue = $amountValue;
        self::$_currencyCodeType = $currencyCodeType;
        self::$_paymentType = $paymentType;
    }


    /**
     * @purpose: This function initiates the Direct Payment and returns an array om completion.
     * @author: Saurabh Sinha
     * @param $arg
     * @return string
     */
    static public function initDirectPayment($arg)
    {
        $nvpstr = "&AMT=" . self::$_amountValue;
        $nvpstr = $nvpstr . "&PAYMENTACTION=" . self::$_paymentType;
        $nvpstr = $nvpstr . "&CURRENCYCODE=" . self::$_currencyCodeType;
        $nvpstr = $nvpstr . "&CREDITCARDTYPE=" . $arg['credit_card_type'];
        $nvpstr = $nvpstr . "&ACCT=" . $arg['credit_card_num'];
        $nvpstr = $nvpstr . "&EXPDATE=" . $arg['exp_date'];
        $nvpstr = $nvpstr . "&CVV2=" . $arg['security_code'];
        $nvpstr = $nvpstr . "&FIRSTNAME=" . $arg['first_name'];
        $nvpstr = $nvpstr . "&LASTNAME=" . $arg['last_name'];
        $nvpstr = $nvpstr . "&STREET=" . $arg['address'];
        $nvpstr = $nvpstr . "&CITY=" . $arg['city'];
        $nvpstr = $nvpstr . "&STATE=" . $arg['state'];
        $nvpstr = $nvpstr . "&ZIP=" . $arg['zip'];
        $nvpstr = $nvpstr . "&COUNTRYCODE=" . 'US';
        //'---------------------------------------------------------------------------------------------------------------
        //' Make the API call to PayPal
        //' If the API call succeded, then it returned the resulting array.
        //' If an error occured, show the resulting errors
        //'---------------------------------------------------------------------------------------------------------------
        $resArray = self::hashCall("doDirectPayment", $nvpstr);
        /*$ack = strtoupper($resArray["ACK"]);
        if ($ack == "SUCCESS") {
            return $transaction_id = urldecode($resArray["TRANSACTIONID"]);
        }
        else {
            return $_SESSION['t_error_msg'] = 'Transaction Could Not Be  Processed';
        } */
        return $resArray;

    }

    /**
     * @purpose: This function manages the format of the data transfered over URL.
     * @author: Saurabh Sinha
     * @param $nvpstr
     * @return array
     */
    static function deformatNVP($nvpstr)
    {
        $intial = 0;
        $nvpArray = array();

        while (strlen($nvpstr)) {
            //postion of Key
            $keypos = strpos($nvpstr, '=');
            //position of value
            $valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&') : strlen($nvpstr);

            /*getting the Key and Value values and storing in a Associative Array*/
            $keyval = substr($nvpstr, $intial, $keypos);
            $valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
            //decoding the respose
            $nvpArray[urldecode($keyval)] = urldecode($valval);
            $nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
        }

        return $nvpArray;
    }


}



