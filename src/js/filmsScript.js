//Used to
function showSection(section, id) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('section-content').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'filmInfo.php?section=' + section + '&id=' + id, true);
    xhr.send();
}
