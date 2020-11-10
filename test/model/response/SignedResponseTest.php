<?php

namespace nl\rabobank\gict\payments_savings\omnikassa_sdk\model\response;

use nl\rabobank\gict\payments_savings\omnikassa_sdk\model\signing\InvalidSignatureException;
use nl\rabobank\gict\payments_savings\omnikassa_sdk\model\signing\SigningKey;
use nl\rabobank\gict\payments_savings\omnikassa_sdk\test\model\response\MerchantOrderResponseBuilder;
use nl\rabobank\gict\payments_savings\omnikassa_sdk\test\model\response\MerchantOrderStatusResponseBuilder;

class SignedResponseTest extends \PHPUnit_Framework_TestCase
{
    //ROFE-348 Hide the signature key when the trace is printed
    public function testThatInvalidSignatureDoesNotLogSignatureKey()
    {
        try {
            $json = MerchantOrderStatusResponseBuilder::newInstanceAsJson();
            new MerchantOrderStatusResponse($json, new SigningKey('invalid_signature'));
        } catch (InvalidSignatureException $invalidSignatureException) {
            $trace = $invalidSignatureException->getTraceAsString();
            $this->assertNotContains('invalid_signature', $trace);
        }
    }
}
