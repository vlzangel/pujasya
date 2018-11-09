<script src="<?= base_url()?>public/assets/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript">
	var cron = 0;
	var REVISAR = true;
	jQuery(document).ready(function() {
		cron = setInterval("new_cron()", 1000);
	});
	function new_cron() {
	    if( REVISAR ){
	        jQuery.post(
	            "<?= base_url('Pujar/cronPujas') ?>",
	            {},
	            function(data){
	                console.log(data);
	            }, 'json'
	        );
	    }
	} 
</script>