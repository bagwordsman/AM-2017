jQuery(document).ready(function( $ ) {

$('#kl-erq-3 p').html(function (i, html) {
    return html.replace(/(\w+\s\w+)$/, '<br/><span class="cite">$1</span>')
});		
$('.cite').appendTo('#kl-erq-3');
	
});