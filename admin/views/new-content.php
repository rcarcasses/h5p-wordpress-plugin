<?php
/**
 * Add new H5P Content.
 *
 * @package   H5P
 * @author    Joubel <contact@joubel.com>
 * @license   MIT
 * @link      http://joubel.com
 * @copyright 2014 Joubel
 */
?>

<div class="wrap">
  <h2>
    <?php if ($this->content === NULL): ?>
      <?php print esc_html(get_admin_page_title()); ?>
    <?php else: ?>
      <?php esc_html_e('Edit', $this->plugin_slug); ?> <em><?php print esc_html($title); ?></em>
      <a href="<?php print admin_url('admin.php?page=h5p&task=show&id=' . $this->content['id']); ?>" class="add-new-h2"><?php _e('View', $this->plugin_slug); ?></a>
      <a href="<?php print admin_url('admin.php?page=h5p&task=results&id=' . $this->content['id']); ?>" class="add-new-h2"><?php _e('Results', $this->plugin_slug); ?></a>
    <?php endif; ?>
  </h2>
  <?php H5P_Plugin_Admin::print_messages(); ?>
  <?php if (!$contentExists || $this->current_user_can_edit($this->content)): ?>
    <form method="post" enctype="multipart/form-data" id="h5p-content-form">
      <div id="post-body-content">
        <div id="titlediv">
          <label class="" id="title-prompt-text" for="title"><?php esc_html_e('Enter title here', $this->plugin_slug); ?></label>
          <input id="title" type="text" name="title" id="title" value="<?php print esc_attr($title); ?>"/>
        </div>
        <div class="h5p-upload"><input type="file" name="h5p_file" id="h5p-file"/></div>
        <div class="h5p-create"><div class="h5p-editor"><?php esc_html_e('Waiting for javascript...', $this->plugin_slug); ?></div></div>
      </div>
      <div class="postbox">
        <div id="minor-publishing">
          <label><input type="radio" name="action" value="upload"<?php if ($upload): print ' checked="checked"'; endif; ?>/><?php esc_html_e('Upload', $this->plugin_slug); ?></label>
          <label><input type="radio" name="action" value="create"/><?php esc_html_e('Create', $this->plugin_slug); ?></label>
          <input type="hidden" name="library" value="<?php print esc_attr($library); ?>"/>
          <input type="hidden" name="parameters" value="<?php print $parameters; ?>"/>
          <?php wp_nonce_field('h5p_content', 'yes_sir_will_do'); ?>
        </div>
        <div id="major-publishing-actions" class="submitbox">
          <?php if ($this->content !== NULL): ?>
            <a class="submitdelete deletion" href="<?php print wp_nonce_url(admin_url('admin.php?page=h5p_new&id=' . $this->content['id']), 'deleting_h5p_content', 'delete'); ?>">Delete</a>
          <?php endif; ?>
          <input type="submit" name="submit" value="<?php esc_html_e($this->content === NULL ? 'Create' : 'Update', $this->plugin_slug) ?>" class="button button-primary button-large"/>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>
