<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\ChatTable;
use Application\Model\Chat;

class IndexController extends AbstractActionController
{
    private $table;
    public function __construct(ChatTable $table)
    {
        $this->table = $table;
    }
    public function indexAction()
    {
        return new ViewModel(
            [
              'chats' => $this->table->fetchAll(),
            ]
        );
    }
    public function fetchAllAction()
    {
        $chats =  $this->table->fetchLatest();
        $data = [];
        foreach ($chats as $key => $value) {
            $data[] = $value;
        }
        return $this->jsonResponse($data);
    }
    public function storeAction()
    {
        $request = $this->getRequest();
        $params = $request->getPost();
        $dchat = [
          'from'=> $request->getPost('from'),
          'to'=> $request->getPost('to'),
          'message'=> $request->getPost('message'),
          'created_at' => date('Y-m-d h:i:s')
        ];
        $chat =  new Chat();
        $chat->exchangeArray($dchat);
        $this->table->saveChat($chat);
        $chats =  $this->table->fetchLatest();
        $data = [];
        foreach ($chats as $key => $value) {
            $data[] = $value;
        }
        return $this->jsonResponse($data);
    }
    private function jsonResponse($data)
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $response->setContent(json_encode($data));
        return $response;
    }
}
