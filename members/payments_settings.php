<?if(!defined("site_root")){exit();}?>
<?

$payments=array();
$payments["mellat"]="mellat";
$payments["2checkout"]="2Checkout";
$payments["authorize"]="Authorize";
$payments["cashu"]="CashU";
$payments["cashx"]="CashX";
$payments["ccbill"]="ccBill";
$payments["chronopay"]="ChronoPay";
$payments["clickbank"]="ClickBank";
$payments["dotpay"]="Dotpay";
$payments["dwolla"]="Dwolla";
$payments["egold"]="Egold";
$payments["enets"]="eNETs";
$payments["epassporte"]="ePassporte";
$payments["epay"]="Epay";
$payments["epaykkbkz"]="Epay.kkb.kz";
$payments["epoch"]="Epoch";
$payments["eway"]="eWay";
$payments["fortumo"]="Fortumo";
$payments["google"]="Google Checkout";
$payments["linkpoint"]="Linkpoint";
$payments["moneyua"]="Money.ua";
$payments["moneybookers"]="MoneyBookers";
$payments["multicards"]="MultiCards";
$payments["myvirtualmerchant"]="MyVirtualMerchant";
$payments["nochex"]="Nochex";
$payments["pagseguro"]="PagSeguro";
$payments["paypal"]="درگاه ملت";
$payments["paypalpro"]="Paypal PRO";
$payments["payprin"]="PayPrin";
$payments["paysera"]="Paysera";
$payments["paxum"]="Paxum";
$payments["payu"]="PayU";
$payments["privatbank"]="PrivatBank.ua";
$payments["alertpay"]="Payza";
$payments["robokassa"]="Robokassa";
$payments["rbkmoney"]="RBK Money";
$payments["secpay"]="SECPay";
$payments["segpay"]="Segpay";
$payments["stripe"]="Stripe";
$payments["webmoney"]="Webmoney";
$payments["worldpay"]="Worldpay";
$payments["qiwi"]="QIWI";
$payments["zombaio"]="Zombaio";


























//Paypal gateway
$site_paypal_account="";
$site_paypal_ipn=0;
$sql="select account,ipn,url,activ from gateway_paypal";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_paypal_account=$rs->row["account"];
	$site_paypal_ipn=$rs->row["ipn"];
	if(!defined("paypal_url"))
	{
		define( "paypal_url", $rs->row["url"] );
	}
}

$site_mellat_account="";
$site_mellat_ipn=0;
$sql="select account,ipn,url,activ from gatewaymellat";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_mellat_account=$rs->row["account"];
	$site_mellat_ipn=$rs->row["ipn"];
	if(!defined("mellat_url"))
	{
		define( "mellat_url", $rs->row["url"] );
	}
}


//Paypal PRO gateway
$site_paypalpro_account="";
$site_paypalpro_password="";
$site_paypalpro_signature="";
$site_paypalpro_ipn=0;

$sql="select account,ipn,password,signature,activ from gateway_paypalpro";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_paypalpro_account=$rs->row["account"];
	$site_paypalpro_password=$rs->row["password"];
	$site_paypalpro_signature=$rs->row["signature"];
	$site_paypalpro_ipn=$rs->row["ipn"];
}




//Authorize gateway
$site_authorize_account="";
$site_authorize_account2="";
$site_authorize_ipn=0;

$sql="select activ,account,txnkey,ipn,url from gateway_authorize";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_authorize_account=$rs->row["account"];
	$site_authorize_account2=$rs->row["txnkey"];
	$site_authorize_ipn=$rs->row["ipn"];
	if(!defined("authorize_url"))
	{
		define( "authorize_url", $rs->row["url"] );
	}
}


//2Checkout gateway
$site_2checkout_account="";
$site_2checkout_ipn=0;

$sql="select activ,account,ipn,url from gateway_2checkout";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_2checkout_account=$rs->row["account"];
	$site_2checkout_ipn=$rs->row["ipn"];
	if(!defined("checkout2_url"))
	{
		define( "checkout2_url", $rs->row["url"] );
	}
}



//E-gold gateway
$site_egold_account="";
$site_egold_name="";
$site_egold_ipn=0;

$sql="select activ,account,name,ipn,url from gateway_egold";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_egold_account=$rs->row["account"];
	$site_egold_name=$rs->row["name"];
	$site_egold_ipn=$rs->row["ipn"];
	if(!defined("egold_url"))
	{
		define( "egold_url", $rs->row["url"] );
	}
}


