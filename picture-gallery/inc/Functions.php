<?php
    function reArrayFiles(&$file_post) {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);
        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }
    function save_uploaded_file($destinationPath, $file)
    {
        if (!file_exists($destinationPath))
        {
                mkdir($destinationPath);
        }
        $tempFilePath = $file['tmp_name'];
        $filePath = $destinationPath."/".$file['name'];
        $pathInfo = pathinfo($filePath);
        $dir = $pathInfo['dirname'];
        $fileName = $pathInfo['filename'];
        $ext = $pathInfo['extension'];
        $i = "";
        while (file_exists($filePath))
        {	
            $i++;
            $filePath = $dir."/".$fileName."_".$i.".".$ext;
        }
        move_uploaded_file($tempFilePath, $filePath);
        return $filePath;
    }
    function resamplePicture($filePath, $destinationPath, $maxWidth, $maxHeight)
    {
        if (!file_exists($destinationPath))
        {
            mkdir($destinationPath);
        }
        $imageDetails = getimagesize($filePath);
        $originalResource = null;
        if ($imageDetails[2] == IMAGETYPE_JPEG) 
        {
            $originalResource = imagecreatefromjpeg($filePath);
        } 
        elseif ($imageDetails[2] == IMAGETYPE_PNG) 
        {
            $originalResource = imagecreatefrompng($filePath);
        } 
        elseif ($imageDetails[2] == IMAGETYPE_GIF) 
        {
            $originalResource = imagecreatefromgif($filePath);
        }
        $widthRatio = $imageDetails[0] / $maxWidth;
        $heightRatio = $imageDetails[1] / $maxHeight;
        $ratio = max($widthRatio, $heightRatio);
        $newWidth = $imageDetails[0] / $ratio;
        $newHeight = $imageDetails[1] / $ratio;
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        $success = imagecopyresampled($newImage, $originalResource, 0, 0, 0, 0, $newWidth, $newHeight, $imageDetails[0], $imageDetails[1]);
        if (!$success)
        {
            imagedestroy(newImage);
            imagedestroy(originalResource);
            return "";
        }
        $pathInfo = pathinfo($filePath);
        $newFilePath = $destinationPath."/".$pathInfo['filename'];
        if ($imageDetails[2] == IMAGETYPE_JPEG) 
        {
            $newFilePath .= ".jpg";
            $success = imagejpeg($newImage, $newFilePath, 100);
        } 
        elseif ($imageDetails[2] == IMAGETYPE_PNG) 
        {
            $newFilePath .= ".png";
            $success = imagepng($newImage, $newFilePath, 0);
        } 
        elseif ($imageDetails[2] == IMAGETYPE_GIF) 
        {
            $newFilePath .= ".gif";
            $success = imagegif($newImage, $newFilePath);
        }
        imagedestroy($newImage);
        imagedestroy($originalResource);
        if (!$success)
        {
            return "";
        }
        else
        {
            return newFilePath;
        }
    }
    function downloadFile($filePath)
    {
        $fileName = basename($filePath);
        $fileLength = filesize($filePath);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename = \"$fileName\" ");
        header("Content-Length: $fileLength" );
        header("Content-Description: File Transfer");
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma: private");
        ob_clean();
        flush();
        readfile($filePath);
        flush();
    }
