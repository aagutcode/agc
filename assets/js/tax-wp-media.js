jQuery(document).ready(function($) {
    // Abre la biblioteca de medios al hacer clic en "Cargar Imagen"
    $('#cargar-imagen').click(function(e) {
        e.preventDefault();
        var imagenUploader = wp.media({
            title: 'Seleccionar Imagen',
            button: {
                text: 'Seleccionar'
            },
            multiple: false
        });
        imagenUploader.on('select', function() {
            var attachment = imagenUploader.state().get('selection').first().toJSON();
            $('#image_id').val(attachment.id);
            $('#imagen-preview').html('<img src="' + attachment.url + '" alt="Imagen seleccionada" style="max-width: 100px;" />');
        });
        imagenUploader.open();
    });

    // Borra la imagen al hacer clic en "Quitar Imagen"
    $('#quitar-imagen').click(function() {
        $('#image_id').val('');
        $('#imagen-preview').html('');
    });
});