//Worldpay gateway
$site_worldpay_account="";
$site_worldpay_ipn=0;

$sql="select activ,account,ipn,url from gateway_worldpay";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_worldpay_account=$rs->row["account"];
	$site_worldpay_ipn=$rs->row["ipn"];
	if(!defined("worldpay_url"))
	{
		define( "worldpay_url", $rs->row["url"] );
	}
}

//Linkpoint gateway
$site_linkpoint_account="";
$site_linkpoint_ipn=0;

$sql="select activ,account,ipn,url from gateway_linkpoint";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_linkpoint_account=$rs->row["account"];
	$site_linkpoint_ipn=$rs->row["ipn"];
	if(!defined("linkpoint_url"))
	{
		define( "linkpoint_url", $rs->row["url"] );
	}
}


//E-passporte gateway
$site_epassporte_account="";
$site_epassporte_code="";
$site_epassporte_ipn=0;

$sql="select activ,account,pcode,ipn,url from gateway_epassporte";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_epassporte_account=$rs->row["account"];
	$site_epassporte_code=$rs->row["pcode"];
	$site_epassporte_ipn=$rs->row["ipn"];
	if(!defined("epassporte_url"))
	{
		define( "epassporte_url", $rs->row["url"] );
	}
}


//Chronopay gateway
$site_chronopay_account="";
$site_chronopay_code="";
$site_chronopay_ipn=0;

$sql="select activ,account,ekey,ipn,url from gateway_chronopay";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_chronopay_account=$rs->row["account"];
	$site_chronopay_code=$rs->row["ekey"];
	$site_chronopay_ipn=$rs->row["ipn"];
	if(!defined("chronopay_url"))
	{
		define( "chronopay_url", $rs->row["url"] );
	}
}


//Secpay gateway
$site_secpay_account="";
$site_secpay_password="";
$site_secpay_subject="";
$site_secpay_message="";
$site_secpay_ipn=0;

$sql="select activ,account,password,subject,message,ipn,url from gateway_secpay";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_secpay_account=$rs->row["account"];
	$site_secpay_password=$rs->row["password"];
	$site_secpay_subject=$rs->row["subject"];
	$site_secpay_message=$rs->row["message"];
	$site_secpay_ipn=$rs->row["ipn"];
	if(!defined("secpay_url"))
	{
		define( "secpay_url", $rs->row["url"] );
	}
}



//Moneybookers gateway
$site_moneybookers_account="";
$site_moneybookers_password="";
$site_moneybookers_ipn=0;

$sql="select activ,account,ipn,url,password from gateway_moneybookers";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_moneybookers_account=$rs->row["account"];
	$site_moneybookers_ipn=$rs->row["ipn"];
	$site_moneybookers_password=$rs->row["password"];
	if(!defined("moneybookers_url"))
	{
		define( "moneybookers_url", $rs->row["url"] );
	}
}



//Nochex gateway
$site_nochex_account="";
$site_nochex_ipn=0;

$sql="select activ,account,ipn,url from gateway_nochex";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_nochex_account=$rs->row["account"];
	$site_nochex_ipn=$rs->row["ipn"];
	if(!defined("nochex_url"))
	{
		define( "nochex_url", $rs->row["url"] );
	}
}


//eWay gateway
$site_eway_account="";
$site_eway_ipn=0;

$sql="select activ,account,ipn,url from gateway_eway";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_eway_account=$rs->row["account"];
	$site_eway_ipn=$rs->row["ipn"];
	if(!defined("eway_url"))
	{
		define( "eway_url", $rs->row["url"] );
	}
}


//eNETS gateway
$site_enets_account="";
$site_enets_ipn=0;

$sql="select activ,account,ipn,url from gateway_enets";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_enets_account=$rs->row["account"];
	$site_enets_ipn=$rs->row["ipn"];
	if(!defined("enets_url"))
	{
		define( "enets_url", $rs->row["url"] );
	}
}


//Segpay gateway
$site_segpay_account="";
$site_segpay_ipn=0;

$sql="select activ,ipn,url from gateway_segpay where subscription=0 and credits=0";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_segpay_account='yes';
	$site_segpay_ipn=$rs->row["ipn"];

}
if(!$rs->eof)
{
	if(!defined("segpay_url"))
	{
		define( "segpay_url", $rs->row["url"] );
	}
}




