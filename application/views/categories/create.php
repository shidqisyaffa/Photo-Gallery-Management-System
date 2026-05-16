<h2><?php echo $title; ?></h2>

<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<?php echo form_open('categories/create'); ?>
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('description'); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Category</button>
    <a href="<?php echo site_url('categories'); ?>" class="btn btn-secondary">Cancel</a>
</form>
