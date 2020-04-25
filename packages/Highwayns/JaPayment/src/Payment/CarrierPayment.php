<?php

namespace Highwayns\JaPayment\Payment;

use Illuminate\Support\Facades\Log;
use Webkul\Payment\Payment;

class CarrierPayment extends Payment
{
    /** マーチャントID */
    protected $sbp_merchat_id;
    /** サービスID */
    protected $sbp_service_id;
    /** ハッシュキー */
    protected $sbp_hashkey;
    /** デバッグ　OR　本番 */
    protected $is_sandbox;
    /** 税金 */
    protected $tax;
    /** 決済 */
    protected $billing_settlement_model;
    /** キャリア決済エラーメッセージ */
    protected $settlement_status_carrier_model;
    /**　請求 */
    protected $billing_model;
    /**　ユーザID */
    protected $user_id;
    /**　ユーザID */
    protected $user = '71607001';
    /**　ユーザID */
    protected $password = '1ea97fe3c8525fe97ceed5373c08e2d8992ea728';

	/**
	 * Endpoint テスト
	 */
	const PAYMENT_ENDPOINT_SANDBOX = 'https://stbfep.sps-system.com/api/xmlapi.do';
	
	/**
	 * Endpoint 本番
	 */
	const PAYMENT_ENDPOINT_PRODUCTION = 'https://api.sps-system.com/api/xmlapi.do';
	
	/**
	 * Returns Marchand ID
	 * @param boolean $deprecated No longer used.
	 * @return string
	 */
	public function marchant_id($deprecated = false){
		return $this->sbp_merchat_id;
	}
	
	/**
	 * Returns Service ID
	 * @param boolean $deprecated No longer used.
	 * @return string
	 */
	public function service_id($deprecated = false){
		return $this->sbp_service_id;
	}
	
	/**
	 * Returns Hash key
	 * @param boolean $deprecated No longer used.
	 * @return string
	 */
	public function hash_key($deprecated = false){
		return $this->sbp_hashkey;
	}
	
	/**
	 * Returns endpoint
	 * @return string
	 */
	public function get_endpoint($force = false){
		return ($this->is_sandbox && !$force)
			? self::PAYMENT_ENDPOINT_SANDBOX
			: self::PAYMENT_ENDPOINT_PRODUCTION;
	}	
	
    public function __construct($vendor, $db_name, $debug, $user_id)
    {

        $this->sbp_merchat_id = $vendor['sbp_merchat_id'] ?? '30132';
        $this->sbp_service_id = $vendor['sbp_service_id'] ?? '002';
        $this->sbp_hashkey = $vendor['sbp_hashkey'] ?? '8435dbd48f2249807ec216c3d5ecab714264cc4a';
        $this->user = $vendor['sbp_user'] ?? '30132002';
        $this->sbp_hashkey = $vendor['sbp_password'] ?? '8435dbd48f2249807ec216c3d5ecab714264cc4a';
        //$this->billing_settlement_model = new \App\billing_settlement_model($db_name);
        //$this->settlement_status_carrier_model = new \App\settlement_status_carrier_model($db_name);
        //$this->billing_model = new \App\billing_model($db_name);

        $this->is_sandbox = $debug;
        $this->user_id = $user_id;
        //$tax_model = new \App\tax_model();
        //$this->tax = $tax_model->tax();

    }

