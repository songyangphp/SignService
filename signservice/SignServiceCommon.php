<?php

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/2/25
 * Time: 上午11:26
 */
namespace wslibs\wscontract\signservice;


abstract class SignServiceCommon
{
    public abstract function initUser($signer);

    public abstract function createContractByPdf($contract);

    public abstract function createContractByTemplate($contract);
    public abstract function signContractAuto($contractSigner);
    public abstract function signContractH5($contractSigner);
    public abstract function getContractPdfBase64($c_no);
    public abstract function getContractImagesUrl($c_no);
    public abstract function getContractPdfUrl($c_no);
    public abstract function completionContract($c_no);
    public abstract function signatureChange($signer,$img_file);
    public function createContract($contract)
    {





        // TODO: Implement createContract() method.

        if ($contract->isCreatedByPdf()) {
           return  $this->createContractByPdf($contract);
        } else if ($contract->isCreatedByTemplate()) {
            return $this->createContractByTemplate($contract);
        }







    }

    public function signContract($contractSigner)
    {
        if($contractSigner->isAuto())
        {
            return  $this->signContractAuto($contractSigner);
        }else{
            return    $this->signContractH5($contractSigner);
        }
    }


}