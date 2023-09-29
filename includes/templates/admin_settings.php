<div class="wrap">
    <div class="leftcol">
    <h1>News Settings</h1>
    <form method="post" action="<?php echo admin_url('edit.php?post_type=news&page=news-settings') ?>">
        <?php wp_nonce_field('news-settings-save','news_settings_nonce' ); ?> 
        <table class="form-table">
            <tbody> 
                <tr>
                    <th><label for="news_related_title"><?php echo esc_html__( 'Related News Title', 'hello-world-yo') ?></label></th>
                    <td><input id="news_related_title" type="text" name="news_related_title" value="<?php echo esc_attr( ( isset( $_POST['news_related_title']) ? $_POST['news_related_title'] : get_option('hwy_news_related_title', 'Related News' ) ) ) ?>" required></td>
                </tr> 
                <tr>
                    <th><label for="news_related_email"><?php echo esc_html__( 'Related News Email', 'hello-world-yo') ?></label></th>
                    <td><input id="news_related_email" type="email" name="news_related_email" value="<?php echo esc_attr(( isset( $_POST['news_related_email']) ? $_POST['news_related_email'] : get_option('hwy_news_related_email','')))?> " required></td>
                </tr> 
                <tr>
                    <th><label for="show_related"><?php echo esc_html__('Show Related News?', 'hello-world-yo')?></label></th>
                    <td><input id="show_related" type="checkbox" name="show_related" value="1" <?php checked( get_option('hwy_show_related', true) ) ?> ></td>
                </tr> 
                <tr>
                <th><label for="related_news_amount">Number of Articles</label></th>
                    <td>
                    <select id ="related_news_amount" name="related_news_amount">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <option value="<?php echo $i; ?>"<?php selected( (isset( $_POST['related_news_amount']) ? $_POST['related_news_amount'] : get_option('hwy_related_news_amount', 3)), $i)?>><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"> 
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo esc_attr__('Save Changes', 'hello-world-yo' ) ?> ">
        </p>
    </form>
    </div>
    <div class="rightcol">
       <?php echo __('You Can <a href="https://google.com">check out our website!</a>','hello-world-yo') ?>
    </div>
</div>
