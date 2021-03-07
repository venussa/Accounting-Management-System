<?php

function pjax($class = "data-pjax", $container = "container",$content = "content",$pjax_load_data = "#pjax-load-data"){

	$pjax = "<script>

		pjax.connect({

		'".$container."': '".$content."',
		'useClass'  : '".$class."',
		'beforeSend' : function(){
			$('".$pjax_load_data."').show();
		},
		'success': function(event){
			var url = (typeof event.data !== 'undefined') ? event.data.url : '';
			console.log(\"Successfully loaded \"+ url);
			$('".$pjax_load_data."').hide();
		},
		'error': function(event){
			var url = (typeof event.data !== 'undefined') ? event.data.url : '';
			console.log(\"Could not load \"+ url);
			alert('failed load data');
		},
		'ready': function(){
			console.log(\"loaded!\");
		}
	});
	</script>
	";

	return $pjax;

}