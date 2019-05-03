<div class="container center">
	<div>
		<span class="high" id="welcome" style="white-space:pre;"></span>
		<h2 class="date"><?php get_instance()->load->helper('tgl_indo'); echo longdate_indo(date('Y-m-d'));?></h2>
		<h1 class="time" id="waktu"></h1>
	</div>

</div>
<script type="text/javascript">
	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}

	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		// add a zero in front of numbers<10
		s = checkTime(s);
		m = checkTime(m);
		h = checkTime(h);
		document.getElementById('waktu').innerHTML = h + ":" + m ;
		t = setTimeout(function () {
			startTime()
		}, 500);
	}
	startTime();
</script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		new Typed('#welcome', {
			strings: ['Welcome <?php echo $this->session->userdata('nama');?> '],
			typeSpeed: 100,
			backSpeed: 100,
			fadeOut: true,
			loop: false
		});
	});
</script>
