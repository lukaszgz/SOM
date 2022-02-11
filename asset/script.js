$("#SearchMarkSelect").change(function() {

    $.ajax({
        type: 'GET',
        url: "api.php",
        dataType: 'json',
        data: {
            v: "model_name, id_model",
            t: "som_models",
            id: $('#SearchMarkSelect').val()
        },
        success: function(result) {
            var html = '<option class="label" value="0">' + $("#SearchModelSelect>.label").text() + '</' +
                'option>';

            for (const name of result) {
                html += '<option value=' + name['id_model'] + '>' + name['model_name'] + '</option>';
            }

            html += '<option value="1000000">Inny</option>';

            $('#SearchModelSelect').html(html);

        },
        error: function(result) {
            // alert("Nie udalo sie");
            var html = '<option class="label" value="0">' + $("#SearchModelSelect>.label").text() + '</' +
                'option>';
            $('#SearchModelSelect').html(html);
        }
    });
});

$("#AddAdSelectMark").change(function() {

    $.ajax({
        type: 'GET',
        url: "api.php",
        dataType: 'json',
        data: {
            v: "model_name, id_model",
            t: "som_models",
            id: $('#AddAdSelectMark').val()
        },
        success: function(result) {
            var html = '<option class="label" value="0">' + $("#AddAdSelectModel>.label").text() + '</' +
                'option>';

            for (const name of result) {
                html += '<option value=' + name['id_model'] + '>' + name['model_name'] + '</option>';
            }

            html += '<option value="1000000">Inny</option>';

            $('#AddAdSelectModel').html(html);

        },
        error: function(result) {
            // alert("Nie udalo sie");
            var html = '<option class="label" value="0">' + $("#AddAdSelectModel>.label").text() + '</' +
                'option>';
            $('#AddAdSelectModel').html(html);
        }
    });
});

$("#photos").change(function() {

    // alert(this.files.length);
    $("#gallery-thumbnails").html("");
    for (var i = 0; i < this.files.length; i++) {

        var url = URL.createObjectURL(event.target.files[i]);
        var html = "<div class='photo-thumbnails w-25 d-inline-block p-1'><img src='" + url + "' alt='" + this.files[i]['name'] + "' class='img-thumbnail img-fluid p-1'></div>";
        $("#gallery-thumbnails").append(html);

        // alert(html);
    }
    // alert(URL.createObjectURL(event.target.files[0]));
    // console.log(event.target.files);
    // alert(t);

});

