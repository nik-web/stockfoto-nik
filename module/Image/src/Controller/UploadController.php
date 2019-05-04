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

use Image\Form\UploadForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * UploadController
 * 
 * @package Image
 * @subpackage Image\Controller
 */
class UploadController extends AbstractActionController
{
    /**
     * @var UploadForm 
     */
    private $uploadForm;
    
    /**
     * Constructor
     * 
     * The constructor method is used for injecting the dependencies 
     * into the controller.
     * 
     * @param UploadForm $uploadForm
     */
    public function __construct(UploadForm $uploadForm)
    {
        $this->uploadForm = $uploadForm;
    }
    
    /**
     * Index action
     * 
     * This is the default "index" action of the controller. 
     * It displays the upload form.
     * 
     * @return ViewModel
     */
    public function indexAction() 
    {
        $form = $this->uploadForm;
        // Check if user has submitted the form.
        if($this->getRequest()->isPost()) {
            // Make certain to merge the files info!
            $request = $this->getRequest();
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            // Pass data to form.
            $form->setData($data); 
            // Validate form.
            if($form->isValid()) {    
                // Move uploaded file to its destination directory.
                $data = $form->getData();
                // Redirect the user to "Image Gallery" page.
                $locale = $this->params()->fromRoute('locale');
                $message = 'image_upload_was_successful';
                $this->flashMessenger()->addSuccessMessage($message);
                
                return $this->redirect()
                    ->toRoute('image-show', ['locale' => $locale,]);
            }                        
        }
        
        return new ViewModel(['form' => $form,]);
    }
}