    public function createXml($dataType, $tracking_id, $cust_code, $order_id, $item_id, $item_name, 
    $tax, $amount, $free1, $free2, $free3, $order_rowno, $request_date, $limit_second)
    {
        // API送信データ
        $merchant_id              = $this->marchant_id();
        $service_id               = $this->service_id();
        $hashkey                  = $this->hash_key();

        // Shift_JIS変換
        $merchant_id              = mb_convert_encoding($merchant_id, 'Shift_JIS', 'UTF-8');
        $service_id               = mb_convert_encoding($service_id, 'Shift_JIS', 'UTF-8');
        $tracking_id              = mb_convert_encoding($tracking_id, 'Shift_JIS', 'UTF-8');
        $cust_code                = mb_convert_encoding($cust_code, 'Shift_JIS', 'UTF-8');
        $order_id                 = mb_convert_encoding($order_id, 'Shift_JIS', 'UTF-8');
        $item_id                  = mb_convert_encoding($item_id, 'Shift_JIS', 'UTF-8');
        $item_name                = mb_convert_encoding($item_name, 'Shift_JIS', 'UTF-8');
        $tax                      = mb_convert_encoding($tax, 'Shift_JIS', 'UTF-8');
        $amount                   = mb_convert_encoding($amount, 'Shift_JIS', 'UTF-8');
        $free1                    = mb_convert_encoding($free1, 'Shift_JIS', 'UTF-8');
        $free2                    = mb_convert_encoding($free2, 'Shift_JIS', 'UTF-8');
        $free3                    = mb_convert_encoding($free3, 'Shift_JIS', 'UTF-8');
        $order_rowno              = mb_convert_encoding($order_rowno, 'Shift_JIS', 'UTF-8');
        $request_date             = mb_convert_encoding($request_date, 'Shift_JIS', 'UTF-8');
        $limit_second             = mb_convert_encoding($limit_second, 'Shift_JIS', 'UTF-8');
        $hashkey                  = mb_convert_encoding($hashkey, 'Shift_JIS', 'UTF-8');

        // 送信情報データ連結
        $result =
            $merchant_id .
            $service_id .
            $tracking_id .
            $cust_code .
            $order_id .
            $item_id .
            $item_name .
            $tax .
            $amount .
            $free1 .
            $free2 .
            $free3 .
            $order_rowno .
            $request_date .
            $limit_second .
            $hashkey;

        // SHA1変換
        $sps_hashcode = sha1( $result );

        // POSTデータ生成
        $postdata =
            "<?xml version=\"1.0\" encoding=\"Shift_JIS\"?>" .
            "<sps-api-request id=\"". $dataType ."\">" .
                "<merchant_id>"                 . $merchant_id              . "</merchant_id>" .
                "<service_id>"                  . $service_id               . "</service_id>" .
                "<tracking_id>"                 . $tracking_id              . "</tracking_id>" .
                "<cust_code>"                   . $cust_code                . "</cust_code>" .
                "<order_id>"                    . $order_id                 . "</order_id>" .
                "<item_id>"                     . $item_id                  . "</item_id>" .
                "<item_name>"                   . base64_encode($item_name) . "</item_name>" .
                "<tax>"                         . $tax                      . "</tax>" .
                "<amount>"                      . $amount                   . "</amount>" .
                "<free1>"                       . base64_encode($free1)     . "</free1>" .
                "<free2>"                       . base64_encode($free2)     . "</free2>" .
                "<free3>"                       . base64_encode($free3)     . "</free3>" .
                "<order_rowno>"                 . $order_rowno              . "</order_rowno>" .
                "<request_date>"                . $request_date             . "</request_date>" .
                "<limit_second>"                . $limit_second             . "</limit_second>" .
                "<sps_hashcode>"                . $sps_hashcode             . "</sps_hashcode>" .
            "</sps-api-request>";

        return $postdata;
    }

