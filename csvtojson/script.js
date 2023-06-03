$(document).ready(function() {
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
});