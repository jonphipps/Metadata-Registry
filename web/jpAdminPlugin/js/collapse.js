$(document).ready(function (){
        // Add anchor tag for Show/Hide link
        $("fieldset.collapse").each(function(i, elem) {
            // Don't hide if fields in this fieldset have errors
            if ($(elem).find("div.errors").length === 0) {
                $(elem).addClass("collapsed").find("h2").first().append(' <a id="fieldsetcollapser' +
                    i + '" class="collapse-toggle" href="#">' + "+" +  '</a>');
                    $(elem).prop("title", 'click "+" to expand this section');

            }
        });
        // Add toggle to anchor tag
        $("fieldset.collapse a.collapse-toggle").click(function(ev) {
            if ($(this).closest("fieldset").hasClass("collapsed")) {
                // Show
                $(this).text("−").closest("fieldset").removeClass("collapsed").trigger("show.fieldset", [$(this).attr("id")]);
                $(this).text("−").closest("fieldset").prop("title", 'click "−" to collapse this section');

            } else {
                // Hide
                $(this).text("+").closest("fieldset").addClass("collapsed").trigger("hide.fieldset", [$(this).attr("id")]);
                $(this).text("+").closest("fieldset").prop("title", 'click "+" to expand this section');
            }
            return false;
        });

    });