    public function callService($postdata)
    {

        Log::info('$postdata='.  $postdata);
        // 接続URL
        $url = $this->get_endpoint();
        Log::info('$url='.  $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $this->user . ":" . $this->password); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));

        if (!$result = curl_exec($ch)) {
            echo json_encode(['result' => false, 'message' => curl_error($ch)]);exit;
        }

        curl_close($ch);
        Log::info('$result='.  $result);
        $xml = simplexml_load_string($result);
        $xml = json_encode($xml);
        $xml = json_decode( $xml,true ) ;
        Log::info($xml);
        return $xml;
    }

    public function DocomoData($items, $billingdetail)
    {
        $dataType = "ST01-00104-401";
        foreach ($items as $item) {            
            $invoice_id = sprintf("%014d", $item['billing_settlement_id']);
            $this->billing_settlement_model->updateRow(['billing_settlement_id' => $item['billing_settlement_id']], ['invoice_id' => $invoice_id]);
            foreach ($billingdetail as $detail) {
                if ($item['billing_id'] === $detail['billing_id']) {
                    $cust_code                = $item['billing_id'];
                    $order_id                 = $invoice_id;
                    $item_id                  = $detail["item_id"];
                    $item_name                = $detail["item_name"];
                    $tax                      = "0";
                    $amount                   = (int)$detail['price'];
                    $free1                    = "";
                    $free2                    = "";
                    $free3                    = "";
                    $order_rowno              = "";
                    $request_date             = date("YmdHis");
                    $limit_second             = "";
                    $tracking_id              = "00000625190313";
                    $data = $this->createXml($dataType, $tracking_id, $cust_code, $order_id, $item_id, $item_name, 
                    $tax, $amount, $free1, $free2, $free3, $order_rowno, $request_date, $limit_second);
                    $result = $this->callService($data);
                    if(!$result){
                        return ['result' => "NG", 'msg' => "ドコモ払い：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                    } else if($result['res_result'] === "NG"){
                        $res_err_code = $result['res_err_code'];
                        if (substr($res_err_code, 0, 3) === "401") {
                            $error = $this->settlement_status_carrier_model->getSettlementCondition($res_err_code, 8);
                            if (isset($error)) {
                                return ['result' => "NG", 'msg' => "ドコモ払い：継続課金（定期・従量）購入要求実行エラー発生しました。",
                                    'error1' => $error
                                ];
                            } else {
                                return ['result' => "NG", 'msg' => "ドコモ払い：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                            }
    
                        } else {
                            return ['result' => "NG", 'msg' => "ドコモ払い：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                        }
                        
                    }else{
                        $data = [
                            "result" => 1,
                            "error" => "",
                            "payment_confirmed_date" => date("Y-m-d H:i:s"),
                            "deposit_price" => $detail['price'],
                            "updated_user_id" => $this->user_id,
                        ];
        
                        if ($this->billing_settlement_model->updateRow(["billing_settlement_id" => $item['billing_settlement_id']], $data)) {
                            $billing_settlement = $this->billing_settlement_model->getRow(["billing_settlement_id" => $item['billing_settlement_id']]);
                            $this->billing_model->updateRowDepositPrice($billing_settlement->billing_id, $detail['price']);
                        }
        
                    }
    
                }
            }
            return ['result' => "OK", 'msg' => "ドコモ払い：継続課金（定期・従量）購入要求実行完了しました。"];
        }
    }
    public function AUData($items, $billingdetail)
    {
        $dataType = "ST01-00104-402";
        foreach ($items as $item) {            
            $invoice_id = sprintf("%014d", $item['billing_settlement_id']);
            $this->billing_settlement_model->updateRow(['billing_settlement_id' => $item['billing_settlement_id']], ['invoice_id' => $invoice_id]);
            foreach ($billingdetail as $detail) {
                if ($item['billing_id'] === $detail['billing_id']) {
                    $cust_code                = $item['billing_id'];
                    $order_id                 = $invoice_id;
                    $item_id                  = $detail["item_id"];
                    $item_name                = $detail["item_name"];
                    $tax                      = "0";
                    $amount                   = (int)$detail['price'];
                    $free1                    = "";
                    $free2                    = "";
                    $free3                    = "";
                    $order_rowno              = "";
                    $request_date             = date("YmdHis");
                    $limit_second             = "";
                    $tracking_id              = "00000625190313";
                    $data = $this->createXml($dataType, $tracking_id, $cust_code, $order_id, $item_id, $item_name, 
                    $tax, $amount, $free1, $free2, $free3, $order_rowno, $request_date, $limit_second);
                    $result = $this->callService($data);
                    if(!$result){
                        return ['result' => "NG", 'msg' => "au かんたん決済：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                    } else if($result['res_result'] === "NG"){
                        $res_err_code = $result['res_err_code'];
                        if(substr($res_err_code, 0, 3) === "402") {
                            $error = $this->settlement_status_carrier_model->getSettlementCondition($res_err_code, 9);
                            if (isset($error)) {
                                return ['result' => "NG", 'msg' => "au かんたん決済：継続課金（定期・従量）購入要求実行エラー発生しました。",
                                    'error1' => $error
                                ];
                            } else {
                                return ['result' => "NG", 'msg' => "au かんたん決済：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                            }

                        } else {
                            return ['result' => "NG", 'msg' => "au かんたん決済：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                        }
                    }else{
                        $data = [
                            "result" => 1,
                            "error" => "",
                            "payment_confirmed_date" => date("Y-m-d H:i:s"),
                            "deposit_price" => $detail['price'],
                            "updated_user_id" => $this->user_id,
                        ];
        
                        if ($this->billing_settlement_model->updateRow(["billing_settlement_id" => $item['billing_settlement_id']], $data)) {
                            $billing_settlement = $this->billing_settlement_model->getRow(["billing_settlement_id" => $item['billing_settlement_id']]);
                            $this->billing_model->updateRowDepositPrice($billing_settlement->billing_id, $detail['price']);
                        }
                        
                    }
                }
            }
            return ['result' => "OK", 'msg' => "au かんたん決済：継続課金（定期・従量）購入要求実行完了しました。"];
        }
    }
    public function SoftbankData($items, $billingdetail)
    {
        $dataType = "ST01-00104-405";
        foreach ($items as $item) {            
            $invoice_id = sprintf("%014d", $item['billing_settlement_id']);
            $this->billing_settlement_model->updateRow(['billing_settlement_id' => $item['billing_settlement_id']], ['invoice_id' => $invoice_id]);
            foreach ($billingdetail as $detail) {
                if ($item['billing_id'] === $detail['billing_id']) {
                    $cust_code                = $item['billing_id'];
                    $order_id                 = $invoice_id;
                    $item_id                  = $detail["item_id"];
                    $item_name                = $detail["item_name"];
                    $tax                      = "0";
                    $amount                   = (int)$detail['price'];
                    $free1                    = "";
                    $free2                    = "";
                    $free3                    = "";
                    $order_rowno              = "";
                    $request_date             = date("YmdHis");
                    $limit_second             = "";
                    $tracking_id              = "00000625190313";
                    $data = $this->createXml($dataType, $tracking_id, $cust_code, $order_id, $item_id, $item_name, 
                    $tax, $amount, $free1, $free2, $free3, $order_rowno, $request_date, $limit_second);
                    $result = $this->callService($data);
                    if(!$result){
                        return ['result' => "NG", 'msg' => "ソフトバンクまとめて支払い（B）：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                    } else if($result['res_result'] === "NG"){
                        $res_err_code = $result['res_err_code'];
                        if(substr($res_err_code, 0, 3) === "405") {
                            $error = $this->settlement_status_carrier_model->getSettlementCondition($res_err_code, 10);
                            if (isset($error)) {
                                return ['result' => "NG", 'msg' => "ソフトバンクまとめて支払い（B）：継続課金（定期・従量）購入要求実行エラー発生しました。",
                                    'error1' => $error
                                ];
                            } else {
                                return ['result' => "NG", 'msg' => "ソフトバンクまとめて支払い（B）：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                            }

                        } else {
                            return ['result' => "NG", 'msg' => "ソフトバンクまとめて支払い（B）：継続課金（定期・従量）購入要求実行エラー発生しました。"];
                        }
                    }else{
                        $data = [
                            "result" => 1,
                            "error" => "",
                            "payment_confirmed_date" => date("Y-m-d H:i:s"),
                            "deposit_price" => $detail['price'],
                            "updated_user_id" => $this->user_id,
                        ];
        
                        if ($this->billing_settlement_model->updateRow(["billing_settlement_id" => $item['billing_settlement_id']], $data)) {
                            $billing_settlement = $this->billing_settlement_model->getRow(["billing_settlement_id" => $item['billing_settlement_id']]);
                            $this->billing_model->updateRowDepositPrice($billing_settlement->billing_id, $detail['price']);
                        }
                        
                    }
                }
            }
            return ['result' => "OK", 'msg' => "ソフトバンクまとめて支払い（B）：継続課金（定期・従量）購入要求実行完了しました。"];
        }
    }

}
