<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login to note-to-myself</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
    </head>
    <body>
        <div class="container">
        <h1>Note-to-myself Log in</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('verifyLogin', array('role' => 'form')); ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" size="20" id="email" name="email"/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" size="20" id="password" name="password"/>
            </div>
            <input type="submit" class="btn btn-default" value="Login"/>
        </form>

        <p><?php echo anchor('form', 'Register'); ?> | <?php echo anchor('ForgetPW', 'Forgot password'); ?> </p>
        </br><a href="#">Twitter</a>
        </div>
    </body>
</html>