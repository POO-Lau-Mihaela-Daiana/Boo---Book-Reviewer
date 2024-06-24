function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function deleteComment() {
    const form = document.getElementById('deleteCommentElement'); 
    const formData = new FormData(form);

    $.ajax({
        url: 'delete_comment.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            const resultDiv = $('#deleteResultComment');
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
            $('#deleteResultComment').html('<p style="color: red;">An error occurred during the delete process. Please try again.</p>');
        }
    });
}