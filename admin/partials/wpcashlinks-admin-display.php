<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 * @package    wpcashlinks
 * @subpackage wpcashlinks/admin
 * @author     WPCashLinks <info@wpcashlinks.com>
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
<h2></h2>
<div id="poststuff" class="metabox-holder">
    <h1>WPCashLinks</h1>
</div>
<?php
if ( isset( $_REQUEST['wpcl_addkeyword'] ) && $_REQUEST['wpcl_addkeyword'] == 'add_keyword' ) {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . "wpcl_keywords";
        
    $anchor = sanitize_text_field($_POST['txtKeyword']);
    $url = esc_url($_POST['txtUrl']);

    if( check_admin_referer('add_keyword_link') && current_user_can('administrator') ) {
        $wpdb->insert(
            $table_name, 
            array( 
                'anchor' => $anchor,
                'url' => $url
            ),
            array( 
                '%s', 
                '%s' 
            ) 
        );
    }
    
	echo '<div class="updated"><p><strong>New keyword added successfully.</strong></p></div>';
}
if ( isset( $_REQUEST['wpcl_deletekeyword'] ) && $_REQUEST['wpcl_deletekeyword'] == 'delete_keyword' ) {

    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . "wpcl_keywords";

    if( isset($_POST['checkbox']) && check_admin_referer('delete_keyword_link') && current_user_can('administrator') ) {
        foreach( $_POST['checkbox'] as $value ) {
            $wpdb->delete( 
                $table_name, 
                array( 
                    'id' => $value
                ),
                array( 
                    '%d'
                ) 
            );
        }
        echo '<div class="updated"><p><strong>Keyword revmoed successfully.</strong></p></div>';
    }
    else {
        echo '<div class="updated"><p><strong>No Keyword selected!</strong></p></div>';
    }
}


?>
<div class="metabox-holder has-right-sidebar">
<div class="meta-box-sortabless">

    <?php include 'wpcashlinks-admin-sidebar.php'; ?>

	<div class="has-sidebar sm-padded">
	<div id="post-body-content" class="has-sidebar-content">
	<div class="meta-box-sortabless">

	<div class="postbox">
	<h3 class="hndle">Add New Keyword</h3>
	<div class="inside">

   
	<form id="keylinkForm" method="post" action="">
	<table width="100%">
    <tbody>
    <tr>
        <td width="10%"><label for="txtKeyword">Keyword: </label></td>
        <td><p><input type="text" name="txtKeyword" size="40" value="" required/></p></td>
    </tr>
    <tr>
        <td><label for="txtUrl">Url: </label></td>
        <td><p><input type="url" name="txtUrl" size="60" value="" required/></p></td>
        </li>
    </tr>
    <tr>
        <td colspan="2">
        <?php wp_nonce_field( 'add_keyword_link' ); ?>
        <p><input type="hidden" name="wpcl_addkeyword" value="add_keyword" />
        <input type="submit" class="button-primary" value="<?php _e('Add') ?>" /></p>
        </td>
    </tr>
    </tbody>
    </table>
	</form>
    <script>
        $("#keylinkForm").validate();
    </script>

	</div>
	</div> <!--postbox-->


	<div class="postbox">
	<h3 class="hndle">Active Keywords and Urls</h3>
	<div class="inside">

	<form name="formdelete" method="post" action="">
	<table class="widefat">
	<thead>
    <tr>
        <th>No.</th>
        <th>Keyword</th>      
        <th>Url</th>
        <th>&nbsp;</th>
    </tr>
	</thead>
	<tfoot>
    <tr>
        <th>No.</th>
        <th>Keyword</th>      
        <th>Url</th>
        <th>&nbsp;</th>
    </tr>
	</tfoot>
	<tbody>
	<?php
		global $wpdb;
		$num = 1;
		$i = 1;

		$keywordLists = $wpdb->get_results("SELECT * FROM wp_wpcl_keywords");
		foreach ( $keywordLists as $keywordList ) {

		$id = $keywordList->id;
		$anchor = $keywordList->anchor;
		$url = $keywordList->url;

		if( $i%2 ) {
		?>
		<tr id="<?php echo $id; ?>" class="edit_tr">
		<?php } else { ?>
		<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
		<?php } ?>

		<td width="5%"><?php echo $num++; ?></td>
		<td>
			<span id="anchor_<?php echo $id; ?>" class="text"><?php echo $anchor; ?></span>
			<input type="text" value="<?php echo $anchor; ?>" class="editbox" id="anchor_input_<?php echo $id; ?>" />
		</td>
		<td>
			<span id="url_<?php echo $id; ?>" class="urltext"><?php echo $url; ?></span> 
			<input type="text" value="<?php echo $url; ?>"  class="urleditbox" id="url_input_<?php echo $id; ?>" />
		</td>
		<td align="center"><input name="checkbox[]" type="checkbox" id="checkbox[]" class="selectedId" value="<?php echo $id; ?>"></td>
	<?php
		$i++;
		}
	?>
	</tr>
	<tr>
		<td colspan="4" align="right">
            <?php wp_nonce_field( 'delete_keyword_link' ); ?>
			<input name="selectall" type="checkbox" id="selectall"/> Select All &nbsp;&nbsp;
			<input type="hidden" name="wpcl_deletekeyword" value="delete_keyword" />
			<input name="delete" type="submit" id="delete" class="button-primary" value="<?php _e('Delete') ?>">
		</td>
	</tr>
	</tbody>
	</table>
	</form>

	</div>
	</div> <!--postbox-->

	</div> <!--meta-box-sortabless-->
	</div> <!--has-sidebar-content-->
	</div> <!--has-sidebar sm-padded-->

</div> <!--meta-box-sortabless-->
</div> <!--metabox-holder has-right-sidebar-->
</div>


