<?php echo CHtml::link('<i class="glyphicon glyphicon-trash"></i>', array('barangPemeriksaan/delete', 'id'=>$perawatan->id),
  array(
    'submit'=>array('barangPemeriksaan/delete', 'id'=>$perawatan->id, 'barang'=>$model->id),
    'class' => 'delete','confirm'=>'Apa anda yakin?'
  )
); ?>