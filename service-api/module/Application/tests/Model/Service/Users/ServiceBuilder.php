<?php

namespace ApplicationTest\Model\Service\Users;

use Application\Model\Service\Users\Service;
use ApplicationTest\AbstractServiceBuilder;

class ServiceBuilder extends AbstractServiceBuilder
{
    private $userCollection = null;

    private $userDal;

    private $userManagementService;

    /**
     * @return Service
     */
    public function build()
    {
        /** @var Service $service */
        $service = parent::buildMocks(Service::class, true, $this->userCollection);

        if ($this->applicationsService !== null) {
            $service->setApplicationsService($this->applicationsService);
        }

        if ($this->userDal !== null) {
            $service->setUserDal($this->userDal);
        }

        if ($this->userManagementService !== null) {
            $service->setUserManagementService($this->userManagementService);
        }

        return $service;
    }

    /**
     * @param $userCollection
     * @return $this
     */
    public function withUserCollection($userCollection)
    {
        $this->userCollection = $userCollection;
        return $this;
    }

    public function withUserDal($userDal)
    {
        $this->userDal = $userDal;
        return $this;
    }

    public function withUserManagementService($userManagementService)
    {
        $this->userManagementService = $userManagementService;
        return $this;
    }
}
