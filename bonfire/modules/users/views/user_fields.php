<?php /* /users/views/user_fields.php */

$currentMethod = $this->router->fetch_method();

$errorClass     = empty($errorClass) ? ' error' : $errorClass;
$controlClass   = empty($controlClass) ? 'span4' : $controlClass;
$registerClass  = $currentMethod == 'register' ? ' required' : '';
$editSettings   = $currentMethod == 'edit';

?>
<div class="control-group<?php echo form_error('email') ? $errorClass : ''; ?>">
    <label class="control-label required" for="email"><?php echo lang('bf_email'); ?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="email" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : set_value('email')); ?>" />
        <span class="help-inline"><?php echo form_error('email'); ?></span>
    </div>
</div>
<div class="control-group<?php echo form_error('display_name') ? $errorClass : ''; ?>">
    <label class="control-label required" for="display_name"><?php echo lang('bf_display_name'); ?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="display_name" name="display_name" value="<?php echo set_value('display_name', isset($user) ? $user->display_name : set_value('display_name')); ?>" />
        <span class="help-inline"><?php echo form_error('display_name'); ?></span>
    </div>
</div>
<?php if (settings_item('auth.login_type') !== 'email' || settings_item('auth.use_usernames')) : ?>
<div class="control-group<?php echo form_error('username') ? $errorClass : ''; ?>">
    <label class="control-label required" for="username"><?php echo lang('bf_username'); ?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="username" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : set_value('username')); ?>" />
        <span class="help-inline"><?php echo form_error('username'); ?></span>
    </div>
</div>
<?php endif; ?>
<div class="control-group<?php echo form_error('password') ? $errorClass : ''; ?>">
    <label class="control-label<?php echo $registerClass; ?>" for="password"><?php echo lang('bf_password'); ?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="password" id="password" name="password" />
        <span class="help-inline"><?php echo form_error('password'); ?></span>
        <p class="help-block"><?php echo isset($password_hints) ? $password_hints : ''; ?></p>
    </div>
</div>
<div class="control-group<?php echo form_error('pass_confirm') ? $errorClass : ''; ?>">
    <label class="control-label<?php echo $registerClass; ?>" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="password" id="pass_confirm" name="pass_confirm" />
        <span class="help-inline"><?php echo form_error('pass_confirm'); ?></span>
    </div>
</div>
<fieldset>
    <legend>Personal Details</legend>
<div class="control-group<?php echo form_error('jamat') ? $errorClass : ''; ?>"
    style="display:inline-block" >
    <label class="control-label required" for="jamat"><?php echo "Jamat Name"?></label>
    <?php 
        $jamats = $this->db->select('jamat_name')->from('jamats')->get()->result();
        $jamat_list[''] = 'Jamat';
        foreach($jamats as $jamat)
        {   
            $jamat_list[$jamat->jamat_name] = $jamat->jamat_name;
        }
        echo form_dropdown('jamat', $jamat_list, !empty($user->jamat) ? $user->jamat : set_value('jamat')); 
    ?>
    <span class="help-inline"><?php echo form_error('jamat'); ?></span>
</div>
<div class="control-group<?php echo form_error('AIMS') ? $errorClass : ''; ?>">
    <label class="control-label required" for="AIMS"><?php echo "AIMS ID"?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="AIMS" name="AIMS" value="<?php echo set_value('AIMS', isset($user) ? $user->AIMS : set_value('AIMS')); ?>" />
        <span class="help-inline"><?php echo form_error('AIMS'); ?></span>
    </div>
</div>

<?php if ($editSettings) : ?>
<div class="control-group<?php echo form_error('force_password_reset') ? $errorClass : ''; ?>">
    <div class="controls">
        <label class="checkbox" for="force_password_reset">
            <input type="checkbox" id="force_password_reset" name="force_password_reset" value="1" <?php echo set_checkbox('force_password_reset', empty($user->force_password_reset)); ?> />
            <?php echo lang('us_force_password_reset'); ?>
        </label>
    </div>
</div>
<?php endif; ?>

