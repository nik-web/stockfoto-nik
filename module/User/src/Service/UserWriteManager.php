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
use User\Entity\User;
use User\Repository\UserInterface;
use User\Form\UserAddForm;
use User\Form\UserEditForm;
use User\Form\PasswordChangeForm;
use User\Form\PasswordResetForm;
use User\Form\PasswordSetForm;

/**
 * UserWriteManager
 *
 * @package User
 * @subpackage User\Service
 */
class UserWriteManager implements UserWriteManagerInterface
{
    /**
     * @var UserInterface
     */
    private $repository;

    /**
     * @var UserAddForm
     */
    private $addForm;
    
    /**
     * @var UserEditForm
     */
    private $editForm;
    
    /**
     *
     * @var PasswordChangeForm
     */
    private $passwordChangeForm;
    
    /**
     * @var PasswordResetForm
     */
    private $passwordResetForm;
    
    /**
     *
     * @var PasswordSetForm
     */
    private $passwordSetForm;

    /**
     * Constructs the service.
     * 
     * @param UserInterface $repository
     * @param UserAddForm $addForm
     * @param UserEditForm $editForm
     * @param PasswordChangeForm $passwordChangeForm
     * @param PasswordResetForm $passwordResetForm
     * @param PasswordSetForm $passwordSetForm
     */
    public function __construct(
        UserInterface $repository, UserAddForm $addForm, UserEditForm $editForm,
        PasswordChangeForm $passwordChangeForm, PasswordResetForm $passwordResetForm,
        PasswordSetForm $passwordSetForm
    ) {
        $this->repository = $repository;
        $this->addForm = $addForm;
        $this->editForm = $editForm;
        $this->passwordChangeForm = $passwordChangeForm;
        $this->passwordResetForm = $passwordResetForm;
        $this->passwordSetForm = $passwordSetForm;
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
    public function validatePassword(User $user, $password) 
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();
        if ($bcrypt->verify($password, $passwordHash)) {
            
            return true;
        }
        
        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getAddForm()
    {
        return $this->addForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addUser(UserAddForm $form)
    {
        // Get only filtered and validated data
        $data = $form->getData();
        $alias = $data['alias'];
        $email = $data['email'];
        $bcrypt = new Bcrypt();
        $password = $bcrypt->create($data['password']);
        $user = new User($alias, $email, $password, 1, date('Y-m-d H:i:s'), null, null, null);
        
        return $this->repository->insert($user);
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function getEditForm()
    {
        return $this->editForm;
    }
    
    /**
    * {@inheritDoc}
    */
    public function editUser(UserEditForm $form, User $user)
    {
        $data = $form->getData();
        $user->setStatus(intval($data['status']));
        $user->setUpdatedOn(date('Y-m-d H:i:s'));
        $this->repository->update($user);
        $id = intval($user->getId());
        $this->repository->deleteUserRoleConnectionsByUserId($id);
        $this->repository->insertUserRoleConnections($id, $data['roles']);
        
        return true;
    }
    
    /**
    * {@inheritDoc}
    */
    public function getPasswordChangeForm()
    {
        return $this->passwordChangeForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function changePassword(PasswordChangeForm $form, User $user)
    {
        $data = $form->getData();
        if ( $this->validatePassword($user, $data['current_password']) ) {       
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create($data['new_password']);
            $user->setPassword($passwordHash);
            $user->setUpdatedOn(date('Y-m-d H:i:s'));
            
            return $this->repository->update($user);
        }
           
        return false;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPasswordResetForm()
    {
        return $this->passwordResetForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function generatePwdResetToken(PasswordResetForm $form)
    {
        
        $cleanData = $form->getData();
        $user = $this->repository->findByEmail($cleanData['email']);
        if (!$user instanceof User) {
            return false;
        }
        // Generate and set the token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);      
        $user->setPwdResetToken($token);
        $user->setPwdResetTokenCreatedOn(date('Y-m-d H:i:s'));
        // udate to db
        $affectedRows = $this->repository->update($user);
        if ( 1 != $affectedRows ) {
            return false;
        }
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $locale = \Locale::getDefault();
        // create url
        $passwordSetUrl = $protocol . $httpHost . '/' . $locale . '/set-password/' . $token;
        
        //$subject = 'Passwort zurücksetzen';
        $body = 'Please follow the link below to reset your password:'
        . "\n"
        . $passwordSetUrl 
        . "\n"
        . 'If you have not asked to reset your password, please ignore this message.'
        . "\n";
        
        var_dump($passwordSetUrl);
        
        // Send email to user.
        //mail($user->getEmail(), $subject, $body);
        
        return true;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPasswordSetForm()
    {
        return $this->passwordSetForm;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setPassword(User $user, PasswordSetForm $form)
    {
        $data = $form->getData();
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['new_password']);
        $user->setPassword($passwordHash);
        $user->setUpdatedOn(date('Y-m-d H:i:s'));
        $user->setPwdResetToken(null);
        $user->setPwdResetTokenCreatedOn(null);
            
        return $this->repository->update($user);
    }
}