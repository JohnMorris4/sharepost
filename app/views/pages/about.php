<?php require APPROOT . '/views/inc/header.php'; ?> 

<div class="container about">
    <div class="row">
        <div class="col-md-12">
        <h1><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?> </p>
        <p>Version: <strong><?php echo APPVERSION; ?></strong></p>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
