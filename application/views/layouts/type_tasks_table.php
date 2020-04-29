Статус &nbsp;&nbsp;
<select id="taskStatus" class="callback-status custom-select">
    <?php if(isset($_SESSION['status'])): ?>    
        <option value="<?php echo STATUS_ALL;?>"<?php echo $this->data['status'] == STATUS_ALL ? ' selected':'';?>>Все
        </option>
    <?php endif;?>
    <option value="<?php echo STATUS_TOPICAL;?>"<?php echo $this->data['status'] == STATUS_TOPICAL ? ' selected':'';?>>Актуальные
    </option>
    <?php for ( $i = 0; $i < count($this->data['types']); $i++ ): ?> 
        <?php if(!isset($_SESSION['status']) && ($this->data['types'][$i]['id'] == STATUS_REJECTED ||  $this->data['types'][$i]['id'] == STATUS_PERFORMED)) {continue;} 
        ?> 
        <option value="<?php echo $this->data['types'][$i]['id'];?>"<?php echo $this->data['status'] == $this->data['types'][$i]['id'] ? ' selected':'';?>><?php echo trim($this->data['types'][$i]['name']);?><?php if ($this->data['types'][$i]['id']==0) echo 'На проверке'; else if ($this->data['types'][$i]['id']=='1') echo 'Выполненные'; else if ($this->data['types'][$i]['id']==4) echo 'Отклоненные';?>
        </option>
   <?php endfor;?>
</select>