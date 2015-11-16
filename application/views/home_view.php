<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
    <head>
        <title>Note-to-myself private page</title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("assets/css/custom.css"); ?>" />
        <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.11.3.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
        <script type="text/javascript">
            function openInNew(textbox){
                window.open(textbox.value);
                this.blur();
            }
        </script>
    </head>
    <div class="container">
        <div class="jumbotron text-center">
            <h2><?php echo $email ?> - </h2>
        </div>
        <?php echo form_open('Home', array('role' => 'form')); ?>
        <div class="row">
            <div class="col-sm-3">
                <h3>Notes</h3>
                <textarea name="notes" rows="20"><?php if($note != null) {echo $note[0]->{'note'}; }?></textarea>
            </div>
            <div class="col-sm-3">
                <h3>Websites</h3>
                <?php if($url != null) {
                    foreach($url as $u):
                        echo "<input type='text' name='urls[]' value='$u->url' onclick='openInNew(this)'>";
                    endforeach;
                } ?>

                <!-- generate 4 extra input boxes -->
                <?php for($i = 0; $i < 4; $i++) : ?>
                    <?php echo "<input type='text' name='urls[]'>"; ?>
                <?php endfor; ?>

            </div>
            <div class="col-sm-3">
                <h3>Images</h3>
                <input type="file" name="filetoupload">
            </div>
            <div class="col-sm-3">
                <h3>TBD</h3>
                <textarea name="tbd" rows="20"><?php if($tbd != null) {echo $tbd[0]->{'tbd'}; }?></textarea>
            </div>
        </div>
    </div>
    <div style="text-align:center">
        <p><input type="submit" value="Save" name="submit" class="btn btn-default"/></p>
    </div>
</html>