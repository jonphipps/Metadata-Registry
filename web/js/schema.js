function updateUri() {
    var domainField = $('schema_base_domain'),
        tokenField = $('schema_token'),
        uriField = $('schema_uri'),
        updateIt = true;

    if ('' != tokenField.value && uriField.value != domainField.value + tokenField.value) {
        updateIt = confirm("Automatically update the URI based on your changes?");
    }
    if (updateIt) {
        uriField.value = domainField.value + tokenField.value;
        $jq('#schema_ns_type').change();
    }
}

var $jq = jQuery.noConflict();
$jq(document).ready(function () {

    var $selLanguages = $jq("select#schema_languages");
    var $selLang = $jq('select#schema_language');
    var $selNamespace = $jq('#schema_ns_type');

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
            $jq.each(data, function (index, value) {
                $selLang.append('<option value="' + data[index].id + '">' + data[index].text + '</option>');
                if (data[index].id == savedVal) {
                    $selLang.select2("val", savedVal)
                }
            });
        });

    $selNamespace.on('change',
        function (e) {
            var trailing = '/',
                $uri = $jq('#schema_uri');

            var uri = stripTrailingSlash($uri.val());

            if (this.value == 'hash') {
                trailing = '#';
                $uri.val(uri);
            }
            if (uri !== "") {
                $jq('#form_row_content_schema_namespace').text(uri + trailing);
            }
        }
    );

    $jq('#schema_uri').on('change',
        function (e) {
        $jq('#schema_ns_type').change();
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
