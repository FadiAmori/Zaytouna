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
