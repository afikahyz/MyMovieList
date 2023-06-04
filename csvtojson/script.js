/*$(document).ready(function() {
    $.ajax({
        url: 'csvjson.json',
        dataType: 'json',
        success: function(data) {
            // Display the JSON data in the container element
            $('#jsonContainer').text(JSON.stringify(data, null, 2));
        },
        error: function(xhr, status, error) {
            console.log('An error occurred while loading the JSON file.');
        }
    });
});*/
$(document).ready(function() {
    // Display movie list on page load
    displayMovieList();
  
    // Perform search on keyup event
    $('#searchInput').on('keyup', function() {
      var searchValue = $(this).val().toLowerCase();
      filterMovies(searchValue);
    });
  
    // Handle movie selection
    $(document).on('click', '.movieItem', function() {
      var movieId = $(this).attr('data-id');
     insertMovieToDatabase(movieId);
     //deleteMovie(movieId);
    });
  
    // Display movie list
    function displayMovieList() {
      $.ajax({
        url: 'csvjson.json',
        dataType: 'json',
        success: function(data) {
          var movieList = $('#movieList');
          movieList.empty();
  
          if (data.length > 0) {
            $.each(data, function(index, movie) {
              var movieItem = $('<li>').addClass('movieItem').attr('data-id', movie.id).text(movie.title);
              movieList.append(movieItem);
            });
          } else {
            movieList.append('<li>No movies found.</li>');
          }
        },
        error: function() {
          console.log('Error loading movie data.');
        }
      });
    }
  
    // Filter movies based on search value
    function filterMovies(searchValue) {
      var movieItems = $('.movieItem');
  
      if (searchValue === '') {
        movieItems.show();
      } else {
        movieItems.hide();
        movieItems.filter(function() {
          return $(this).text().toLowerCase().indexOf(searchValue) > -1;
        }).show();
      }
    }
  
    // Insert selected movie into the database
   
    function insertMovieToDatabase(movieId) {
        $.ajax({
          url: 'insert_movie.php?id=' + movieId,
          method: 'GET',
          success: function(response) {
            console.log(response);
          },
          error: function() {}
        });
      }
      /*function deleteMovie(movieId) {
        $.ajax({
          url: 'delete_movie.php?id=' + movieId,
          method: 'GET',
          success: function(response) {
            console.log(response);
            console.log(movieId);
            console.log('Movie deleted from database.');
          },
          error: function(xhr, status, error) {
            console.log('Error delete movie from database: ' + error);
          }
        });
      }*/

  });
  