<div class="row mb-3">
    <div class="col-md-6">
        <h2><?php echo $title; ?></h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?php echo site_url('photos/create'); ?>" class="btn btn-primary">Upload New Photo</a>
    </div>
</div>

<div class="row">
    <?php if(!empty($photos)): foreach ($photos as $photo): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <?php if(!empty($photo['file_name']) && file_exists('./uploads/' . $photo['file_name'])): ?>
                <img src="<?php echo base_url('uploads/'.$photo['file_name']); ?>" class="card-img-top gallery-img" alt="<?php echo htmlspecialchars($photo['title']); ?>">
            <?php else: ?>
                <div class="card-img-top gallery-img bg-secondary d-flex align-items-center justify-content-center text-white">No Image Available</div>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($photo['title']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Category: <?php echo htmlspecialchars($photo['category_name']); ?></h6>
                <p class="card-text text-truncate"><?php echo htmlspecialchars($photo['description']); ?></p>
            </div>
            <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                <a href="<?php echo site_url('photos/edit/'.$photo['id']); ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                <a href="<?php echo site_url('photos/delete/'.$photo['id']); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this photo?');">Delete</a>
            </div>
        </div>
    </div>
    <?php endforeach; else: ?>
    <div class="col-12">
        <div class="alert alert-info text-center">No photos uploaded yet.</div>
    </div>
    <?php endif; ?>
</div>
