function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function deleteBook() {
    const form = document.getElementById('deleteBookFormElement').value;
    const formData = new FormData(form);
   
 if(formData){
    $.ajax({
        url: 'book_delete.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response); 
            if (response.success) {
               alert('Book deleted from data base');
                form.reset();
            } else {
                alert('Error:' +response.error);
            }
        },
        error: function(xhr, status, error) {
          console.error('Ajax error:'+status+' '+error);
        }
    });

 } else {
        alert('Please enter a book ID.');
    }
   
}