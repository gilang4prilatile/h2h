<script>
    jQuery(document).ready(function() {

        $("<?= $validator['selector']; ?>").each(function() {
            $(this).validate({
                errorElement: 'span',
                errorClass: 'help-block error-help-block',

                errorPlacement: function(error, element) {
                    if (element.is('select') && element.hasClass('select2-hidden-accessible')) {
                        element.parent().append(error);
                    } else {
                        if (element.parent('.input-group').length ||
                            element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.insertAfter(element.parent());
                            // else just place the validation message immediately after the input
                        } else {
                            error.insertAfter(element);
                        }
                    }

                },
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // add the Bootstrap error class to the control group
                },

                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])) : ?>

                    ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>

                /*
                 // Uncomment this to mark as validated non required fields
                 unhighlight: function(element) {
                 $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                 },
                 */
                success: function(element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // remove the Boostrap error class from the control group
                },

                focusInvalid: true,
                <?php if (Config::get('jsvalidation.focus_on_error')) : ?>
                    invalidHandler: function(form, validator) {
                        var errors = validator.numberOfInvalids();
                        if (errors) {
                            Swal.fire({
                                title: 'Validation Failed',
                                text: 'Please Check your input',
                                icon: 'info'
                            });
                        }

                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top
                        }, <?= Config::get('jsvalidation.duration_animate') ?>);



                    },
                <?php endif; ?>

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>
