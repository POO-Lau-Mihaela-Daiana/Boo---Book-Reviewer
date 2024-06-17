function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function addBook() {
    const form = document.getElementById('addBookFormElement');
    const formData = new FormData(form);

    $.ajax({
        url: 'book_add.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response); 
            if (response.success) {
                $('#addBookMessage').html(response.message);
                form.reset();
            } else {
                $('#addBookMessage').html('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            $('#addBookMessage').html('Error: ' + status + ' ' + error);
        }
    });

}