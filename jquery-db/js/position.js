$(document).ready(function()
{
    $(".plus_button").click(function (event)
    {
        event.preventDefault();
        if($(this).attr('id') === "plus_position")
        {
            var n_divs = $("#position_fields > div").length;
            if(n_divs < 9)
            {
                var html = '<div id="position' + (n_divs + 1) + '">\n<p>Year: <input type="text" name="year' + (n_divs + 1) + '">\n<input type="button" value="-" onclick="$(\'#position' + (n_divs + 1) + '\').remove(); fix_position(); return false;"></p><p><textarea name="desc' + (n_divs + 1) + '" rows="8" cols="80"></textarea></p></div>\n';
                $('#position_fields').append(html);
            }
            else
                alert("Maximum of nine position entries exceeded");
        }
        else
        {
            var n_divs = $("#edu_fields > div").length;
            if(n_divs < 9)
            {
                var html = '<div id="edu' + (n_divs + 1) + '">\n<p>Year: <input type="text" name="edu_year' + (n_divs + 1) + '">\n<input type="button" value="-" onclick="$(\'#edu' + (n_divs + 1) + '\').remove(); fix_education(); return false;"></p><p>School: <input type="text" size="80" name="edu_school' + (n_divs + 1) + '" class="school" autocomplete="off"/></p></div>\n';
                $('#edu_fields').append(html);
            }
            else
                alert("Maximum of nine education entries exceeded");
        }
        $('.school').autocomplete({ source: "school.php" });
    });

    function fix_position()
    {
        var div_tags = $("#position_fields").children("div");
        for(i = 0; i < div_tags.length; i++)
        {
            $(div_tags[i]).attr('id', 'position' + (i + 1));
            $(div_tags[i]).find("textarea").attr('name', 'desc' + (i + 1));
            input_tags = $(div_tags[i]).find("input"); 
            $(input_tags[0]).attr('name', 'year' + (i + 1)); 
            $(input_tags[1]).attr('onclick', '$(\'#position' + (i + 1) + '\').remove(); fix_position(); return false;');
        }
    }

    function fix_education()
    {
        var div_tags = $("#edu_fields").children("div");
        for(i = 0; i < div_tags.length; i++)
        {
            $(div_tags[i]).attr('id', 'edu' + (i + 1));
            $(div_tags[i]).find(".school").attr('name', 'edu_school' + (i + 1)); 
            input_tags = $(div_tags[i]).find("input"); 
            $(input_tags[0]).attr('name', 'edu_year' + (i + 1)); 
            $(input_tags[1]).attr('onclick', '$(\'#edu' + (i + 1) + '\').remove(); fix_education(); return false;');
        }
    }

    $('.school').autocomplete({ source: "school.php" });

});