<div class="control-group<?php echo form_error('gender') ? $errorClass : ''; ?>">
    <label class="control-label required" for="gender"><?php echo "Gender"?></label>
    <span class="help-inline"><?php echo form_error('gender'); ?></span>  
    <div class="controls" role="group">
        <label class="radio" for="gender_male">
            <input type="radio" name="gender" id="gender_male" value="M"
            <?php echo set_radio('gender', 'M', isset($user) && $user->gender == 'M'); ?> />
            <?php echo "Male" ?>
        </label>
        <label class="radio" for="gender_female">
            <input type="radio" name="gender" id="gender_female" value="F" 
            <?php echo set_radio('gender', 'F', isset($user) && $user->gender == 'F'); ?> />
            <?php echo "Female" ?>
        </label>
    </div>
</div>

<div class="control-group<?php echo form_error('birth_date') ? $errorClass : ''; ?>"
    style="display:inline-block;">
    <label class="control-label required" for="birth_date"><?php echo "Birth Date"?></label>
        <?php
        $this->load->helper('birthdate');
        echo buildYearDropdown('birth_date_year', isset($user->birth_date) ? date('Y', strtotime($user->birth_date)) : set_value('birth_date_year'));
        echo buildMonthDropdown('birth_date_month', isset($user->birth_date) ? date('m', strtotime($user->birth_date)) : set_value('birth_date_month'));
        echo buildDayDropdown('birth_date_day', isset($user->birth_date) ? date('d', strtotime($user->birth_date)) : set_value('birth_date_day'));
        ?>
    <span class="help-inline"><?php echo form_error('birth_date'); ?></span>
</div>

<div class="control-group<?php echo form_error('home_phone') ? $errorClass : ''; ?>">
    <label class="control-label" for="home_phone"><?php echo "Home Phone"?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="home_phone" name="home_phone" value="<?php echo set_value('home_phone', isset($user) ? $user->home_phone : set_value('home_phone')); ?>" />
        <span class="help-inline"><?php echo form_error('home_phone'); ?></span>
    </div>
</div>

<div class="control-group<?php echo form_error('cell_phone') ? $errorClass : ''; ?>">
    <label class="control-label required" for="cell_phone"><?php echo "Cell Phone"?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="cell_phone" name="cell_phone" value="<?php echo set_value('cell_phone', isset($user) ? $user->cell_phone : set_value('cell_phone')); ?>" />
        <span class="help-inline"><?php echo form_error('cell_phone'); ?></span>
    </div>
</div>

<div class="control-group<?php echo form_error('street_address') ? $errorClass : ''; ?>">
    <label class="control-label required" for="street_address"><?php echo "Street Address"?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="street_address" name="street_address" value="<?php echo set_value('street_address', isset($user) ? $user->street_address : set_value('street_address')); ?>" />
        <span class="help-inline"><?php echo form_error('street_address'); ?></span>
    </div>
</div>

<div class="control-group<?php echo form_error('city') ? $errorClass : ''; ?>">
    <label class="control-label required" for="city"><?php echo "City"?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="city" name="city" value="<?php echo set_value('city', isset($user) ? $user->city : set_value('city')); ?>" />
        <span class="help-inline"><?php echo form_error('city'); ?></span>
    </div>
</div>
<div class="control-group<?php echo form_error('state') ? $errorClass : ''; ?>">
    <label class="control-label required" for="state"><?php echo "State"; ?></label>
    <div class="controls">
        <?php
        echo state_select(
            set_value('state', isset($user) ? $user->state : 'CA'),
            '',
            'US',
            'state',
            'span6 chzn-select'
        );
        ?>
        <span class="help-inline"><?php echo form_error('state'); ?></span>
    </div>
</div>
<div class="control-group<?php echo form_error('zip_code') ? $errorClass : ''; ?>">
    <label class="control-label required" for="zip_code"><?php echo "Zip Code"?></label>
    <div class="controls">
        <input class="<?php echo $controlClass; ?>" type="text" id="zip_code" name="zip_code" value="<?php echo set_value('zip_code', isset($user) ? $user->zip_code : set_value('zip_code')); ?>" />
        <span class="help-inline"><?php echo form_error('zip_code'); ?></span>
    </div>
</div>
</fieldset>