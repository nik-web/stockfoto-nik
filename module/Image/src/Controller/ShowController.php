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

use Image\Service\ImageShowManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * ShowController
 * 
 * @package Image
 * @subpackage Image\Controller
 */
class ShowController extends AbstractActionController
{
    /**
     * @var ImageShowManager
     */
    private $manager;
    
    /**
     * Constructor
     * 
     * The constructor method is used for injecting the dependencies 
     * into the controller.
     * 
     * @param ImageShowManagerInterface $manager
     */
    public function __construct(ImageShowManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Index action
     * 
     * This is the default "index" action of the controller. 
     * A list of all images on pages.
     * 
     * @return ViewModel
     */
    public function indexAction() 
    {
        $page = $this->params()->fromRoute('page');
        $paginator = $this->manager->paginateFiles($page);
        // Render the view template.
        return new ViewModel(['paginator' => $paginator,]);
    }
    
    /**
     * File Action
     * 
     * This is the 'file' action that is invoked when a user (moderator) wants to open 
     * the image file in a web browser or generate a thumbnail.
     * 
     * 
     */     
    public function fileAction() 
    {   
        // Get the file name from GET variable.
        $fileName = $this->params()->fromRoute('name', '');
        // Check whether the user needs a thumbnail or a full-size image.
        $isThumbnail = (bool)$this->params()->fromRoute('thumbnail', false);
        // Get path to image file.
        $filePath = $this->manager->getImagePathByFileName($fileName);
        if($isThumbnail) {
            // Resize the image.
            $filePath = $this->manager->resizeImage($filePath);
        }      
        // Get image file info (size and MIME type).
        $fileInfo = $this->manager->getImageFileInfo($filePath);
        if ($fileInfo === false) {
            // Set 404 Not Found status code
            $this->getResponse()->setStatusCode(404);            
            return;
        }   
        // Write HTTP headers.
        $response = $this->getResponse();
        $headers = $response->getHeaders();
        $headers->addHeaderLine("Content-type: " . $fileInfo['type']);        
        $headers->addHeaderLine("Content-length: " . $fileInfo['size']);   
        // Write file content.
        $fileContent = $this->manager->getImageFileContent($filePath);
        if($fileContent !== false) {                
            $response->setContent($fileContent);
        } else {        
            // Set 500 Server Error status code.
            $this->getResponse()->setStatusCode(500);
            return;
        }
        if($isThumbnail) {
            // Remove temporary thumbnail image file.
            unlink($filePath);
        }
        // Return Response to avoid default view rendering.
        return $this->getResponse();
    }
    
    /**
     * Public file Action
     * 
     * This is the 'file' action that is invoked when a user (guest) wants to open 
     * the image file in a web browser or generate a thumbnail.
     * 
     * 
     */     
    public function publicFileAction() 
    {   
        /*
        // Get the file name from GET variable.
        $fileName = $this->params()->fromRoute('name', '');
        
        if (!$this->postCheckManager->existsActiveWithImageFilename($fileName)) {
            // Set 404 Not Found status code
            $this->getResponse()->setStatusCode(404);            
            return;
        }

        // Check whether the user needs a thumbnail or a full-size image.
        $isThumbnail = (bool)$this->params()->fromRoute('thumbnail', false);
    
        // Get path to image file.
        $filePath = $this->imageManager->getImagePathByFileName($fileName);
        
        if($isThumbnail) {
            $sideLength = 240;
        } else {
            $sideLength = 540;
        }
        
        // Resize the image and get temporary location.
        $filePath = $this->imageManager->resizeSquareImage($filePath, $sideLength);
                
        // Get image file info (size and MIME type).
        $fileInfo = $this->imageManager->getImageFileInfo($filePath);
        
        if ($fileInfo === false) {
            // Set 404 Not Found status code
            $this->getResponse()->setStatusCode(404);            
            return;
        }
                
        // Write HTTP headers.
        $response = $this->getResponse();
        $headers = $response->getHeaders();
        $headers->addHeaderLine("Content-type: " . $fileInfo['type']);        
        $headers->addHeaderLine("Content-length: " . $fileInfo['size']);
            
        // Write file content.
        $fileContent = $this->imageManager->getImageFileContent($filePath);
        if($fileContent !== false) {                
            $response->setContent($fileContent);
        } else {        
            // Set 500 Server Error status code.
            $this->getResponse()->setStatusCode(500);
            return;
        }
        
        // Remove temporary thumbnail image file.
        unlink($filePath);
        
        // Return Response to avoid default view rendering.
        return $this->getResponse();
         * 
         */
    }
}