//Google Checkout gateway
$site_google_account="";
$site_google_ipn=0;

$sql="select activ,account,mkey,ipn,url from gateway_google";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_google_account=$rs->row["account"];
	$site_google_key=$rs->row["mkey"];
	$site_google_ipn=$rs->row["ipn"];
	if(!defined("google_url"))
	{
		define( "google_url", $rs->row["url"] );
	}
}


//CashU gateway
$site_cashu_account="";
$site_cashu_ipn=0;

$sql="select activ,account,ecode,ipn,url from gateway_cashu";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_cashu_account=$rs->row["account"];
	$site_cashu_key=$rs->row["ecode"];
	$site_cashu_ipn=$rs->row["ipn"];
	if(!defined("cashu_url"))
	{
		define( "cashu_url", $rs->row["url"] );
	}
}


//Webmoney gateway
$site_webmoney_account="";
$site_webmoney_ipn=0;

$sql="select activ,account,ecode,ipn,url from gateway_webmoney";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_webmoney_account=$rs->row["account"];
	$site_webmoney_key=$rs->row["ecode"];
	$site_webmoney_ipn=$rs->row["ipn"];
	if(!defined("webmoney_url"))
	{
		define( "webmoney_url", $rs->row["url"] );
	}
}


//Epoch gateway
$site_epoch_account="";
$site_epoch_ipn=0;

$sql="select activ,account,ipn,url from gateway_epoch where subscription=0 and credits=0";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_epoch_account=$rs->row["account"];
	$site_epoch_ipn=$rs->row["ipn"];
}
if(!$rs->eof)
{
	if(!defined("epoch_url"))
	{
		define( "epoch_url", $rs->row["url"] );
	}
}


//ccBill gateway
$site_ccbill_account="";
$site_ccbill_account2="";
$site_ccbill_account3="";
$site_ccbill_ipn=0;

$sql="select activ,account,account2,account3,ipn,url from gateway_ccbill where subscription=0 and credits=0";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_ccbill_account=$rs->row["account"];
	$site_ccbill_account2=$rs->row["account2"];
	$site_ccbill_account3=$rs->row["account3"];
	$site_ccbill_ipn=$rs->row["ipn"];
}
if(!$rs->eof)
{
	if(!defined("ccbill_url"))
	{
		define( "ccbill_url", $rs->row["url"] );
	}
}





//Multicards gateway
$site_multicards_account="";
$site_multicards_account2="";
$site_multicards_account3="";
$site_multicards_ipn=0;

$sql="select activ,account,account2,password,ipn,url from gateway_multicards";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_multicards_account=$rs->row["account"];
	$site_multicards_account2=$rs->row["account2"];
	$site_multicards_account3=$rs->row["password"];
	$site_multicards_ipn=$rs->row["ipn"];
	if(!defined("multicards_url"))
	{
		define( "multicards_url", $rs->row["url"] );
	}
}


//ClickBank gateway
$site_clickbank_account="";
$site_clickbank_account2="";
$site_clickbank_account3="";
$site_clickbank_ipn=0;

$sql="select activ,account,account2,ipn,url from gateway_clickbank where subscription=0 and credits=0";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_clickbank_account=$rs->row["account"];
	$site_clickbank_account2=$rs->row["account2"];
	$site_clickbank_ipn=$rs->row["ipn"];
}
if(!$rs->eof)
{
	if(!defined("clickbank_url"))
	{
		define( "clickbank_url", $rs->row["url"] );
	}
}


//cashX
$site_cashx_account="";
$site_cashx_ipn=0;
$site_cashx_security="";

$sql="select activ,account,ipn,url,security_code from gateway_cashx";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_cashx_account=$rs->row["account"];
	$site_cashx_ipn=$rs->row["ipn"];
	$site_cashx_security=$rs->row["security_code"];
	if(!defined("cashx_url"))
	{
		define( "cashx_url", $rs->row["url"] );
	}
}


//Alertpay
$site_alertpay_account="";
$site_alertpay_ipn=0;
$site_alertpay_security="";

$sql="select activ,account,ipn,url,security_code from gateway_alertpay";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_alertpay_account=$rs->row["account"];
	$site_alertpay_ipn=$rs->row["ipn"];
	$site_alertpay_security=$rs->row["security_code"];
	if(!defined("alertpay_url"))
	{
		define( "alertpay_url", $rs->row["url"] );
	}
}


