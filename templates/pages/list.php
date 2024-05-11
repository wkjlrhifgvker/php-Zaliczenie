<div>
   <div class="message">
    <?php
    if (!empty($params['before'])) {
    switch ($params['before']){
        case 'created':
            echo "Notatka zosttala dodana!";
            break;
            default:
            echo "bledny adres url!";
            break;
    }
    }
    ?>
   </div> 
<b><?php echo $params['resultList'] ?? "" ?></b>
<h3>Lista notatek</h3>
</div>