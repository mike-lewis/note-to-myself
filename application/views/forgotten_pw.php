<html>
<head>
    <title>Reset password</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</head>
    <body>
    <div class="container">
        <h1>Enter your email to reset your password</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('ForgetPW'); ?>

        <div class="form-group">
             <label for="email">Email:</label>
             <input type="email" class="form-control" size="20" id="email" name="email"/>
        </div>
        <input type="submit" class="btn btn-default" name ="submit" value="check"/>
        </form>
        <p><?php echo anchor('login', 'Login'); ?></p>
    </div>
    </body>
</html>