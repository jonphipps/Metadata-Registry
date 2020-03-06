<?php

namespace Tests\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;

/**
 * This trait allows you to test emails using Mailtrap <https://mailtrap.io>.
 * ## Config
 * * client_id: `string`, default `` - Your mailtrap API key.
 * * inbox_id: `string`, default `` - The inbox ID to use for the tests
 * * cleanup: `boolean`, default `true` - Clean the inbox after each scenario
 * ## API
 * * client - `GuzzleHttp\Client` Guzzle client for API requests
 */


trait InteractsWithMailTrap
{

  /**
   * @var \GuzzleHttp\Client
   */
    protected $client;

  /**
   * @var string
   */
    protected $mailtrapBaseUrl = 'https://mailtrap.io/api/v1/';

  /**
   * @var array
   */
    protected $config = [ 'client_id' => null, 'inbox_id' => null, 'cleanup' => true ];

  /**
   * @var array
   */
    protected $requiredFields = [ 'client_id', 'inbox_id' ];


  /**
   * Initialize.
   *
   * @return void
   */
    public function _initializeClient()
    {
        $this->config['client_id']=env('MAILTRAP_API_KEY');
        $this->config['inbox_id']=env('MAILTRAP_INBOX_ID');

        $this->client = new Client([
        'base_uri' => $this->mailtrapBaseUrl,
        'headers'  => [
            'Api-Token' => $this->config['client_id'],
        ],
        ]);
    }



  /**
   * Clean all the messages from inbox.
   *
   * @return void
   */
    public function cleanInbox()
    {
        $this->client->patch("inboxes/{$this->config['inbox_id']}/clean");
    }


  /**
   * Check if the latest email received contains $params.
   *
   * @param $params
   *
   * @return mixed
   */
    public function receivedAnEmail($params)
    {
        $message = $this->fetchLastMessage();

        foreach ($params as $param => $value) {
            $this->assertEquals($value, $message[$param]);
        }
    }


  /**
   * Get the most recent message of the default inbox.
   *
   * @return array
   */
    public function fetchLastMessage()
    {
        $messages = $this->client->get("inboxes/{$this->config['inbox_id']}/messages")
                             ->getBody();
        if ($messages instanceof Stream) {
            $messages = $messages->getContents();
        }

        $messages = json_decode($messages, true);

        return array_shift($messages);
    }


  /**
   * Gets the attachments on the last message.
   *
   * @return array
   */
    public function fetchAttachmentsOfLastMessage()
    {
        $email    = $this->fetchLastMessage();
        $response = $this->client->get("inboxes/{$this->config['inbox_id']}/messages/{$email['id']}/attachments")
                             ->getBody();

        return json_decode($response, true);
    }


  /**
   * Check if the latest email received is from $senderEmail.
   *
   * @param $senderEmail
   *
   * @return mixed
   */
    public function receivedAnEmailFromEmail($senderEmail)
    {
        $message = $this->fetchLastMessage();
        $this->assertEquals($senderEmail, $message['from_email']);
    }


  /**
   * Check if the latest email received is from $senderName.
   *
   * @param $senderName
   *
   * @return mixed
   */
    public function receivedAnEmailFromName($senderName)
    {
        $message = $this->fetchLastMessage();
        $this->assertEquals($senderName, $message['from_name']);
    }


  /**
   * Check if the latest email was received by $recipientEmail.
   *
   * @param $recipientEmail
   *
   * @return mixed
   */
    public function receivedAnEmailToEmail($recipientEmail)
    {
        $message = $this->fetchLastMessage();
        $this->assertEquals($recipientEmail, $message['to_email']);
    }


  /**
   * Check if the latest email was received by $recipientName.
   *
   * @param $recipientName
   *
   * @return mixed
   */
    public function receivedAnEmailToName($recipientName)
    {
        $message = $this->fetchLastMessage();
        $this->assertEquals($recipientName, $message['to_name']);
    }


  /**
   * Check if the latest email received has the $subject.
   *
   * @param $subject
   *
   * @return mixed
   */
    public function receivedAnEmailWithSubject($subject)
    {
        $message = $this->fetchLastMessage();
        $this->assertEquals($subject, $message['subject']);
    }


  /**
   * Check if the latest email received has the $textBody.
   *
   * @param $textBody
   *
   * @return mixed
   */
    public function receivedAnEmailWithTextBody($textBody)
    {
        $message = $this->fetchLastMessage();
        $mailBody = $this->client->get($message['txt_path'])->getBody()->getContents();
        $this->assertEquals($textBody, $mailBody);
    }


  /**
   * Check if the latest email received has the $htmlBody.
   *
   * @param $htmlBody
   *
   * @return mixed
   */
    public function receivedAnEmailWithHtmlBody($htmlBody)
    {
        $message = $this->fetchLastMessage();
        $mailBody = $this->client->get($message['html_path'])->getBody()->getContents();
        $this->assertEquals($htmlBody, $mailBody);
    }


  /**
   * Look for a string in the most recent email (Text).
   *
   * @param $expected
   *
   * @return mixed
   */
    public function seeInEmailTextBody($expected)
    {
        $email = $this->fetchLastMessage();
        $textBody = $this->client->get($email['txt_path'])->getBody()->getContents();
        $this->assertContains($expected, $textBody, 'Email body contains text');
    }


  /**
   * Look for a string in the most recent email (HTML).
   *
   * @param $expected
   *
   * @return mixed
   */
    public function seeInEmailHtmlBody($expected)
    {
        $email = $this->fetchLastMessage();
        $htmlBody = $this->client->get($email['html_path'])->getBody()->getContents();
        $this->assertContains($expected, $htmlBody, 'Email body contains HTML');
    }


  /**
   * Look for an attachment on the most recent email.
   *
   * @param $count
   */
    public function seeAttachments($count)
    {
        $attachments = $this->fetchAttachmentsOfLastMessage();

        $this->assertEquals($count, count($attachments));
    }


  /**
   * Look for an attachment on the most recent email.
   *
   * @param $bool
   */
    public function seeAnAttachment($bool)
    {
        $attachments = $this->fetchAttachmentsOfLastMessage();

        $this->assertEquals($bool, count($attachments) > 0);
    }
}
