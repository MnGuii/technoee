<div class="modal-body">
	<div id="bar-example"></div>
</div>
<div class="modal-footer">
	<div class="btn btn-lg btn-info btn-block" data-dismiss="modal">Fechar</div>
</div>
<script>
	setTimeout(function() {
	Morris.Bar({
		element: 'bar-example',
		data: [
		{ y: '2006', a: 100, b: 90 },
		{ y: '2007', a: 75,  b: 65 },
		{ y: '2008', a: 50,  b: 40 },
		{ y: '2009', a: 75,  b: 65 },
		{ y: '2010', a: 50,  b: 40 },
		{ y: '2011', a: 75,  b: 65 },
		{ y: '2012', a: 100, b: 90 }
		],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Series A', 'Series B']
	});
	},500)
</script>