

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript">
 $(document).ready(function(){
        var url      = window.location.href;
        var res = url.split("/");  
        var lastEl = res[res.length-1];
        
        $( "#navul li" ).each(function( index ) {
         var thisurl=$(this).children('a').attr('href');
         if(url==thisurl){
            $(this).attr('class', 'active');
         }
});

 });
    $('.form-file').change( function() {    
        $(this).next('.ahah-processed').click();
    });    
$('select').selectpicker();
   
        

    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo BASE_URL; ?>/static/frontend/js/ie10-viewport-bug-workaround.js"></script>
  