<?php

namespace ApplicationTest\Controller\Authenticated;

use Application\Controller\Authenticated\DeleteController;

class TestableDeleteController extends DeleteController
{
    public function testCheckAuthenticated($allowRedirect = true)
    {
        return parent::checkAuthenticated($allowRedirect);
    }
}
