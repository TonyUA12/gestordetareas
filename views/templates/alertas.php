<?php
    foreach($alertas as $key => $alert):
        foreach($alert as $message):
?>

    <div class="alert <?php echo $key; ?>"><?php echo $message; ?></div>


<?php
        endforeach;
    endforeach;
?>