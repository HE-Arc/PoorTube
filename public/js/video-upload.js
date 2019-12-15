// Display the name of the file when selected
const fileInput = document.querySelector('#file input[type=file]');
fileInput.onchange = () => {
    if (fileInput.files.length > 0) {
        const fileName = document.querySelector('#file .file-name');
        fileName.textContent = fileInput.files[0].name;
    }
}

// Progress bar
(function() {

var bar = document.getElementById("bar");

$('form').ajaxForm({
    beforeSend: function() {
        var posterValue = $('input[name=video]').fieldValue();
        bar.style = "display:online";
        bar.value = 0;
    },
    uploadProgress: function(event, position, total, percentComplete) {
        bar.value = percentComplete;
    },
    success: function() {
        bar.value = 100;
    },
    complete: function(xhr) {
        window.location.href = "/videos";
    }
});

})();
