<div class="wrap">
    
    <h2>Marketo</h2>
    
    <?php settings_errors('marketo_fat'); ?>
    
    <form method="post" action="">
        
        <input type="hidden" name="marketo_save" value="true" />
    	
    	<h3>Forms & Tracking</h3>
    
        <table class="form-table">
        	<tbody>
                <tr valign="top">
                    <th scope="row"><label for="marketo_id">Marketo Account ID</label></th>
                    <td><input name="marketo[marketo_id]" type="text" id="marketo_id" value="<?php echo $marketo_id; ?>" class="regular-text"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="marketo_base_url">Marketo Base Url</label></th>
                    <td><input name="marketo[marketo_base_url]" type="text" id="marketo_base_url" value="<?php echo $marketo_base_url; ?>" class="regular-text"></td>
                </tr>
        	</tbody>
        </table>
        
        <hr>
        
    	<h3>Prepopulate</h3>
    
        <table class="form-table">
        	<tbody>
                <tr valign="top">
                    <th scope="row"><label for="user_id">Marketo User Id</label></th>
                    <td><input name="marketo[user_id]" type="text" id="user_id" value="<?php echo $user_id; ?>" class="regular-text"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="end_point">Marketo End Point Url</label></th>
                    <td><input name="marketo[end_point]" type="text" id="end_point" value="<?php echo $end_point; ?>" class="regular-text"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="secret">Marketo Sercet Key</label></th>
                    <td><input name="marketo[secret]" type="text" id="secret" value="<?php echo $secret; ?>" class="regular-text"></td>
                </tr>
        		<tr valign="top">
    				<th scope="row">Enable</th>
    				<td>
        				<fieldset>
        					<legend class="screen-reader-text">
        						<span>Enable Prepopulate Fields</span>
        					</legend>
        					<label for="prepopulate">
        						<input name="marketo[prepopulate]" type="checkbox" id="prepopulate" value="1" <?php if( ! empty($prepopulate) ) echo 'checked="checked"' ?> >
        						Enable Prepopulate Fields
    						</label>
        					<br>
        				</fieldset>
    				</td>
    			</tr>
        	</tbody>
        </table>
        
        <hr>
        
    	<h3>Popout</h3>
    
        <table class="form-table">
        	<tbody>
                <tr valign="top">
                    <th scope="row"><label for="popout_title">Popout Title</label></th>
                    <td><input name="marketo[popout_title]" type="text" id="popout_title" value="<?php echo $popout_title; ?>" class="regular-text"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="popout_tabtext">Popout Tab Text</label></th>
                    <td><input name="marketo[popout_tabtext]" type="text" id="popout_tabtext" value="<?php echo $popout_tabtext; ?>" class="regular-text"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="popout_snippet">Popout Snippet</label></th>
                    <td><textarea name="marketo[popout_snippet]" rows="5" cols="40" id="popout_snippet" class="regular-text"><?php echo $popout_snippet; ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="popout_form">Popout Form ID</label></th>
                    <td>
                        <input name="marketo[popout_form]" type="text" id="popout_form" value="<?php echo $popout_form; ?>" class="regular-text">
                        <p class="description">Make sure this form is unique and not used anywhere else on this site. This form is rendered on every page and duplicate forms on a page will cause unpredictable behaviour.</p>
                    </td>
                    
                </tr>
        		<tr valign="top">
    				<th scope="row">Enable</th>
    				<td>
        				<fieldset>
        					<legend class="screen-reader-text">
        						<span>Enable Popout</span>
        					</legend>
        					<label for="popout_enable">
        						<input name="marketo[popout_enable]" type="checkbox" id="popout_enable" value="1" <?php if( ! empty($popout_enable) ) echo 'checked="checked"' ?> >
        							Enable Popout
							</label>
        					<br>
        				</fieldset>
    				</td>
    			</tr>
        	</tbody>
        </table>
        
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
        
    </form>
    
</div>