//Epay.bg
$site_epay_account="";
$site_epay_ipn=0;
$site_epay_security="";

$sql="select activ,account,ipn,url,security_code from gateway_epay";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_epay_account=$rs->row["account"];
	$site_epay_ipn=$rs->row["ipn"];
	$site_epay_security=$rs->row["security_code"];
	if(!defined("epay_url"))
	{
		define( "epay_url", $rs->row["url"] );
	}
}

//QIWI gateway
$site_qiwi_account="";
$site_qiwi_password="";
$site_qiwi_ipn=0;

$sql="select activ,account,password,ipn,url from gateway_qiwi";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_qiwi_account=$rs->row["account"];
	$site_qiwi_code=$rs->row["password"];
	$site_qiwi_ipn=$rs->row["ipn"];
}

//MyVirtualMerchant gateway
$site_myvirtualmerchant_account="";
$site_myvirtualmerchant_account2="";
$site_myvirtualmerchant_password="";
$site_myvirtualmerchant_ipn=0;

$sql="select activ,account,account2,password,ipn,url from gateway_myvirtualmerchant";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_myvirtualmerchant_account=$rs->row["account"];
	$site_myvirtualmerchant_account2=$rs->row["account2"];
	$site_myvirtualmerchant_code=$rs->row["password"];
	$site_myvirtualmerchant_ipn=$rs->row["ipn"];
}


//Fortumo gateway
$site_fortumo_account="";
$site_fortumo_password="";

$sql="select activ,account,password from gateway_fortumo";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_fortumo_account=$rs->row["account"];
	$site_fortumo_code=$rs->row["password"];
}


//Zombaio gateway
$site_zombaio_account="";
$site_zombaio_password="";
$site_zombaio_priceid="";

$sql="select activ,account,password,price from gateway_zombaio";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_zombaio_account=$rs->row["account"];
	$site_zombaio_password=$rs->row["password"];
	$site_zombaio_priceid=$rs->row["price"];
}


//Pagseguro gateway
$site_pagseguro_account="";
$site_pagseguro_password="";

$sql="select activ,account,password from gateway_pagseguro";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_pagseguro_account=$rs->row["account"];
	$site_pagseguro_password=$rs->row["password"];
}


//Robokassa gateway
$site_robokassa_account="";
$site_robokassa_password="";
$site_robokassa_password2="";

$sql="select activ,account,password,password2 from gateway_robokassa";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_robokassa_account=$rs->row["account"];
	$site_robokassa_password=$rs->row["password"];
	$site_robokassa_password2=$rs->row["password2"];
}


//RBK Money gateway
$site_rbkmoney_account="";
$site_rbkmoney_password="";

$sql="select activ,account,password from gateway_rbkmoney";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_rbkmoney_account=$rs->row["account"];
	$site_rbkmoney_password=$rs->row["password"];
}


//Epay.kkb.kz gateway
$site_epaykkbkz_account="";

$sql="select activ,account from gateway_epaykkbkz";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_epaykkbkz_account=$rs->row["account"];
}


//PayPrin gateway
$site_payprin_account="";
$site_payprin_password="";

$sql="select activ,account,password from gateway_payprin";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_payprin_account=$rs->row["account"];
	$site_payprin_password=$rs->row["password"];
}


//Dwolla gateway
$site_dwolla_account="";
$site_dwolla_apikey="";
$site_dwolla_apisecret="";
$site_dwolla_pin="";
$site_dwolla_test=0;

$sql="select activ,account,apikey,apisecret,test,pin from gateway_dwolla";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_dwolla_account=$rs->row["account"];
	$site_dwolla_apikey=$rs->row["apikey"];
	$site_dwolla_apisecret=$rs->row["apisecret"];
	$site_dwolla_test=$rs->row["test"];
	$site_dwolla_pin=$rs->row["pin"];
}


//Stripe gateway
$site_stripe_account="";
$site_stripe_password="";

$sql="select activ,account,password from gateway_stripe";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_stripe_account=$rs->row["account"];
	$site_stripe_password=$rs->row["password"];
}


//Money.ua gateway
$site_moneyua_account="";
$site_moneyua_password="";
$site_moneyua_test=1;
$site_moneyua_commission=0;

