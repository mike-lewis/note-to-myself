<html>
    <head>
        <title>Register for note-to-myself</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
    </head>
    <body>
    <div class="container">
        <h1>Register for Note-to-myself</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('form', array('role' => 'form')); ?>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="Email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" size="50" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" value="<?php echo set_value('password'); ?>" size="50" />
        </div>
        <div class="form-group">
            <label for="password_confirm"Password Confirm</h5>
            <input type="text" class="form-control" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />
        </div>
        <div class="form-group">
            <label for="captcha">Captcha</label>
            <input id="captcha" class="form-control" name="captcha" type="text" />
             <?php echo $image; ?>
        </div>
            <p>Type this (or <?php echo anchor('form', 'change'); ?> it):</p>

            <div><input type="submit" class="btn btn-default" value="Submit" /></div>

        </form>


        <p><?php echo anchor('login', 'Login'); ?></p>
    </div>
    </body>
</html>