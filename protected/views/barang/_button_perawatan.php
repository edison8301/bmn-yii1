<?php echo CHtml::link('<i class="glyphicon glyphicon-trash"></i>', array('barangPerawatan/delete', 'id'=>$perawatan->id),
  array(
    'submit'=>array('barangPerawatan/delete', 'id'=>$perawatan->id, 'barang'=>$model->id),
    'class' => 'delete','confirm'=>'Apa anda yakin?'
  )
);
 ?>