<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
  protected function initialize()
  {
      $this->tag->prependTitle('INVO | ');
      // layouts/mainを読み込んでいる様子
      // $this->view->setTemplateAfter('main');
  }
}
