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

/**
 * ImageShowManagerInterface
 * 
 * The image show manager interface.
 *
 * @package Image
 * @subpackage Image\Service
 */
interface ImageShowManagerInterface
{
    /**
     * Get image path by file name
     * 
     * Take some precautions to make file name secure.
     * 
     * @param string $fileName
     * @return string concatenated directory name and file name
     */
    public function getImagePathByFileName($fileName);
    
    /**
     * Get image file content
     * 
     * @param string $filePath
     * @return false | string the image file content
     */
    public function getImageFileContent($filePath);
    
    /**
     * Get image file info
     * 
     * Retrieves the file information (size, MIME type) by image path.
     * 
     * @param string $filePath
     * @return false | array
     */
    public function getImageFileInfo($filePath);
    
    /**
     * Resize image
     * 
     * Resizes a square image, on white background.
     * 
     * @param string $filePath
     * @param integer $sideLength
     * @return string path to resulting image
     */
    public function resizeSquareImage($filePath, $sideLength);

    /**
     * Resize image
     * 
     * Resizes the image, keeping its aspect ratio.
     * 
     * @param string $filePath
     * @param integer $desiredWidth
     * @return string path to resulting image
     */
    public  function resizeImage($filePath, $desiredWidth = 240);
    
    /**
     * Get saved files
     * 
     * Check whether the directory, where we plan to save uploaded files, 
     * already exists, and if not, create the directory.
     * Scan the directory and create the list of uploaded files as array.
     * 
     * @return array of uploaded file names
     * @throws \Exception
     */
    public function getSavedFiles();
    
    /**
     * Pagenate entities
     * 
     * @param integer $page curret page
     * @return \Zend\Paginator\Paginator
     */
    public function paginateFiles($page);   
}