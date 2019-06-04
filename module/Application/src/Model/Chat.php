<?php
namespace Application\Model;

class Chat
{
    public $id;
    public $from;
    public $to;
    public $message;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->from = !empty($data['from']) ? $data['from'] : null;
        $this->to  = !empty($data['to']) ? $data['to'] : null;
        $this->message  = !empty($data['message']) ? $data['message'] : null;
        $this->created_at = !empty($data['created_at'])?$data['created_at']: null;
    }
}
