<?php 
    include 'inc/Header.php';
    require_once 'inc/Functions.php';
    $files = glob("Pictures/AlbumPictures/*.*");
    $originalImages = glob("Pictures/OriginalPictures/*.*");       
?>

<div class="container">
    <?php foreach($originalImages as $alImage): ?>
        <div class="mySlides text-center mt-5">
            <br /><br /><img class="img-fluid" src="<?php echo $alImage."?rnd=".rand(); ?>"><br /><br />
        </div>
    <?php endforeach; ?>
    <div class="text-center">
        <form action="MyPictures.php" method="get">
            <input type="hidden" name="curentPictureIndex" id="curentPictureIndex" value="<?php echo (isset($curentPictureIndex) ? $curentPictureIndex : '');?>"/>
            <input type="hidden" name="picture-name" value="" id="picture-name"/>
        </form>
    </div>
    <div class="text-center row">
        <?php
            $i = 1;
            foreach($files as $image):
        ?>
        <div class="column">
            <img class="demo cursor" src="<?php echo $image; ?>" style="width:90%" data-index="<?php echo $i; ?>" height="100px"><br /><br />
        </div>  
        <?php
            $i++;
            endforeach;
        ?>
    </div> 
</div>

<?php include 'inc/Footer.php'; ?>
