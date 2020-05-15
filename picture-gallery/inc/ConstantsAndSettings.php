<?php
    define(ORIGINAL_IMAGE_DESTINATION, "Pictures/OriginalPictures"); 
    define(IMAGE_DESTINATION, "Pictures/AlbumPictures"); 
    define(IMAGE_MAX_WIDTH, 1024);
    define(IMAGE_MAX_HEIGHT, 800);
    define(THUMB_DESTINATION, "Pictures/AlbumThumbnails");  
    define(THUMB_MAX_WIDTH, 100);
    define(THUMB_MAX_HEIGHT, 100);
    $supportedImageTypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    include "Functions.php";
    if (isset($_POST['btnUpload'])) 
    {
        $files = reArrayFiles($_FILES['txtUpload']);
        foreach($files as $file)
        {
           if ($file['error'] == 0)
           { 	
                $filePath = save_uploaded_file(ORIGINAL_IMAGE_DESTINATION, $file);
                $imageDetails = getimagesize($filePath);
                if ($imageDetails && in_array($imageDetails[2], $supportedImageTypes))
                {
                    resamplePicture($filePath, IMAGE_DESTINATION, IMAGE_MAX_WIDTH, IMAGE_MAX_HEIGHT);
                    resamplePicture($filePath, THUMB_DESTINATION, THUMB_MAX_WIDTH, THUMB_MAX_HEIGHT);
                }
                else
                {
                    $error = "Uploaded file is not a supported type."; 
                    unlink($filePath);
                }
            }
            elseif ($file['error'] == 1)
            {
                $error = "Upload file is too large."; 
            }
            elseif ($file['error'] == 4)
            {
                $error = "No upload file specified."; 
            }
            else
            {
                $error  = "Error happened while uploading the file."; 
            } 
        }
    }
