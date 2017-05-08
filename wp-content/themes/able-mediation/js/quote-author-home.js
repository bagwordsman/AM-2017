jQuery(document).ready(function( $ ) {

$('#kl-erq-2 p').html(function (i, html) {
    return html.replace(/(\w+\s\w+)$/, '<br/><span class="cite">$1</span>')
});		
$('.cite').appendTo('#kl-erq-2');

        var myWidth = 0, myHeight = 0;
    function getSize(){
            if( typeof( window.innerWidth ) == 'number' ) {
                //Non-IE
                myWidth = window.innerWidth;
                myHeight = window.innerHeight;
            } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
            //IE 6+ in 'standards compliant mode'
                myWidth = document.documentElement.clientWidth;
                myHeight = document.documentElement.clientHeight;
                }   
    }

    getSize(); // run first time
            $(window).resize(function(){
                getSize(); // do it on resize
            });

                if (myWidth >= 960) {
    $('.widget-caption').appendTo('#soliloquy-container-70');
}   
                else if (myWidth <= 959) {
    $('.widget-caption').insertAfter('#soliloquy-container-70');
} 
	
});