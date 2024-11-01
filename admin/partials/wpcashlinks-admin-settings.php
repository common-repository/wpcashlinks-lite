<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 * @package    wpcashlinks
 * @subpackage wpcashlinks/includes
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
if ( isset( $_REQUEST['wpcl_savesettings'] ) && $_REQUEST['wpcl_savesettings'] == 'save_settings' ) {

    $wpcl_options = get_option('wpcl_options');

    $wpcl_options['numofkeywords'] = intval($_POST['numofkeywords']);
    $wpcl_options['keywordsrepeat'] = intval($_POST['keywordsrepeat']);
    $wpcl_options['enablenofollow'] = ( isset($_POST['enablenofollow']) && !empty($_POST['enablenofollow']) ) ? 1 : 0;
    $wpcl_options['showonhomepage'] = ( isset($_POST['showonhomepage']) && !empty($_POST['showonhomepage']) ) ? 1 : 0;
    $wpcl_options['showonposts'] = ( isset($_POST['showonposts']) && !empty($_POST['showonposts']) ) ? 1 : 0;
    $wpcl_options['showonpages'] = ( isset($_POST['showonpages']) && !empty($_POST['showonpages']) ) ? 1 : 0;

    //print_r($wpcl_options);
	update_option('wpcl_options', $wpcl_options);

    echo '<div class="updated fade"><p><strong>Settings updated successfully</strong></p></div>';
}

?>
<div class="metabox-holder has-right-sidebar">
<div class="meta-box-sortabless">

    <?php include 'wpcashlinks-admin-sidebar.php'; ?>
	<?php $wpcl_options = get_option('wpcl_options'); ?>

	<div class="has-sidebar sm-padded">
	<div id="post-body-content" class="has-sidebar-content">
	<div class="meta-box-sortabless">

	<div class="postbox">
	<h3 class="hndle">Settings</h3>
	<div class="inside">
        <form method="post" action="">
        <table width="100%">
            <tr>
                <td width="20%"><label for="numofkeywords">Maximum keywords per post: </label></td>
                <td>
                <p><select name="numofkeywords">
                    <option value="1" <?php echo $wpcl_options['numofkeywords'] == 1 ? 'selected' : ''; ?>> 1</option>
                    <option value="2" <?php echo $wpcl_options['numofkeywords'] == 2 ? 'selected' : ''; ?>> 2</option>
                    <option value="3" <?php echo $wpcl_options['numofkeywords'] == 3 ? 'selected' : ''; ?>> 3</option>
                    <option value="4" <?php echo $wpcl_options['numofkeywords'] == 4 ? 'selected' : ''; ?>> 4</option>
                    <option value="5" <?php echo $wpcl_options['numofkeywords'] == 5 ? 'selected' : ''; ?>> 5</option>
                </select></p>
                </td>
            </tr>
            <tr>
                <td width="20%"><label for="keywordsrepeat">Keyword repeat per post: </label></td>
                <td>
                <p><select name="keywordsrepeat">
                    <option value="1" <?php echo $wpcl_options['keywordsrepeat'] == 1 ? 'selected' : ''; ?>> 1</option>
                    <option value="2" <?php echo $wpcl_options['keywordsrepeat'] == 2 ? 'selected' : ''; ?>> 2</option>
                    <option value="3" <?php echo $wpcl_options['keywordsrepeat'] == 3 ? 'selected' : ''; ?>> 3</option>
                </select></p>
                </td>
            </tr>
            <tr>
                <td width="20%"><label for="enablenofollow">No-Follow external links? </label></td>
                <td><p><input type="checkbox" name="enablenofollow" value="1" <?php if(($wpcl_options['enablenofollow']) == 1 ) echo 'checked="checked"'; ?> /></p></td>
            </tr>
            <tr>
                <td width="20%"><label for="showonhomepage">Enable on home page? </label></td>
                <td><p><input type="checkbox" name="showonhomepage" value="1" <?php if(($wpcl_options['showonhomepage']) == 1 ) echo 'checked="checked"'; ?> /></p></td>
            </tr>
            <tr>
                <td width="20%"><label for="showonposts">Enable on posts? </label></td>
                <td><p><input type="checkbox" name="showonposts" value="1" <?php if(($wpcl_options['showonposts']) == 1 ) echo 'checked="checked"'; ?> /></p></td>
            </tr>
            <tr>
                <td width="20%"><label for="showonpages">Enable on pages? </label></td>
                <td><p><input type="checkbox" name="showonpages" value="1" <?php if(($wpcl_options['showonpages']) == 1 ) echo 'checked="checked"'; ?> /></p></td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td>
                    <p><input type="hidden" name="wpcl_savesettings" value="save_settings" />
                    <input type="submit" class="button-primary" value="<?php _e('Save') ?>" /></p>
                </td>
            </tr>
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


