function getSelects(selects, className, formType) {
    var result = "";
    selects.forEach(select =>
    {
        result += "<select class=\"" + className + "\" onchange=\"loadCategories(this.value, '" + className + "', '" + formType + "')\">";
        select.options.forEach(option =>
        {
            result += "<option value=\"" + option.id + "\" " + (option.id == select.value ? "selected" : "") + ">" + option.name + "</option>";
        });
        result += "</select>";
    });
    return result;
}

function loadCategories(categoryId, className, formType) {    
    const xhttp = new XMLHttpRequest();
    let prefix = formType == "user" ? "site_form" : "admin_site_form"
    xhttp.onload = function () {
        document.getElementById("categories").innerHTML = getSelects(JSON.parse(this.responseText), className, formType);
        document.querySelector('#categories select:last-child').setAttribute("Name", prefix + "[categoryId]");
        document.querySelector('#categories select:last-child').setAttribute("Id", prefix + "_categoryId")
    }
    xhttp.open("GET", "/api/categories/options/" + categoryId);
    xhttp.send();
}