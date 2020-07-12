function showpreview(file,id) {
    if (file.files && file.files[0])
     {
        var reader = new FileReader();
        reader.onload = function (ev) {
            $(`#${id}`).css('background-image', `url(${ev.target.result})`);
        }
        reader.readAsDataURL(file.files[0]);
    }
}

