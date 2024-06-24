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
            const resultDiv = $('#updateResultBook');
            response = JSON.parse(response); 
            if (response.success) {
                resultDiv.html('<p style="color: green;">' + response.message + '</p>');
                form.reset();
            } else {
                resultDiv.html('<p style="color: red;">' + response.error + '</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:' + status + ' ' + error);
            $('#deleteResultBook').html('<p style="color: red;">An error occurred during the delete process. Please try again.</p>');
        }
    });

}