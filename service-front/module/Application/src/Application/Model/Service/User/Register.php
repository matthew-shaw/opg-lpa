<?php

namespace Application\Model\Service\User;

use Application\Model\Service\AbstractEmailService;
use Application\Model\Service\ApiClient\Exception\ResponseException;
use Opg\Lpa\Logger\LoggerTrait;
use Exception;

class Register extends AbstractEmailService
{
    use LoggerTrait;

    /**
     * Register the user account and send the activate account email
     *
     * @param $email
     * @param $password
     * @return bool|mixed|string
     */
    public function registerAccount($email, $password)
    {
        $logger = $this->getLogger();
        $logger->info('Account registration attempt for ' . $email);

        $client = $this->getApiClient();
        $activationToken = $client->registerAccount(strtolower($email), $password);

        // A successful response is a string...
        if (!is_string($activationToken)) {
            if ($activationToken instanceof ResponseException) {
                if ($activationToken->getDetail() == 'username-already-exists') {
                    return "address-already-registered";
                }

                return $activationToken->getDetail();
            }

            return "unknown-error";
        }

        return $this->sendActivateEmail($email, $activationToken);
    }

    /**
     * Send the activate email to the user
     *
     * @param $email
     * @param $token
     * @param bool $fromResetRequest
     * @return bool|string
     */
    public function sendActivateEmail($email, $token, $fromResetRequest = false)
    {
        $categories = [
            'opg',
            'opg-lpa',
        ];

        //  Change the last category depending on where this request came from
        if ($fromResetRequest) {
            $categories[] = 'opg-lpa-passwordreset';
            $categories[] = 'opg-lpa-passwordreset-activate';
        } else {
            $categories[] = 'opg-lpa-signup';
        }

        $template = 'registration.twig';
        $subject = 'Activate your lasting power of attorney account';

        //  If this request came from the password reset tool then change some values
        if ($fromResetRequest) {
            $template = 'password-reset-not-active.twig';
            $subject = 'Password reset request';
        }

        $data = [
            'token' => $token,
        ];

        $logger = $this->getLogger();

        try {
            $logger->info('Sending account activation email to ' . $email);

            $this->getMailTransport()->sendMessageFromTemplate($email, $categories, $subject, $template, $data);
        } catch (Exception $e) {
            $logger->err('Failed to send account activation email to ' . $email);

            return "failed-sending-email";
        }

        return true;
    }

    /**
     * Resend the activate email to an inactive user
     *
     * @param $email
     * @return bool|string
     */
    public function resendActivateEmail($email)
    {
        //  Trigger a request to reset the password in the API - this will return the activation token
        $client = $this->getApiClient();
        $resetToken = $client->requestPasswordReset(strtolower($email));

        if ($resetToken instanceof ResponseException && $resetToken->getMessage() == 'account-not-activated') {
            $body = json_decode($resetToken->getResponse()->getBody(), true);

            if (isset($body['activation_token'])) {
                // If they have not yet activated their account, we re-send them the activation link.
                return $this->sendActivateEmail($email, $body['activation_token']);
            }
        }

        return false;
    }

    /**
     * Activate an account. i.e. confirm the email address.
     *
     * @param $token
     * @return bool
     */
    public function activateAccount($token)
    {
        //  This returns:
        //  TRUE - If the user account exists. The account has been activated.
        //  ResponseException - If the user account does not exist, or was already activated.
        $client = $this->getApiClient();
        $result = $client->activateAccount($token);

        $logger = $this->getLogger();

        if ($result === true) {
            $logger->info('Account activation attempt with token was successful');
        } else {
            $logger->info('Account activation attempt with token failed, or was already activated');
        }

        return ($result === true);
    }
}
