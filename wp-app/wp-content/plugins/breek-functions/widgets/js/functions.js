(function($){

    $(document).ready(function(){
        
        $('.epcl-select-day').each(function(){
            var container = $(this);
            container.find('select').on('change', function(){
                var value = $(this).val();
                if( value == 'bydays' ){
                    container.find('.epcl-days').show();
                }else{
                    container.find('.epcl-days').hide();
                }
            });
        });

    });

})(jQuery);