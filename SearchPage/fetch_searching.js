$(document).ready(function() {

    function getQueryParam(param) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    var searchQuery = getQueryParam('search') || '';
    var userId = getQueryParam('user_id') || '';

    $('#searchButton').click(function() {
        searchQuery = $('.search__input').val().trim();
        window.location.href = `../SearchPage/searchPage.php?user_id=${encodeURIComponent(userId)}&search=${encodeURIComponent(searchQuery)}`;
    });

    $('.button_form').click(function(event) {
        event.preventDefault(); 

        var selectedGenre = $('input[name="genre"]:checked').val(); 
       
        if (!selectedGenre) {
            alert('Please select a genre.');
            return; 
        }

        var encodedSearchQuery = encodeURIComponent(searchQuery);
        var redirectUrl = `../SearchPage/searchPage.php?user_id=${encodeURIComponent(userId)}&search=${encodedSearchQuery}&genre=${selectedGenre}`;
        window.location.href = redirectUrl;
    });
    
    function fetchSearches() {
        var searchParams = new URLSearchParams(window.location.search);
        var searchQuery = searchParams.get('search');
        var genre = searchParams.get('genre');

        $.ajax({
            url: 'searching.php',
            method: 'POST',
            dataType: 'json',
            data: { search: searchQuery,
                genre: genre
             },
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

    fetchGenres();

    function fetchGenres() {
        $.ajax({
            url: 'genres.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response); 
                
                if (response.success) {
                    displayGenres(response.genre);
                } else {
                    console.error('Fetch comments error: ' + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' ' + error);
            }
        });
    }

    function displayGenres(genre) {
        var genreContainer = document.querySelector('.genre__total__list');
        genreContainer.innerHTML = '';

        genre.forEach(function(genre) {
            var genreHtml = `
                <label class="genre_list">
                    <input type="radio" name="genre" value="${genre.genre_id}" required />
                    ${genre.genre_name}
                </label>
            `;
            genreContainer.insertAdjacentHTML('beforeend', genreHtml);
            
        });
    }

});