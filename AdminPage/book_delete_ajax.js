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

    if (formData.get('book_id')) {
        $.ajax({
            url: 'book_delete.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const resultDiv = $('#deleteResult');
                try {
                    response = JSON.parse(response);

                    if (response.success) {
                        resultDiv.html('<p style="color: green;">' + response.message + '</p>');
                        form.reset();
                    } else {
                        resultDiv.html('<p style="color: red;">' + response.error + '</p>');
                    }
                } catch (e) {
                    resultDiv.html('<p style="color: red;">Invalid server response.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:' + status + ' ' + error);
                $('#deleteResult').html('<p style="color: red;">An error occurred during the delete process. Please try again.</p>');
            }
        });
    } else {
        alert('Please enter a book ID.');
    }
}
