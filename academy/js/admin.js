/**
 * File admin.js.
 *
 * Helps with uploading images.
 *
 */
jQuery(document).ready(function ($) {
	// The "Upload" button
$('.upload_image_button').click(function() {
    var send_attachment = wp.media.editor.send.attachment;
    var button = $(this);
    wp.media.editor.send.attachment = function(props, attachment) {
    	$(button).prev().prev().attr('src', attachment.url);
        $(button).prev().prev().prev().prev().val(attachment.url);
        wp.media.editor.send.attachment = send_attachment;
    }
    wp.media.editor.open(button);
    return false;
});

// The "Remove" button (remove the value from input type='hidden')
$('.remove_image_button').click(function() {
    var answer = confirm('Are you sure?');
    if (answer == true) {
        var src = $(this).prev().prev().prev().attr('data-src');
        $(this).prev().prev().prev().attr('src', src);
        $(this).prev().prev().prev().prev().prev().val(src);
    }
    return false;
});
});
