<script>
    window.onloadCallback = function() {
        $('.g-recaptcha').each(function(i, v) {
            const $placeholder = $(this)

            // Define a widget id that will be used by every grecaptcha method
            // to keep track of which form is being used
            $placeholder.attr('widget-id', i)

            console.log($placeholder)

            grecaptcha.render( this, {
                callback: function( token ) {
                    return new Promise(function(resolve, reject) {
                        if( grecaptcha === undefined ) {
                            console.log( 'reCaptcha not defined' )
                            reject()
                        }

                        var response = grecaptcha.getResponse( $placeholder.attr('widget-id') )
                        if( !response ) {
                            console.log( 'Could not get reCaptcha response' )
                            reject()
                        }

                        const $form = $placeholder.closest('form')

                        console.log($form.find('.g-recaptcha-response'))
                        $form
                            // Add a class that will be used to bypass the prevented submit event
                            .addClass('recap-done');

                        $form.find('[type="submit"]').removeClass('disabled')

                        setTimeout(function(f, t) {
                            f.find('.g-recaptcha-response').html( t )
                            f.find('[type="submit"]').trigger('click')
                        }, 500, $form, token)

                        resolve()
                        grecaptcha.reset( $placeholder.attr('widget-id') )
                    })
                },
                sitekey: `{{ config('recaptcha.api_site_key') }}`,
                size: 'invisible', // This makes the real reCaptcha V2 Invisible
            })
        })
    }

    $('form').on('submit', function(e) {
        const $form = $(this)

        if (debug)
            return;

        if( $form.hasClass('recap-done') ) {
            return
        }

        $form.find('[type="submit"]').addClass('disabled')

        const $placeholder = $form.find('.g-recaptcha')
        if( $placeholder.length > 0 ) {
            e.preventDefault()

            grecaptcha.execute( $placeholder.attr('widget-id') )
        }
    })
</script>
