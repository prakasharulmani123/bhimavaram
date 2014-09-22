jQuery(function(){
	jQuery('.add-business-info').slideUp();
jQuery('.datepicker').datepicker({format:'yyyy-mm-dd'});

jQuery( '.password-form' ).parsley( 'addListener', {
    onFieldValidate: function ( elem ) {

        // if field is not visible, do not apply Parsley validation!
        if ( !$( elem ).is( ':visible' ) ) {
            return true;
        }

        return false;
    }
} );

jQuery('.add-contact-info').click(function(){
	jQuery('.choose-business').slideUp();
	jQuery('.add-business-info').slideDown();
});//add-contact ends

});//jQuery Ends