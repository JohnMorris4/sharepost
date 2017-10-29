<?php require APPROOT . '/views/inc/header.php'; ?> 
<?php flash('post_message'); ?>
<div class="container posts">
<div class="row mb-3">
    <div class="col-md-6">
    <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-paw "></i> Add Post
        </a>
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
</div>

    <div class="section">
        <div class="row">
            <div class="col-sm-12">
                
            </div>
        </div>
    </div>
    

<?php require APPROOT . '/views/inc/footer.php'; ?>
