<?php
    foreach ($alertas as $key => $alerta):
        foreach($alerta as $menaje):
?>
    <div class="alerta <?php echo $key;?>"><?php echo $menaje; ?></div>
<?php 
        endforeach;
    endforeach;
?>