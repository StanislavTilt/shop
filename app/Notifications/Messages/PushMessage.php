<?php

namespace App\Notifications\Messages;

class PushMessage
{
    /**
     * @var array
     */
    private $_recipient;

    /**
     * @var array
     */
    private $_content;

    /**
     * @var array
     */
    private $_data;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->_data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data): PushMessage
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getRecipient(): array
    {
        return $this->_recipient;
    }

    /**
     * @param array $recipient
     * @return $this
     */
    public function setRecipient(array $recipient): PushMessage
    {
        $this->_recipient = $recipient;
        return $this;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->_content;
    }

    /**
     * @param array $content
     * @return $this
     */
    public function setContent(array $content): PushMessage
    {
        $this->_content = $content;
        return $this;
    }
}
