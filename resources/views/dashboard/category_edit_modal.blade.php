<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_nom" class="form-label">Name</label>
            <input type="text" class="form-control" id="edit_nom" name="nom" required>
          </div>
          <div class="mb-3">
            <label for="edit_description" class="form-label">Description</label>
            <textarea class="form-control" id="edit_description" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label for="edit_image" class="form-label">Image</label>
            <input type="file" class="form-control" id="edit_image" name="image">
            <div id="currentImage" class="mt-2"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function openEditCategoryModal(category) {
    document.getElementById('edit_nom').value = category.nom;
    document.getElementById('edit_description').value = category.description || '';
    document.getElementById('editCategoryForm').action = '/categories/' + category.id;
    if (category.image) {
        document.getElementById('currentImage').innerHTML = '<img src="/storage/' + category.image + '" width="50">';
    } else {
        document.getElementById('currentImage').innerHTML = '';
    }
    var modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
    modal.show();
}
</script>
