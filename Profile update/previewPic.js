function showpreview(file) {

    if (file.files && file.files[0])
     {
        var reader = new FileReader();
        reader.onload = function (ev) {
            $('#prev').attr('src', ev.target.result);
        }
        reader.readAsDataURL(file.files[0]);
    }

}

