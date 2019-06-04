<?php

namespace Application\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Sql\Select;

class ChatTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function fetchLatest($limit = 10)
    {
        $rowset = $this->tableGateway->select(function (Select $select) use ($limit) {
            $select->order('created_at DESC')->limit($limit);
        });
        return $rowset;
    }

    public function getChat($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveChat(Chat $chat)
    {
        $data = [
            'from' => $chat->from,
            'to'  => $chat->to,
            'message'  => $chat->message,
            'created_at'=> $chat->created_at
        ];

        $id = (int) $chat->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        try {
            $this->getChat($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteChat($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
