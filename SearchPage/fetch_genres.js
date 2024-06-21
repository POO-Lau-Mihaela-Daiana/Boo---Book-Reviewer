$(document).ready(function() {
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
