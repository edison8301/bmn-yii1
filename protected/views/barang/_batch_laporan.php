<div>&nbsp;</div>
<div id="link-export" style="text-align: center">
	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Laporan Barang',
			'icon'=>'list',
			'context'=>'danger',
			'size'=>'large',
			'url'=>array('barang/exportExcel')
	)); ?>&nbsp;
	
	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Laporan Pengguna',
			'icon'=>'wrench',
			'context'=>'primary',
			'size'=>'large',
			'url'=>array('barang/reportPerawatan')
	)); ?>&nbsp;

	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Laporan Pemeriksaan',
			'icon'=>'wrench',
			'context'=>'warning',
			'size'=>'large',
			'url'=>array('barang/reportPemeriksaan')
	)); ?>&nbsp;

	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Laporan Pemindahan',
			'icon'=>'list',
			'context'=>'success',
			'size'=>'large',
			'url'=>array('barang/reportPemindahan')
	)); ?>&nbsp;	

</div>

<div>&nbsp;	</div>