$sql="select activ,account,password,testmode,commission from gateway_moneyua";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_moneyua_account=$rs->row["account"];
	$site_moneyua_password=$rs->row["password"];
	$site_moneyua_test=$rs->row["testmode"];
	$site_moneyua_commission=$rs->row["commission"];
}


//Privatbank gateway
$site_privatbank_account="";
$site_privatbank_password="";

$sql="select activ,account,password from gateway_privatbank";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_privatbank_account=$rs->row["account"];
	$site_privatbank_password=$rs->row["password"];
}


//Paysera gateway
$site_paysera_account="";
$site_paysera_password="";

$sql="select activ,account,password from gateway_paysera";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_paysera_account=$rs->row["account"];
	$site_paysera_password=$rs->row["password"];
}


//Dotpay gateway
$site_dotpay_account="";
$site_dotpay_password="";

$sql="select activ,account,password from gateway_dotpay";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_dotpay_account=$rs->row["account"];
	$site_dotpay_password=$rs->row["password"];
}

//PayU gateway
$site_payu_account="";
$site_payu_password="";
$site_payu_password2="";
$site_payu_password3="";

$sql="select activ,account,password,password2,password3 from gateway_payu";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_payu_account=$rs->row["account"];
	$site_payu_password=$rs->row["password"];
	$site_payu_password2=$rs->row["password2"];
	$site_payu_password3=$rs->row["password3"];
}

//Paxum gateway
$site_paxum_account="";
$site_paxum_password="";

$sql="select activ,account,password from gateway_paxum";
$rs->open($sql);
if(!$rs->eof and $rs->row["activ"]==1)
{
	$site_paxum_account=$rs->row["account"];
	$site_paxum_password=$rs->row["password"];
}


