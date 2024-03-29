<?php
/* @var $this CountriesController */
/* @var $data Countries */
?>

<ol class="list-group list-group-numbered">
    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
            <div class="fw-bold">
                <b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
                </b><?php echo CHtml::encode($data->name); ?>
            </div>
            <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
            <?php echo CHtml::encode($data->status==1 ? 'Enabled' : 'Disabled'); ?>
        </div>
        <span class="badge bg-primary rounded-pill">
            <?php echo CHtml::link(CHtml::encode('Ver'), array('view', 'id'=>$data->id)); ?>
        </span>
        <a href="<?php echo $this->createUrl('enable', array('id' => $data->id))?>">
            <span class="badge bg-<?php echo $data->status == 1? 'primary' : 'warning' ?> rounded-pill">
                <?php echo $data->status == 1 ? 'Enable' : 'Disable'; ?>
            </span>
        </a>
    </li>
</ol><br>