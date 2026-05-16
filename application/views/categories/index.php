<div class="row mb-3">
    <div class="col-md-6">
        <h2><?php echo $title; ?></h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?php echo site_url('categories/create'); ?>" class="btn btn-primary">Add New Category</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($categories)): foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['description']); ?></td>
                    <td>
                        <a href="<?php echo site_url('categories/edit/'.$category['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?php echo site_url('categories/delete/'.$category['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="4" class="text-center">No categories found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
