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

namespace Image\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Image\Service\ImageRemoveManagerInterface;
use Zend\View\Model\ViewModel;

/**
 * RemoveController
 * 
 * @package Image
 * @subpackage Image\Cotroller
 */
class RemoveController extends AbstractActionController
{
    /**
     * @var ImageRemoveManagerInterface 
     */
    private $manager;
    
    /**
     * Constructor
     * 
     * The constructor method is used for injecting the dependencies 
     * into the controller.
     * 
     * @param ImageRemoveManagerInterface
     */
    public function __construct(ImageRemoveManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    
    /**
     * Index action
     * 
     * This is the default "index" action of the controller. 
     * It displays the remove site of the image module.
     * 
     * @return ViewModel
     */
    public function indexAction() 
    {
        $request = $this->getRequest();
        $fileName = $this->params()->fromRoute('name');
        $locale = $this->params()->fromRoute('locale');
        $page = $this->params()->fromRoute('page');
        $form = $this->manager->getForm();
        // set hidden form element name
        $form->get('name')->setAttribute('value', $fileName);
        if ($request->isPost()) {
            if (array_key_exists('confirm', $request->getPost())) {
                $params = ['locale' => $locale,];
                // Unlink file and redirect to first page
                $output = $this->manager->removeImage($fileName);
                if ('file_unlink' == $output) {                    
                    $message = 'image_delete_was_successful';
                    $this->flashMessenger()->addSuccessMessage($message);
                } elseif ('file_not_unlink' == $output) {
                    $message = 'image_file_not_unlink';
                    $this->flashMessenger()->addErrorMessage($message);
                    $params = [
                        'locale' => $locale,
                        'page'   => $page,
                    ];
                } elseif ('file_not_exists' == $output) {
                    $message = 'image_file_not_exists';
                    $this->flashMessenger()->addErrorMessage($message);
                } 
            } else {
                $message = 'image_delete_was_cancel';
                $this->flashMessenger()->addSuccessMessage($message);
                $params = [
                    'locale' => $locale,
                    'page'   => $page,
                ];
            }
            
            return $this->redirect()->toRoute('image-show', $params);
        }
        
        return new ViewModel(['name' => $fileName, 'form' => $form,]);
    }
}
