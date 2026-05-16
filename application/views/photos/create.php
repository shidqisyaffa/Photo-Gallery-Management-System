<h2><?php echo $title; ?></h2>

<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
<?php if(isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php echo form_open_multipart('photos/create'); ?>
    <div class="mb-3">
        <label for="title" class="form-label">Photo Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title'); ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            <option value="">Select a category</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo set_select('category_id', $cat['id']); ?>><?php echo htmlspecialchars($cat['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo set_value('description'); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="userfile" class="form-label">Upload Image (JPG, PNG, GIF - Max 2MB)</label>
        <input class="form-control" type="file" id="userfile" name="userfile" accept="image/*" required onchange="previewImage(event)">
    </div>
    
    <div class="mb-3">
        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-height: 200px; border-radius: 8px;" class="shadow-sm">
    </div>

    <button type="submit" class="btn btn-primary">Upload Photo</button>
    <a href="<?php echo site_url('photos'); ?>" class="btn btn-secondary">Cancel</a>
</form>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>
