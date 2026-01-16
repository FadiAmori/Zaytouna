<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editProductForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_nom" class="form-label">Name</label>
            <input type="text" class="form-control" id="edit_product_nom" name="nom" required>
          </div>
          <div class="mb-3">
            <label for="edit_description" class="form-label">Description</label>
            <textarea class="form-control" id="edit_product_description" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label for="edit_prix" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="edit_product_prix" name="prix" required>
          </div>
          <div class="mb-3">
            <label for="edit_image" class="form-label">Image</label>
            <input type="file" class="form-control" id="edit_product_image" name="image">
            <div id="currentProductImage" class="mt-2"></div>
          </div>
          <div class="mb-3">
            <label for="edit_category_id" class="form-label">Category</label>
            <select class="form-control" id="edit_product_category_id" name="category_id" required>
              <option value="">Select Category</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nom }}</option>
              @endforeach
            </select>
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
function openEditProductModal(product) {
    document.getElementById('edit_product_nom').value = product.nom;
    document.getElementById('edit_product_description').value = product.description || '';
    document.getElementById('edit_product_prix').value = product.prix;
    document.getElementById('edit_product_category_id').value = product.category_id;
    document.getElementById('editProductForm').action = '/products/' + product.id;
    if (product.image) {
        document.getElementById('currentProductImage').innerHTML = '<img src="/storage/' + product.image + '" width="50">';
    } else {
        document.getElementById('currentProductImage').innerHTML = '';
    }
    var modal = new bootstrap.Modal(document.getElementById('editProductModal'));
    modal.show();
}
</script>
