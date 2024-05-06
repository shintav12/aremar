$.validator.addMethod("image_validator",function(value,element){
    let array = $(element).fileinput('getFileStack');
    return value!=null && array.length === 1;
},"Verifique el archivo ingresado.");

$.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z ]+$/i.test(value);
}, "Solo se permiten letras y espacio.");


function startValidate(form,rules,ajax){
    let f = $(form);
    f.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        rules: rules,
        highlight: function(e) {
            $(e).closest(".form-group").removeClass("has-success").addClass("has-error");
        },
        errorPlacement: function(e,r){
            r.parents(".mt-radio-list").size() > 0 || r.parents(".mt-checkbox-list").size() > 0 ? (r.parents(".mt-radio-list").size() > 0 && e.appendTo(r.parents(".mt-radio-list")[0]), r.parents(".mt-checkbox-list").size() > 0 && e.appendTo(r.parents(".mt-checkbox-list")[0])) : r.parents(".mt-radio-inline").size() > 0 || r.parents(".mt-checkbox-inline").size() > 0 ? (r.parents(".mt-radio-inline").size() > 0 && e.appendTo(r.parents(".mt-radio-inline")[0]), r.parents(".mt-checkbox-inline").size() > 0 && e.appendTo(r.parents(".mt-checkbox-inline")[0])) : r.parent(".input-group").size() > 0 ? e.insertAfter(r.parent(".input-group")) : r.attr("data-error-container") ? e.appendTo(r.attr("data-error-container")) : e.parents('.input-group-btn').size() > 0 ? e.insertAfter(r.parent()) : e.insertAfter(r);
        },
        unhighlight: function(e) {
            $(e).closest(".form-group").removeClass("has-error");
        },
        success: function(e) {
            $(e).closest(".form-group").removeClass("has-error").addClass("has-success");

        },
        invalidHandler: function(form, validator) {
            swal(
                'Oops...',
                'Aún faltan llenar algunos campos obligatorios para continuar',
                'error'
            );
        },
        submitHandler: ajax
    });

    $(".date-picker .form-control").change(function() {
        f.validate().element($(this));
    });

    $(".form_datetime .form-control").change(function() {
        f.validate().element($(this));
    });

    $(".input-fixed").on('fileselect', function(event, numFiles, label) {
        f.validate().element($(this));
    });
}