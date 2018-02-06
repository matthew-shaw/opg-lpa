<?php

namespace Application\Model\Service\Lpa;

use Application\Model\Service\AbstractEmailService;
use Application\Model\Service\Mail\Transport\MailTransport;
use Opg\Lpa\DataModel\Lpa\Lpa;
use Opg\Lpa\Logger\LoggerTrait;
use Exception;
use Zend\Session\Container;

/**
 * A model service class for sending emails on LPA creation and completion.
 *
 * Class Communication
 * @package Application\Model\Service\Lpa
 */
class Communication extends AbstractEmailService
{
    use LoggerTrait;

    /**
     * @var Container
     */
    private $userDetailsSession;

    public function sendRegistrationCompleteEmail(Lpa $lpa)
    {
        $userSession = $this->userDetailsSession;

        // Add the signed in user's email address.
        $to = [
            $userSession->user->email->address,
        ];

        // If we have a separate payment address, send the email to that also.
        if (!empty($lpa->payment->email) && ((string)$lpa->payment->email != strtolower($userSession->user->email->address))) {
            $to[] = (string) $lpa->payment->email;
        }

        $data = [
            'lpa' => $lpa,
            'paymentAmount' => ($lpa->payment->amount > 0 ? money_format('%i', $lpa->payment->amount) : null),
            'isHealthAndWelfare' => ($lpa->document->type === \Opg\Lpa\DataModel\Lpa\Document\Document::LPA_TYPE_HW),
        ];

        try {
            $this->getMailTransport()->sendMessageFromTemplate($to, MailTransport::EMAIL_LPA_REGISTRATION, $data);
        } catch (Exception $e) {
            $this->getLogger()->alert("Failed sending LPA registration email to ".$userSession->user->email->address." due to:\n".$e->getMessage());

            return "failed-sending-email";
        }

        return true;
    }

    public function setUserDetailsSession(Container $userDetailsSession)
    {
        $this->userDetailsSession = $userDetailsSession;
    }
}
