
function ucitajSelect(putanja, elementId, pocetnaVrednost = undefined) {
    $.getJSON(putanja, function (res) {
        if (!res.status) {
            alert(res.error);
            return;
        }
        $('#' + elementId).html('');
        for (let element of res.data) {
            $('#' + elementId).append(`
                <option value='${element.id}'>
                    ${element.naziv}
                </option>
            `)
        }
        if (pocetnaVrednost) {
            $('#' + elementId).val(pocetnaVrednost);
        }
    })
}

function ucitajUTabelu(putanja, elementId, rowRenderer) {

    $.getJSON(putanja, function (res) {
        if (!res.status) {
            alert(res.error);
            return;
        }
        $('#' + elementId).html('');
        for (let element of res.data) {
            $('#' + elementId).append(rowRenderer(element))
        }
        return res.data;
    })

}