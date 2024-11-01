(function( $ ) {
	'use strict';

jQuery(document).ready(function($) {

	$('#selectall').on('click', function() {
		$('.selectedId').attr('checked', $(this).is(":checked"));
	});

    $(".edit_tr").click(function() {
        var ID = $(this).attr('id');
        $("#anchor_" + ID).hide();
        $("#url_" + ID).hide();
        $("#anchor_input_" + ID).show();
        $("#url_input_" + ID).show();

    }).change(function() {
        var ID = $(this).attr('id');
        var anchor = $("#anchor_input_" + ID).val();
        var url = $("#url_input_" + ID).val();
//       var dataString = 'id=' + ID + '&anchor=' + anchor + '&url=' + url;

		var dataString = {
			action: 'wpcl_action',
			id: ID,
			anchor: anchor,
			url: url      // We pass php values differently!
		};

        $("#anchor_" + ID).html('<img src="' + wpcl_img.loadingimg + '" />');
        $("#url_" + ID).html('<img src="' + wpcl_img.loadingimg + '" />');

        if (anchor.length && url.length > 0) {

			jQuery.post(ajax_object.ajax_url, dataString, function(html) {
					$("#anchor_" + ID).html(anchor);
                    $("#url_" + ID).html(url);
			});
        }
        else {
			$("#anchor_" + ID).html('?');
			$("#url_" + ID).html('?');
            alert('Please enter some value...');
        }

    });

    $(".editbox").mouseup(function() {
        return false
    });

    $(".urleditbox").mouseup(function() {
        return false
    });

    $(document).mouseup(function() {
        $(".editbox").hide();
        $(".text").show();
        $(".urleditbox").hide();
        $(".urltext").show();
    });

});

    
})( jQuery );


