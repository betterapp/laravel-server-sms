<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Messages extends AbstractCommon
{
    /**
     * Sending messages
     *
     * @param string|array $phone
     * @param string       $text   Message
     * @param ?string      $sender Sender name only for FULL SMS
     * @param array        $params
     *
     * @option bool "details" Show details of messages
     * @option bool "utf" Change encoding to UTF-8 (Only for FULL SMS)
     * @option bool "flash"
     * @option bool "speed" Priority canal only for FULL SMS
     * @option bool "test" Test mode
     * @option bool "vcard" vCard message
     * @option string "wap_push" WAP Push URL address
     * @option string "date" Set the date of sending
     * @option int|array "group_id" Sending to the group instead of a phone number
     * @option int|array "contact_id" Sending to phone from contacts
     * @option string|array "unique_id" Own identifiers of messages
     * @return AbstractResult
     * @option bool "success"
     * @option int "queued" Number of queued messages
     * @option int "unsent" Number of unsent messages
     * @option array "items"
     * @option string "id"
     * @option string "phone"
     * @option string "status" - queued|unsent
     * @option string "queued" Date of enqueued
     * @option int "parts" Number of parts a message
     * @option int "error_code"
     * @option string "error_message"
     * @option string "text"
     * @throws \Exception
     */
    public function sendSms(string|array $phone, string $text, ?string $sender = null, array $params = []): AbstractResult
    {
        $params = array_merge(['phone' => $phone, 'text' => $text], $params);
        
        $params = $this->setSender($sender, $params);
        
        return $this->master->call('messages/send_sms', $params);
    }
    
    /**
     * Sending personalized messages
     *
     * @param array   $messages
     *
     * @option string "phone"
     * @option string "text"
     *
     * @param ?string $sender Sender name only for FULL SMS
     * @param array   $params
     *
     * @option bool "details" Show details of messages
     * @option bool "utf" Change encoding to UTF-8 (only for FULL SMS)
     * @option bool "flash"
     * @option bool "speed" Priority canal only for FULL SMS
     * @option bool "test" Test mode
     * @option string "date" Set the date of sending
     * @option int|array "group_id" Sending to the group instead of a phone number
     * @option string "text" Message if is set group_id
     * @option string|array "uniqe_id" Own identifiers of messages
     * @option bool "voice" Send VMS
     * @return AbstractResult
     * @option bool "success"
     * @option int "queued" Number of queued messages
     * @option int "unsent" Number of unsent messages
     * @option array "items"
     * @option string "id"
     * @option string "phone"
     * @option string "status" - queued|unsent
     * @option string "queued" Date of enqueued
     * @option int "parts" Number of parts a message
     * @option int "error_code"
     * @option string "error_message"
     * @option string "text"
     * @throws \Exception
     */
    public function sendPersonalized(array $messages, ?string $sender = null, array $params = []): AbstractResult
    {
        $params = array_merge(['messages' => $messages, 'sender' => $sender], $params);
        
        $params = $this->setSender($sender, $params);
        
        return $this->master->call('messages/send_personalized', $params);
    }
    
    /**
     * Sending Voice message
     *
     * @param string|array $phone
     * @param array        $params
     *
     * @option string "text" If send of text to voice
     * @option string "file_id" ID from wav files
     * @option string "date" Set the date of sending
     * @option bool "test" Test mode
     * @option int|array "group_id" Sending to the group instead of a phone number
     * @option int|array "contact_id" Sending to phone from contacts
     * @return AbstractResult
     * @option bool "success"
     * @option int "queued" Number of queued messages
     * @option int "unsent" Number of unsent messages
     * @option array "items"
     * @option string "id"
     * @option string "phone"
     * @option string "status" - queued|unsent
     * @option string "queued" Date of enqueued
     * @option int "parts" Number of parts a message
     * @option int "error_code"
     * @option string "error_message"
     * @option string "text"
     * @throws \Exception
     */
    public function sendVoice(string|array $phone, array $params = []): AbstractResult
    {
        $params = array_merge(['phone' => $phone], $params);
        
        return $this->master->call('messages/send_voice', $params);
    }
    
    /**
     * Sending MMS
     *
     * @param string|array $phone
     * @param string       $title Title of message (max 40 chars)
     * @param array        $params
     *
     * @option string "file_id"
     * @option string|array "file" File in base64 encoding
     * @option string "date" Set the date of sending
     * @option bool "test" Test mode
     * @option int|array "group_id" Sending to the group instead of a phone number
     * @return AbstractResult
     * @option bool "success"
     * @option int "queued" Number of queued messages
     * @option int "unsent" Number of unsent messages
     * @option array "items"
     * @option string "id"
     * @option string "phone"
     * @option string "status" - queued|unsent
     * @option string "queued" Date of enqueued
     * @option int "parts" Number of parts a message
     * @option int "error_code"
     * @option string "error_message"
     * @option string "text"
     * @throws \Exception
     */
    public function sendMms(string|array $phone, string $title, array $params = []): AbstractResult
    {
        $params = array_merge(['phone' => $phone, 'title' => $title], $params);
        
        return $this->master->call('messages/send_mms', $params);
    }
    
    /**
     * View single message
     *
     * @param string $id
     * @param array  $params
     *
     * @option string "unique_id"
     * @option bool "show_contact" Show details of the recipient from the contacts
     * @return AbstractResult
     * @option string "id"
     * @option string "phone"
     * @option string "status"
     *          - delivered: The message is sent and delivered
     *          - undelivered: The message is sent but not delivered
     *          - sent: The message is sent and waiting for report
     *          - unsent: The message wasn't sent
     *          - in_progress: The message is queued for sending
     *          - saved: The message was saved in schedule
     * @option string "queued" Date of enqueued
     * @option string "sent" Date of sending
     * @option string "delivered" Date of deliver
     * @option string "sender"
     * @option string "type" - eco|full|mms|voice
     * @option string "text"
     * @option string "reason"
     *          - message_expired
     *          - unsupported_number
     *          - message_rejected
     *          - missed_call
     *          - wrong_number
     *          - limit_exhausted
     *          - lock_send
     *          - wrong_message
     *          - operator_error
     *          - wrong_sender_name
     *          - number_is_blacklisted
     *          - sending_to_foreign_networks_is_locked
     *          - no_permission_to_send_messages
     *          - other_error
     * @option array "contact"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @option string "phone"
     * @option string "email"
     * @option string "tax_id"
     * @option string "city"
     * @option string "address"
     * @option string "description"
     * @throws \Exception
     */
    public function view(string $id, array $params = []): AbstractResult
    {
        $params = array_merge(['id' => $id], $params);
        
        return $this->master->call('messages/view', $params);
    }
    
    /**
     * Checking messages reports
     *
     * @param array $params
     *
     * @option string|array "id" ID message
     * @option string|array "unique_id" ID message
     * @option string|array "phone"
     * @option string "date_from" The scope of the initial
     * @option string "date_to" The scope of the final
     * @option string "status" delivered|undelivered|pending|sent|unsent
     * @option string "type" eco|full|mms|voice
     * @option int "stat_id" Id package messages
     * @option bool "show_contact" Show details of the recipient from the contacts
     * @option int "page" The number of the displayed page
     * @option int "limit" Limit items are displayed on the single page
     * @option string "order" asc|desc
     * @return AbstractResult
     * @option array "paging"
     * @option int "page" The number of current page
     * @option int "count" The number of all pages
     * @option array items
     * @option string "id"
     * @option string "phone"
     * @option string "status"
     *              - delivered: The message is sent and delivered
     *              - undelivered: The message is sent but not delivered
     *              - sent: The message is sent and waiting for report
     *              - unsent: The message wasn't sent
     *              - in_progress: The message is queued for sending
     *              - saved: The message was saved in the scheduler
     * @option string "queued" Date of enqueued
     * @option string "sent" Date of sending
     * @option string "delivered" Date of deliver
     * @option string "sender"
     * @option string "type" - eco|full|mms|voice
     * @option string "text"
     * @option bool "flash"
     * @option bool "utf"
     * @option array "attachments"
     * @option int "id"
     * @option string "reason"
     *              - message_expired
     *              - unsupported_number
     *              - message_rejected
     *              - missed_call
     *              - wrong_number
     *              - limit_exhausted
     *              - lock_send
     *              - wrong_message
     *              - operator_error
     *              - wrong_sender_name
     *              - number_is_blacklisted
     *              - sending_to_foreign_networks_is_locked
     *              - no_permission_to_send_messages
     *              - other_error
     * @option array "contact"
     * @option int "id"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @option string "phone"
     * @option string "email"
     * @option string "tax_id"
     * @option string "city"
     * @option string "address"
     * @option string "description"
     * @throws \Exception
     */
    public function reports(array $params = []): AbstractResult
    {
        return $this->master->call('messages/reports', $params);
    }
    
    /**
     * Deleting message from the scheduler
     *
     * @param string|array  $id
     * @param ?string|array $uniqueId
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function delete(string|array $id, string|array $uniqueId = null): AbstractResult
    {
        $params = ['id' => $id, 'unique_id' => $uniqueId];
        
        return $this->master->call('messages/delete', $params);
    }
    
    /**
     * List of received messages
     *
     * @param string $type
     *      - eco SMS ECO replies
     *      - nd Incoming messages to ND number
     *      - ndi Incoming messages to ND number
     *      - mms Incoming MMS
     * @param array  $params
     *
     * @option string "ndi" Filtering by NDI
     * @option string|array "phone" Filtering by phone
     * @option string "date_from" The scope of the initial
     * @option string "date_to" The scope of the final
     * @option bool "read" Mark as read
     * @option int "page" The number of the displayed page
     * @option int "limit" Limit items are displayed on the single page
     * @option string "order" asc|desc
     * @return AbstractResult
     * @option array "paging"
     * @option int "page" The number of current page
     * @option int "count" The number of all pages
     * @option array "items"
     * @option int "id"
     * @option string "type" eco|nd|ndi|mms
     * @option string "phone"
     * @option string "recived" Date of received message
     * @option string "message_id" ID of outgoing message (only for ECO SMS)
     * @option bool "blacklist" Is the phone is blacklisted?
     * @option string "text" Message
     * @option string "to_number" Number of the recipient (for MMS)
     * @option string "title" Title of message (for MMS)
     * @option array "attachments" (for MMS)
     * @option int "id"
     * @option string "name"
     * @option string "content_type"
     * @option string "data" File
     * @option array "contact"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @option string "phone"
     * @option string "email"
     * @option string "tax_id"
     * @option string "city"
     * @option string "address"
     * @option string "description"
     * @throws \Exception
     */
    public function recived(string $type, array $params = []): AbstractResult
    {
        $params = array_merge(['type' => $type], $params);
        
        return $this->master->call('messages/recived', $params);
    }
    
    /**
     * Sending a message to an ND/SC
     *
     * @param string $phone Sender phone number
     * @param string $text  Message
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function sendNd(string $phone, string $text): AbstractResult
    {
        $params = ['phone' => $phone, 'text' => $text];
        
        return $this->master->call('messages/send_nd', $params);
    }
    
    /**
     * Sending a message to an NDI/SCI
     *
     * @param string $phone     Sender phone number
     * @param string $text      Message
     * @param string $ndiNumber Recipient phone number
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function sendNdi(string $phone, string $text, string $ndiNumber): AbstractResult
    {
        $params = ['phone' => $phone, 'text' => $text, 'ndi_number' => $ndiNumber];
        
        return $this->master->call('messages/send_ndi', $params);
    }
    
    /**
     * @param ?string $sender
     * @param array   $params
     *
     * @return array
     */
    private function setSender(?string $sender, array $params): array
    {
        $sender = is_null($sender) ? $this->master->sender : $sender;
        if (!empty($sender)) {
            $params['sender'] = $sender;
        }
        
        return $params;
    }
}