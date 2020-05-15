<?php
    include 'inc/ConstantsAndSettings.php';
    include 'inc/Header.php';
?>

<div class="container text-center mt-5">
    <br /><h2>Upload Pictures</h2><br />
    <p>Accepted picture types: JPG (JPEG), GIF, and PNG.</p>
    <p>You can upload multiple pictures at a time by pressing the shift key while selecting pictures.</p><br />
    <form action="UploadPicture.php" method="post" enctype="multipart/form-data">
        <h4>File to upload:</h4>        
        <div class="btn btn-success">
            <input type="file" name="txtUpload[]" multiple/>
        </div><br />
        <span class='error'><?php echo $error;?></span><br /><br />
        <input type="submit" name="btnUpload" value="Submit" class="btn btn-success"/>&nbsp;&nbsp;
        <input type="reset" name="btnReset" value="Clear" class="btn btn-success"/>
   </form> 
</div>
            
<?php include 'inc/Footer.php'; ?>
