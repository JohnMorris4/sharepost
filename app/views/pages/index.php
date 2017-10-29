<?php require APPROOT . '/views/inc/header.php'; ?> 
    
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-3" ><?php echo $data['title_2']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
            <br>
            <hr>
            <br>
            <a class="btn btn-danger btn-lg" href="mailto:johnmorris@morrisje.com"> >>> More Info <<< </a> 
        </div>  
    </div>
    <?php foreach($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            Written by: <?php echo $post->name; ?> <br>
            Date: <?php echo $post->postCreated; ?> 
        </div>
        <p class="card-text">
        <?php echo $post->body; ?> <br>
        </p>
        <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">Read More</a>
    </div>
<?php endforeach; ?>
    <div class="section">
        <div class="row">
            <div class="col-sm-12">
                
            </div>
        </div>
    </div>
    
<?php require APPROOT . '/views/inc/footer.php'; ?>
