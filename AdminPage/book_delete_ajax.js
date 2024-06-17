function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function deleteBook() {
    const form = document.getElementById('deleteBookFormElement');
    const formData = new FormData(form);

    $.ajax({
        url: 'book_delete.php',
        method: 'DELETE',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response); 
            if (response.success) {
                $('#deleteBookMessage').html(response.message);
                form.reset();
            } else {
                $('#deleteBookMessage').html('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            $('#deleteBookMessage').html('Error: ' + status + ' ' + error);
        }
    });

}