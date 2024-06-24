function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function submitForm() {
    const form = document.getElementById('updateBookFormElement');
    const formData = new FormData(form);
   
    if (formData.get('book_id')) {
        $.ajax({
            url: 'book_update.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const resultDiv = $('#updateResult');
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
                $('#updateResult').html('<p style="color: red;">An error occurred during the update process. Please try again.</p>');
            }
        });
    } else {
        alert('Please enter a book ID.');
    }
}