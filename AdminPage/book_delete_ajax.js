function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}

function deleteBook() {
    const form = document.getElementById('bookId').value;
    const formData = new FormData(form);
 if(bookId){
    $.ajax({
        url: 'book_delete.php',
        method: 'POST',
        data: {bookId:bookId},
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