$mcountry_code["Afghanistan"]="AF";
$mcountry_code["Albania"]="Al";
$mcountry_code["Algeria"]="DZ";
$mcountry_code["Andorra"]="AD";
$mcountry_code["Angola"]="AO";
$mcountry_code["Anguilla"]="AI";
$mcountry_code["Antarctica"]="AQ";
$mcountry_code["Antigua"]="AG";
$mcountry_code["Argentina"]="AR";
$mcountry_code["Armenia"]="AM";
$mcountry_code["Aruba"]="AW";
$mcountry_code["Australia"]="AU";
$mcountry_code["Austria"]="AT";
$mcountry_code["Azerbaijan"]="AZ";
$mcountry_code["Bahamas"]="BS";
$mcountry_code["Bahrain"]="BH";
$mcountry_code["Bangladesh"]="BD";
$mcountry_code["Barbados"]="BB";
$mcountry_code["Belarus"]="BY";
$mcountry_code["Belgium"]="BE";
$mcountry_code["Belize"]="BZ";
$mcountry_code["Benin"]="BJ";
$mcountry_code["Bermuda"]="BM";
$mcountry_code["Bhutan"]="BT";
$mcountry_code["Bolivia"]="BO";
$mcountry_code["Bosnia/Hercegovina"]="BA";
$mcountry_code["Botswana"]="BW";
$mcountry_code["Brazil"]="BR";
$mcountry_code["Brunei"]="BN";
$mcountry_code["Bulgaria"]="BG";
$mcountry_code["Burkina Faso"]="BF";
$mcountry_code["Burma"]="BU";
$mcountry_code["Burundi"]="BI";
$mcountry_code["Cambodia Dem."]="KH";
$mcountry_code["Cameroon"]="CM";
$mcountry_code["Canada"]="CA";
$mcountry_code["Cape Verde"]="CV";
$mcountry_code["Cayman Islands"]="KY";
$mcountry_code["Central African Republic"]="CF";
$mcountry_code["Chad"]="TD";
$mcountry_code["Chile"]="CL";
$mcountry_code["China"]="CN";
$mcountry_code["Cocos Islands"]="CC";
$mcountry_code["Colombia"]="CO";
$mcountry_code["Comoros"]="KM";
$mcountry_code["Congo"]="CG";
$mcountry_code["Cook Islands"]="CK";
$mcountry_code["Costa Rica"]="CR";
$mcountry_code["Cote D Ivoire"]="CI";
$mcountry_code["Croatia"]="HR";
$mcountry_code["Cuba"]="CU";
$mcountry_code["Cyprus"]="CY";
$mcountry_code["Czech Republic"]="CZ";
$mcountry_code["Denmark"]="DK";
$mcountry_code["Djibouti"]="DJ";
$mcountry_code["Dominica"]="DM";
$mcountry_code["Dominican Republic"]="DO";
$mcountry_code["Ecuador"]="EC";
$mcountry_code["Egypt"]="EG";
$mcountry_code["El Salvador"]="SV";
$mcountry_code["Equatorial Guinea"]="GQ";
$mcountry_code["Estonia"]="EE";
$mcountry_code["Ethiopia"]="ET";
$mcountry_code["Falkland Islands"]="FK";
$mcountry_code["Faroe Islands"]="FO";
$mcountry_code["Fiji"]="FJ";
$mcountry_code["Finland"]="FI";
$mcountry_code["France"]="FR";
$mcountry_code["French Guiana"]="GF";
$mcountry_code["French Polynesia"]="PF";
$mcountry_code["Gabon"]="GA";
$mcountry_code["Gambia"]="GM";
$mcountry_code["Georgia"]="GE";
$mcountry_code["Germany"]="DE";
$mcountry_code["Ghana"]="GH";
$mcountry_code["Gibraltar"]="GI";
$mcountry_code["Greece"]="GR";
$mcountry_code["Greenland"]="GL";
$mcountry_code["Grenada"]="GD";
$mcountry_code["Guadeloupe"]="GP";
$mcountry_code["Guam"]="GU";
$mcountry_code["Guatemala"]="GT";
$mcountry_code["Guinea"]="GN";
$mcountry_code["Guinea-Bissau"]="GW";
$mcountry_code["Guyana"]="GY";
$mcountry_code["Haiti"]="HT";
$mcountry_code["Honduras"]="HN";
$mcountry_code["Hong Kong"]="HK";
$mcountry_code["Hungary"]="HU";
$mcountry_code["Iceland"]="IS";
$mcountry_code["India"]="IN";
$mcountry_code["Indonesia"]="ID";
$mcountry_code["Iran"]="IR";
$mcountry_code["Iraq"]="IQ";
$mcountry_code["Ireland"]="IE";
$mcountry_code["Israel"]="IL";
$mcountry_code["Italy"]="IT";
$mcountry_code["Jamaica"]="JM";
$mcountry_code["Japan"]="JP";
$mcountry_code["Jordan"]="JO";
$mcountry_code["Kazakhstan"]="KZ";
$mcountry_code["Kenya"]="KE";
$mcountry_code["Kiribati"]="KI";
$mcountry_code["Korea, Democratic Peoples Repbulic"]="KP";
$mcountry_code["Korea, Rep. Of"]="KR";
$mcountry_code["Kuwait"]="KW";
$mcountry_code["Laos Peoples Democratic Republic"]="LA";
$mcountry_code["Latvia"]="LV";
$mcountry_code["Lebanon"]="LB";
$mcountry_code["Lesotho"]="LS";
$mcountry_code["Liberia"]="LR";
$mcountry_code["Libyan Arab Jamahiriya"]="LY";
$mcountry_code["Liechtenstein"]="LI";
$mcountry_code["Lithuania"]="LT";
$mcountry_code["Luxembourg"]="LU";
$mcountry_code["Macau"]="MO";
$mcountry_code["Madagascar"]="MG";
$mcountry_code["Malawi"]="MW";
$mcountry_code["Malaysia"]="MY";
$mcountry_code["Maldives"]="MV";
$mcountry_code["Mali"]="ML";
$mcountry_code["Malta"]="MT";
$mcountry_code["Marshall Islands"]="MH";
$mcountry_code["Martinique"]="MQ";
$mcountry_code["Mauritania"]="MR";
$mcountry_code["Mauritius"]="MU";
$mcountry_code["Mayotte"]="YT";
$mcountry_code["Mexico"]="MX";
$mcountry_code["Micronesia"]="FM";
$mcountry_code["Moldova"]="MD";
$mcountry_code["Monaco"]="MC";
$mcountry_code["Mongolia"]="MN";
$mcountry_code["Montserrat"]="MS";
$mcountry_code["Morocco"]="MA";
$mcountry_code["Mozambique"]="MZ";
$mcountry_code["Myanmar"]="MM";
$mcountry_code["Namibia"]="NA";
$mcountry_code["Nauru"]="NR";
$mcountry_code["Nepal"]="NP";
$mcountry_code["Neth. Antilles Nevis"]="AN";
$mcountry_code["Netherlands"]="NL";
$mcountry_code["New Caledonia"]="NC";
$mcountry_code["New Zealand"]="NZ";
$mcountry_code["Nicaragua"]="NI";
$mcountry_code["Niger"]="NE";
$mcountry_code["Nigeria"]="NG";
$mcountry_code["Niue"]="NU";
$mcountry_code["Norfolk Island"]="NF";
$mcountry_code["Northern Mariana"]="MP";
$mcountry_code["Norway"]="NO";
$mcountry_code["Oman"]="OM";
$mcountry_code["Pakistan"]="PK";
$mcountry_code["Palau"]="PW";
$mcountry_code["Panama"]="PA";
$mcountry_code["Papua New Guinea"]="PG";
$mcountry_code["Paraguay"]="PY";
$mcountry_code["Peru"]="PE";
$mcountry_code["Philippines"]="PH";
$mcountry_code["Poland"]="PL";
$mcountry_code["Portugal"]="PT";
$mcountry_code["Puerto Rico"]="PR";
$mcountry_code["Qatar"]="QA";
$mcountry_code["Romania"]="RO";
$mcountry_code["Russia"]="RU";
$mcountry_code["Rwanda"]="RW";
$mcountry_code["Samoa (American)"]="WS";
$mcountry_code["Samoa (Western)"]="WS";
$mcountry_code["San Marino"]="SM";
$mcountry_code["Sao Tome & Principe"]="ST";
$mcountry_code["Saudi Arabia"]="SA";
$mcountry_code["Senegal"]="SN";
$mcountry_code["Seychelles"]="SC";
$mcountry_code["Sierra Leone"]="SL";
$mcountry_code["Singapore"]="SG";
$mcountry_code["Slovakia"]="SK";
$mcountry_code["Slovenia"]="SI";
$mcountry_code["Solomon Islands"]="SB";
$mcountry_code["Somalia"]="SO";
$mcountry_code["South Africa"]="ZA";
$mcountry_code["Spain"]="ES";
$mcountry_code["Sri Lanka"]="LK";
$mcountry_code["St. Kitts & Nevis"]="";
$mcountry_code["St. Lucia"]="";
$mcountry_code["St. Pierre & Miquelon"]="";
$mcountry_code["St. Vincent & Grenadines"]="";
$mcountry_code["Sudan"]="SD";
$mcountry_code["Suriname"]="SR";
$mcountry_code["Swaziland"]="SZ";
$mcountry_code["Sweden"]="SE";
$mcountry_code["Switzerland"]="CH";
$mcountry_code["Syrian Arab Republic"]="SY";
$mcountry_code["Taiwan"]="TW";
$mcountry_code["Tajikistan"]="TJ";
$mcountry_code["Tanzania"]="TZ";
$mcountry_code["Thailand"]="TH";
$mcountry_code["Togo"]="TG";
$mcountry_code["Tonga"]="TO";
$mcountry_code["Trinidad & Tobago"]="TT";
$mcountry_code["Tunisia"]="TN";
$mcountry_code["Turkey"]="TR";
$mcountry_code["Turkmenistan"]="TM";
$mcountry_code["Turks & Caicos"]="TC";
$mcountry_code["Tuvalu"]="TV";
$mcountry_code["Uganda"]="UG";
$mcountry_code["Ukraine"]="UA";
$mcountry_code["United Arab Emirates"]="AE";
$mcountry_code["United Kingdom"]="UK";
$mcountry_code["United States"]="US";
$mcountry_code["Uruguay"]="UY";
$mcountry_code["Uzbekistan"]="UZ";
$mcountry_code["Vanuatu"]="VU";
$mcountry_code["Vatican City"]="VA";
$mcountry_code["Venezuela"]="VE";
$mcountry_code["Vietnam"]="VN";
$mcountry_code["Virgin Islands (Br.)"]="VG";
$mcountry_code["Virgin Islands (U.S.)"]="VI";
$mcountry_code["Wallis & Futuna"]="WF";
$mcountry_code["Yemen Republic"]="YE";
$mcountry_code["Yugoslavia"]="YU";
$mcountry_code["Zaire"]="ZR";
$mcountry_code["Zambia"]="ZM";
$mcountry_code["Zimbabwe"]="ZW";




?>