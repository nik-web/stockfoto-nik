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

namespace Image\Service;

use Image\ValueObject\Data;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;

/**
 * ImageShowManager
 * 
 * The image show manager service.
 *
 * @package Image
 * @subpackage Image\Service
 */
class ImageShowManager implements ImageShowManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getImagePathByFileName($fileName) 
    {
        
        $fileName = str_replace("/", "", $fileName);  // Remove slashes.
        $fileName = str_replace("\\", "", $fileName); // Remove back-slashes.
        
        return Data::IMAGE_UPLOAD_DIR . $fileName;                
    }
    
    /**
     * {@inheritDoc}
     */
    public function getImageFileContent($filePath) 
    {
        return file_get_contents($filePath);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getImageFileInfo($filePath) 
    {
        // Try to open file        
        if (!is_readable($filePath)) {            
            return false;
        }   
        // Get file size in bytes.
        $fileSize = filesize($filePath);
        // Get MIME type of the file.
        $finfo = finfo_open(FILEINFO_MIME);
        $mimeType = finfo_file($finfo, $filePath);
        if($mimeType === false) {
            $mimeType = 'application/octet-stream';
        }
        
        return [
            'size' => $fileSize,
            'type' => $mimeType 
        ];
    }
    
    /**
     * {@inheritDoc}
     */
    public function resizeSquareImage($filePath, $sideLength)
    {
        // Get original image dimensions.
        list($originalWidth, $originalHeight) = getimagesize($filePath);
        // Scale to the longer side
        if ($originalWidth >= $originalHeight) {
            $scaledWidth = $sideLength;
            $scaledHeight = $originalHeight * $sideLength / $originalWidth;
            $x = 0;
            $y = ($sideLength - $scaledHeight) / 2;
        } else {
            $scaledHeight = $sideLength;
            $scaledWidth = $originalWidth * $sideLength / $originalHeight;
            $x = ($sideLength - $scaledWidth) / 2;
            $y = 0;
        }
        // Get image info
        $fileInfo = $this->getImageFileInfo($filePath);
        // Scaled the image
        $scaledImage = imagecreatetruecolor($scaledWidth, $scaledHeight);
        // Create square background image, background color white
        $squareImage = imagecreatetruecolor($sideLength, $sideLength);
        $color = ImageColorAllocate ($squareImage, 255, 255, 255);
        imagefill($squareImage, 0, 0, $color);
        if (substr($fileInfo['type'], 0, 9) == 'image/png') {
            $originalImage = imagecreatefrompng($filePath);
            imagesavealpha($originalImage, true);
            // Prepare alpha channel for transparent background
            $alpha_channel = imagecolorallocatealpha($scaledImage, 255, 255, 255, 127);
            imagecolortransparent($scaledImage, $alpha_channel);
            // Fill image
            imagefill($scaledImage, 0, 0, $alpha_channel);
            imagecopyresampled($scaledImage, $originalImage, 0, 0, 0, 0, 
            $scaledWidth, $scaledHeight, $originalWidth, $originalHeight);
            // Save transparency
            imagesavealpha($scaledImage, true);
            // Copy scaled image to squared image
            imagecopy($squareImage, $scaledImage, $x, $y, 0, 0, imagesx($scaledImage), imagesy($scaledImage));
            // Save the resized image to temporary location
            $tmpFileName = tempnam("/tmp", "FOO");
            $quality = 9;
            // Output a PNG image to a file
            imagepng($squareImage, $tmpFileName, $quality);
        } else {
            $originalImage = imagecreatefromjpeg($filePath);
            imagecopyresampled($scaledImage, $originalImage, 0, 0, 0, 0, 
            $scaledWidth, $scaledHeight, $originalWidth, $originalHeight);
            // Copy scaled image to squared image
            imagecopy($squareImage, $scaledImage, $x, $y, 0, 0, imagesx($scaledImage), imagesy($scaledImage));
            // Save the square image to temporary location
            $tmpFileName = tempnam("/tmp", "FOO");
            // Output a JPG image to a file
            imagejpeg($squareImage, $tmpFileName, 80);
        }
        // Return the path to resulting image.
        return $tmpFileName;
    }

    /**
     * {@inheritDoc}
     */
    public  function resizeImage($filePath, $desiredWidth = 240) 
    {
        // Get original image dimensions.
        list($originalWidth, $originalHeight) = getimagesize($filePath);
        // Calculate aspect ratio
        $aspectRatio = $originalWidth/$originalHeight;
        // Calculate the resulting height
        $desiredHeight = $desiredWidth/$aspectRatio;
        // Get image info
        $fileInfo = $this->getImageFileInfo($filePath); 
        // Resize the image
        $scaledImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
        if (substr($fileInfo['type'], 0, 9) == 'image/png') {
            $originalImage = imagecreatefrompng($filePath);
            imagesavealpha($originalImage, true);
            // Prepare alpha channel for transparent background
            $alpha_channel = imagecolorallocatealpha($scaledImage, 255, 255, 255, 127);
            imagecolortransparent($scaledImage, $alpha_channel);
            // Fill image
            imagefill($scaledImage, 0, 0, $alpha_channel);
            imagecopyresampled($scaledImage, $originalImage, 0, 0, 0, 0, 
            $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);
            // Save transparency
            imagesavealpha($scaledImage, true);
            // Save the resized image to temporary location
            $tmpFileName = tempnam("/tmp", "FOO");
            $quality = 9;
            imagepng($scaledImage, $tmpFileName, $quality);
        } else {
            $originalImage = imagecreatefromjpeg($filePath);
            imagecopyresampled($scaledImage, $originalImage, 0, 0, 0, 0, 
            $desiredWidth, $desiredHeight, $originalWidth, $originalHeight);
            // Save the resized image to temporary location
            $tmpFileName = tempnam("/tmp", "FOO");
            imagejpeg($scaledImage, $tmpFileName, 80);
        }
        // Return the path to resulting image.
        return $tmpFileName;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getSavedFiles() 
    {
        if(!is_dir(Data::IMAGE_UPLOAD_DIR)) {
            if(!mkdir(Data::IMAGE_UPLOAD_DIR)) {
                throw new \Exception('Could not create directory for uploads: ' . 
                             error_get_last());
            }
        }
        $files = [];        
        $handle  = opendir(Data::IMAGE_UPLOAD_DIR);
        while (false !== ($entry = readdir($handle))) {
            if($entry=='.' || $entry=='..')
                continue; // Skip current dir and parent dir.
            $files[filemtime(Data::IMAGE_UPLOAD_DIR . $entry)] = $entry;
        }
        closedir($handle);
        krsort($files);
        // Return the list of uploaded files.
        return $files;
    }
    
    /**
     * {@inheritDoc}
     */
    public function paginateFiles($page)
    {
        $entities = $this->getSavedFiles();
        $itemContPerPage = 12;
        $pageRange = 7;
        $paginatorArrayAdapter = new ArrayAdapter($entities);
        $paginator = new Paginator($paginatorArrayAdapter);
        $paginator->setDefaultItemCountPerPage($itemContPerPage);
        $paginator->setPageRange($pageRange);
        $paginator->setCurrentPageNumber($page);
        
        return $paginator;  
    }
}