$("#filterForm").change(function() {

    // alert(event.target.name);

    switch (event.target.name) {
        case "search_option_poland":
            if (event.target.checked) {
                window.location.href = window.location.href + "&poland=1";
            } else {
                window.location.href = window.location.href.replace("&poland=1", "");
            }
            break;
        case "search_option_crashed":
            if (event.target.checked) {
                window.location.href = window.location.href + "&crashed=1";
            } else {
                window.location.href = window.location.href.replace("&crashed=1", "");
            }
            break;
        case "search_option_aso":
            if (event.target.checked) {
                window.location.href = window.location.href + "&ASO=1";
            } else {
                window.location.href = window.location.href.replace("&ASO=1", "");
            }
            break;
        case "search_option_UK":
            if (event.target.checked) {
                window.location.href = window.location.href + "&UK=1";
            } else {
                window.location.href = window.location.href.replace("&UK=1", "");
            }
            break;
        case "search_option_new_car":
            if (event.target.checked) {
                window.location.href = window.location.href + "&new=1";
            } else {
                window.location.href = window.location.href.replace("&new=1", "");
            }
            break;
        case "car_type":
            if (event.target.checked) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("type");
                var temp_url = window.location.href.replace("&type=" + val, "");
                window.location.href = temp_url + "&type=" + event.target.value;
            }
            break;
        case "fuel_type":
            if (event.target.checked) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("fuel");
                var temp_url = window.location.href.replace("&fuel=" + val, "");
                window.location.href = temp_url + "&fuel=" + event.target.value;
            }
            break;
        case "search_count_doors":
            // alert(event.target.value);
            if (event.target.value >= 0) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("countDoors");
                var temp_url = window.location.href.replace("&countDoors=" + val, "");
                window.location.href = temp_url + "&countDoors=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("countDoors");
                var temp_url = window.location.href.replace("&countDoors=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_color":
            // alert(event.target.value);
            if (event.target.value >= 0) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("color");
                var temp_url = window.location.href.replace("&color=" + val, "");
                window.location.href = temp_url + "&color=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("color");
                var temp_url = window.location.href.replace("&color=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_color_type":
            // alert(event.target.value);
            if (event.target.value >= 0) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("colorType");
                var temp_url = window.location.href.replace("&colorType=" + val, "");
                window.location.href = temp_url + "&colorType=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("colorType");
                var temp_url = window.location.href.replace("&colorType=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_gear":
            // alert(event.target.value);
            if (event.target.value >= 0) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("gear");
                var temp_url = window.location.href.replace("&gear=" + val, "");
                window.location.href = temp_url + "&gear=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("gear");
                var temp_url = window.location.href.replace("&gear=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_first_country":
            // alert(event.target.value);
            if (event.target.value >= 0) {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("country");
                var temp_url = window.location.href.replace("&country=" + val, "");
                window.location.href = temp_url + "&country=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("country");
                var temp_url = window.location.href.replace("&country=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_engine_capacity_from":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "" && event.target.value != "0") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("capacityFrom");
                var temp_url = window.location.href.replace("&capacityFrom=" + val, "");
                window.location.href = temp_url + "&capacityFrom=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("capacityFrom");
                var temp_url = window.location.href.replace("&capacityFrom=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_engine_capacity_from_to":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("capacityTo");
                var temp_url = window.location.href.replace("&capacityTo=" + val, "");
                window.location.href = temp_url + "&capacityTo=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("capacityTo");
                var temp_url = window.location.href.replace("&capacityTo=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_millage_from":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("millageFrom");
                var temp_url = window.location.href.replace("&millageFrom=" + val, "");
                window.location.href = temp_url + "&millageFrom=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("millageFrom");
                var temp_url = window.location.href.replace("&millageFrom=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_millage_from_to":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("millageFromTo");
                var temp_url = window.location.href.replace("&millageFromTo=" + val, "");
                window.location.href = temp_url + "&millageFromTo=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("millageFromTo");
                var temp_url = window.location.href.replace("&millageFromTo=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_power_from":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("powerFrom");
                var temp_url = window.location.href.replace("&powerFrom=" + val, "");
                window.location.href = temp_url + "&powerFrom=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("powerFrom");
                var temp_url = window.location.href.replace("&powerFrom=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_power_to":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("powerFromTo");
                var temp_url = window.location.href.replace("&powerFromTo=" + val, "");
                window.location.href = temp_url + "&powerFromTo=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("powerFromTo");
                var temp_url = window.location.href.replace("&powerFromTo=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_year_from":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("yearFrom");
                var temp_url = window.location.href.replace("&yearFrom=" + val, "");
                window.location.href = temp_url + "&yearFrom=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("yearFrom");
                var temp_url = window.location.href.replace("&yearFrom=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_year_to":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("yearFromTo");
                var temp_url = window.location.href.replace("&yearFromTo=" + val, "");
                window.location.href = temp_url + "&yearFromTo=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("yearFromTo");
                var temp_url = window.location.href.replace("&yearFromTo=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_price_from":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("priceFrom");
                var temp_url = window.location.href.replace("&priceFrom=" + val, "");
                window.location.href = temp_url + "&priceFrom=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("priceFrom");
                var temp_url = window.location.href.replace("&priceFrom=" + val, "");
                window.location.href = temp_url;
            }
            break;
        case "search_price_to":
            // alert(event.target.value);
            if (event.target.value > 0 && event.target.value != "") {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("priceFromTo");
                var temp_url = window.location.href.replace("&priceFromTo=" + val, "");
                window.location.href = temp_url + "&priceFromTo=" + event.target.value;
            } else {
                var url = new URL(window.location.href);
                var val = url.searchParams.get("priceFromTo");
                var temp_url = window.location.href.replace("&priceFromTo=" + val, "");
                window.location.href = temp_url;
            }
            break;


        default:
            // sort = 0;
            break;
    }
})

$("#clearBTN").click(function() {
    // alert(window.location.href);
    var urltxt = window.location.href;
    var url = new URL(window.location.href);
    var idmark = url.searchParams.get("id_mark");
    var idmodel = url.searchParams.get("id_model");
    var position = urltxt.indexOf("?");
    var new_url = urltxt.substr(0, position);
    new_url = new_url + "?id_mark=" + idmark;
    if (idmodel) {
        new_url = new_url + "&id_model=" + idmodel;
    }
    // alert(new_url);
    window.location.href = new_url;
    // alert(urltxt);
    // alert(new_url);
    // var new_url = url.substr(0, url.ndexOf("?"));
    // alert(url);
})

// alert("ID: " + event.target.id + " checked: " + event.target.checked + " value: " + event.target.value);
// alert(event.target.name);
// alert(event.target.id.parent);

// alert(window.location.href);
// window.location.replace = window.location.href + "&crashed=1";
// window.location.replace(window.location.href + "&crashed=1");
// var url_string = window.location.href; //window.location.href
// var url = new URL(url_string);
// var url = new URL(window.location.href);
// var val = url.searchParams.get("id_mark");
// var id_model = url.searchParams.get("id_model");
// alert(id_model);

// if (getURLParam("id_model") == "") {
//     var id_model = 0;
// } else {
//     var id_model = getURLParam("id_model");
// }

// $.ajax({
//     type: 'GET',
//     url: "apiGetHTMLAds.php",
//     dataType: 'html',
//     data: {
//         noCrashed: cr,
//         id_mark: id_mark,
//         id_model: id_model,
//     },
//     success: function(result) {
//         // alert(result);
//         $('#row_with_ads').html(result);

//     },
//     error: function(result) {
//         alert("Nie udalo sie");
//     }
// });

// alert(this.files.length);
// alert(URL.createObjectURL(event.target.files[0]));
// console.log(event.target.files);
// alert(event.target.id+" "+event.target.value);

// })