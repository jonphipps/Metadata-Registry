function updateUri() {
    var domainField = $('#schema_base_domain'),
        tokenField = $('#schema_token'),
        uriField = $('#schema_uri'),
        newVal = domainField.val() + tokenField.val();
    if ('' != tokenField.val() && uriField.val() != newVal) {
        swal({
            title: "Update URI?",
            text: "Automatically update the URI to '" + newVal + "''?",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, please",
            cancelButtonText: "No!"
        }).then(function () {
            uriField.val(domainField.val() + tokenField.val());
            typeField = $('#schema_ns_type');
            typeField.change();
            typeField.focus();
        }, function (dismiss) {
            uriField.focus();

        })
    }

}

$(document).ready(function () {

    var $selLanguages = $("select#schema_languages");
    var $selLang = $('select#schema_language');
    var $selNamespace = $('#schema_ns_type');

    $selLanguages.select2({
        placeholder: "Select all available Language(s)",
        allowClear: true
    });

    $selLang.select2({
        placeholder: "Select a Default Language",
        allowClear: true
    });

    $selLanguages.on("change",
        function (e) {
            var data = $selLanguages.select2("data");
            var savedVal = $selLang.select2("val");
            $selLang[0].options.length = 0;
            $selLang.select2("val", "");
            $.each(data, function (index, value) {
                $selLang.append('<option value="' + data[index].id + '">' + data[index].text + '</option>');
                if (data[index].id == savedVal) {
                    $selLang.select2("val", savedVal)
                }
            });
        });

    $selNamespace.on('change',
        function (e) {
            var trailing = '/',
                $uri = $('#schema_uri');

            var uri = stripTrailingSlash($uri.val());

            if (this.value == 'hash') {
                trailing = '#';
                $uri.val(uri);
            }
            if (uri !== "") {
                $('#form_row_content_schema_namespace').text(uri + trailing);
            }
        }
    );

    $('#schema_uri').on('change',
        function (e) {
        $('#schema_ns_type').change();
    });

});

function stripTrailingSlash(str) {
    if (typeof str === 'string') {
        if (str.substr(-1) === '/') {
            return str.substr(0, str.length - 1);
        }
    }
    return str;
}
