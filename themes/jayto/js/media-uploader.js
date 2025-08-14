jQuery(document).ready(function($){

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('#upload_image_btn').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            $('#txt_upload_image').val(media_attachment.url);

        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

});
function remove_img(value) {
    var parent = jQuery(value).parent().parent();
    parent.remove();
}

var media_uploader = null;

function open_media_uploader_image(obj) {

    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: false
    });
    media_uploader.on("insert", function () {
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        var html = '<img class="gallery_img_img" src="' + image_url + '" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
        // console.log(image_url);
        jQuery(obj).append(html);
        jQuery(obj).find('.meta_image_url').val(image_url);
    });
    media_uploader.open();
}

function open_media_uploader_image_this(obj) {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: false
    });
    media_uploader.on("insert", function () {
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        console.log(image_url);
        jQuery(obj).attr('src', image_url);
        jQuery(obj).siblings('.meta_image_url').val(image_url);
    });
    media_uploader.open();
}

function open_media_uploader_image_plus() {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: true
    });
    media_uploader.on("insert", function () {

        var length = media_uploader.state().get("selection").length;
        var images = media_uploader.state().get("selection").models

        for (var i = 0; i < length; i++) {
            var image_url = images[i].changed.url;
            var box = jQuery('#master_box').html();
            jQuery(box).appendTo('#img_box_container');
            var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
            var html = '<img class="gallery_img_img" src="' + image_url + '" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
            element.append(html);
            element.find('.meta_image_url').val(image_url);
            console.log(image_url);
        }
    });
    media_uploader.open();
}
jQuery(document).ready(function($){

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('#upload_ico_btn').click(function(e){

        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            $('#txt_upload_ico').val(media_attachment.url);

        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

});
function remove_img(value) {
    var parent = jQuery(value).parent().parent();
    parent.remove();
}

var media_uploader = null;

function open_media_uploader_image(obj) {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: false
    });
    media_uploader.on("insert", function () {
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        var html = '<img class="gallery_img_img" src="' + image_url + '" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
        // console.log(image_url);
        jQuery(obj).append(html);
        jQuery(obj).find('.meta_image_url').val(image_url);
    });
    media_uploader.open();
}

function open_media_uploader_image_this(obj) {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: false
    });
    media_uploader.on("insert", function () {
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        console.log(image_url);
        jQuery(obj).attr('src', image_url);
        jQuery(obj).siblings('.meta_image_url').val(image_url);
    });
    media_uploader.open();
}

function open_media_uploader_image_plus() {
    media_uploader = wp.media({
        frame: "post",
        state: "insert",
        multiple: true
    });
    media_uploader.on("insert", function () {

        var length = media_uploader.state().get("selection").length;
        var images = media_uploader.state().get("selection").models

        for (var i = 0; i < length; i++) {
            var image_url = images[i].changed.url;
            var box = jQuery('#master_box').html();
            jQuery(box).appendTo('#img_box_container');
            var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
            var html = '<img class="gallery_img_img" src="' + image_url + '" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
            element.append(html);
            element.find('.meta_image_url').val(image_url);
            console.log(image_url);
        }
    });
    media_uploader.open();
}

jQuery(function () {
    jQuery("#img_box_container").sortable();
});
jQuery(function () {
    jQuery("#img_box_container").sortable();
});