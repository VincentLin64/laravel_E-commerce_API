import '../app.js';
import '../bootstrap.js';


const uploadImageModal = new bootstrap.Modal(document.getElementById('upload-image'));
const importExcelModal = new bootstrap.Modal(document.getElementById('import'));
$('.upload_image').click(function () {
    $('#product_id').val($(this).data('id'));
    uploadImageModal.show();
});
$('.import').click(function () {
    importExcelModal.show();
});
