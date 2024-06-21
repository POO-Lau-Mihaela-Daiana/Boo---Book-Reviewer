$(document).ready(function() {
    $('#searchButton').click(function() {
        var searchQuery = $('.search__input').val().trim();
        // window.location.href = '../SearchPage/searchPage.php?search=' + encodeURIComponent(searchQuery);
    });

    function fetchSearches() {
        var searchParams = new URLSearchParams(window.location.search);
        var searchQuery = searchParams.get('search');

        $.ajax({
            url: 'searching.php',
            method: 'POST',
            dataType: 'json',
            data: { search: searchQuery },
            success: function(response) {
                console.log(response); 
                if (response.success) {
                    displaySearches(response.search);
                } else {
                    console.error('Fetch searches error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

    fetchSearches();

    function displaySearches(searches) {
        var bookContainer = $('.book__container');
        bookContainer.empty();

        searches.forEach(function(book) {
            var bookHtml = `
                <div class="book__container__profile">
                    <img src="${book.book_photo_url}" alt="Book Cover" class="book__profile__image" />
                    <div class="book__info__container">
                        <div class="Book__name">
                            <a href="../book/index.php?book_id=${book.book_id}" class="Book__link"><p class="book__name">${book.book_title}</p></a>
                            <p>by ${book.book_author}</p>
                        </div>
                        <div class="description">${book.book_description}</div>
                    </div>
                </div>
            `;
            bookContainer.append(bookHtml);
        });
    }
});