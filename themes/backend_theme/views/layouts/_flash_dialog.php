<?php
if($flashes = Yii::$app->session->getAllFlashes()) {
	$i=0;
//	print_r($flashes);
	foreach($flashes as $key => $message) {
		if(is_array($message)) {
			$tmpmsg = "";
			foreach($message as $msg) {
				$tmpmsg .= "<p>".$msg."</p>";
			}
		} else {
			$tmpmsg = $message;
		}
	?>
	<script type="text/javascript">
	$(document).ready(function() {
		$.errorHandler().setError('<?=$key?>','<?=$tmpmsg?>');
	})
	</script>
	
	
	<?php
	$i++;
	}
	//
//		if($key != 'counters') {
//			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
//						'id'=>$key,
//						'options'=>array(
//							'show' => 'blind',
//							'hide' => 'explode',
//							'modal' => 'true',
//							'title' => $message,
//							'autoOpen'=>true,
//							),
//						));
// 
//			printf('<span class="dialog">%s</span>', $message);
// 
//			$this->endWidget('zii.widgets.jui.CJuiDialog');
//		}
//	}
}
?>