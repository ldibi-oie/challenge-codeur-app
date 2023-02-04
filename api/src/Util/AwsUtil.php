<?php
 
namespace App\Util;
 
use Aws\Sdk;
use Aws\Ses\Exception\SesException;
use Psr\Log\LoggerInterface;
 
class AwsUtil
{
   private const CHARSET = 'UTF-8';
 
   private $logger;
   private $sdk;
 
   public function __construct(
       LoggerInterface $logger,
       Sdk $sdk
   ) {
       $this->logger = $logger;
       $this->sdk = $sdk;
   }
 
   public function sendEmail(
        string $toAddresses,
       string $fromAddress,
       string $subject,
       string $body
   ): ?string {
       $messageId = null;
 
       try {
           $result = $this->sdk->createSes()->sendEmail([
               'Destination' => [
                   'ToAddresses' => $toAddresses,
               ],
               'Source' => $fromAddress,
               'Message' => [
                   'Subject' => [
                       'Charset' => self::CHARSET,
                       'Data' => $subject,
                   ],
                   'Body' => [
                       'Text' => [
                           'Charset' => self::CHARSET,
                           'Data' => $body,
                       ],
                   ],
               ],
           ]);
 
           $messageId = $result->get('MessageId');
       } catch (SesException $e) {
           $this->logger->error(sprintf('Email not sent. [%s]', $e->getAwsErrorMessage()));
       }
 
       return $messageId;
   }
}