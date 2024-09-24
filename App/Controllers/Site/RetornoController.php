<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
// use App\Classes\PagseguroAdapter;
// use App\Classes\PagseguroStatusTransaction;
use App\Classes\Payment;
use App\Classes\PagseguroPayment;

class RetornoController extends BaseController {

    public function pagseguro(){

        // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['notificationType']) == 'transaction') {    ## DEScomentar para usar no Ambiente de Produção

            $emailPagseguro = 'xandecar@hotmail.com';
            $tokenPagseguro = 'FF579CC8863549A783664FDC85657678';
            // $notificationCode = '58A5E781880E880EED9BB4545FA6BC547BED';    ## COMENTAR esta linha para usar no Ambiente de Produção
            // $notificationCode = '7FB79107E1DAE1DAEC4334853FBD158B4C45';    ## COMENTAR esta linha para usar no Ambiente de Produção
            $notificationCode = 'C557769D144F144F3182244ABF8ACB2CABCE';    ## COMENTAR esta linha para usar no Ambiente de Produção

            // $url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/".$_POST['notificationCode']."?email={$emailPagseguro}&token={$tokenPagseguro}";    ## DEScomentar para usar no Ambiente de Produção
            $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/{$notificationCode}?email={$emailPagseguro}&token={$tokenPagseguro}";    ## COMENTAR esta linha para usar no Ambiente de Produção

            $curl = curl_init($url);

		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		    $transaction_curl = curl_exec($curl);

            curl_close($curl);

            $transaction = simplexml_load_string($transaction_curl);

            // $statusPagamento = new PagseguroAdapter(new PagseguroStatusTransaction($transaction));
            // $statusPagamento->gerenciaStatus($transaction->status);
            $statusPagamento = new Payment(new PagseguroPayment());
            $statusPagamento->paymentStatus($transaction);


        // }    ## DEScomentar para usar no Ambiente de Produção

    }

}
