<?php
/**
 * stockfoto-nik cms
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace User\Service;

use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use User\Repository\RegistrationInterface;
use User\Form\RegistrationForm;
use User\Form\PasswordSetForm;
use User\Entity\Registration;
use User\Entity\User;
use User\Repository\UserInterface;

/**
 * RegistrationManager
 *
 * @package User
 * @subpackage User\Service
 */
class RegistrationManager implements RegistrationManagerInterface
{
    /**
     * @var RegistrationInterface 
     */
    private $repository;
    
    /**
     * @var RegistrationForm
     */
    private $registrationForm;
    
    /**
     *
     * @var PasswordSetForm
     */
    private $passwordSetForm;
    
    /**
     * @var UserInterface
     */
    private $userRepository;


    /**
     * Constructor.
     * 
     * @param RegistrationInterface $repository
     * @param RegistrationForm $registrationForm
     * @param PasswordSetForm $passwordSetForm
     * @param UserInterface $userRepository
     */
    public function __construct(
            RegistrationInterface $repository,
            RegistrationForm $registrationForm,
            PasswordSetForm $passwordSetForm,
            UserInterface $userRepository
    ) {
        $this->repository = $repository;
        $this->registrationForm = $registrationForm;
        $this->passwordSetForm = $passwordSetForm;
        $this->userRepository = $userRepository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * {@inheritDoc}
     */
    public function getRegistrationForm()
    {
        return $this->registrationForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPasswordSetFortm()
    {
        return $this->passwordSetForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addRegistation(RegistrationForm $form)
    {
        $data = $form->getData();
        $date = date('Y-m-d H:i:s');
        // Generate and set the token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
        $registration = new Registration($data['alias'], $data['email'], $date, $token);
    
        if (! $this->repository->insert($registration)) {
            return false;
        }
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $locale = \Locale::getDefault();
        // create url
        $confirmRegistrationUrl = $protocol . $httpHost . '/' . $locale
            . '/confirm-registration/' . $token;
        //$subject = 'Registrierug bestätigen';
        $body = 'Please follow the link below to confirm your registration:'
        . "\n"
        . $confirmRegistrationUrl 
        . "\n"
        . 'If you did not want to register, please disregard this message.'
        . "\n";
        
        var_dump($confirmRegistrationUrl);
        die();
        
        // Send email to user.
        //mail($user->getEmail(), $subject, $body);
        
        return true;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function confirmRegistration(Registration $registration, PasswordSetForm $form)
    {
        $data = $form->getData();
        $bcrypt = new Bcrypt();
        $alias = $registration->getAlias();
        $email = $registration->getEmail();
        $password = $bcrypt->create($data['new_password']);
        
        $user = new User($alias, $email, $password, 1, date('Y-m-d H:i:s'), null, null, null);
        
        return $this->userRepository->insert($user);
    }
}