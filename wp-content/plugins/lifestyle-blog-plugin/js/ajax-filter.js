jQuery(document).ready(function ($) {
    // Event listener for filter changes
    $('#filter-category, #filter-post-type').on('change', function () {
        // Capture selected values
        const category = $('#filter-category').val();
        const postType = $('#filter-post-type').val();

        // Debugging: Log selected values
        console.log('Selected Category:', category);
        console.log('Selected Post Type:', postType);

        // Perform AJAX request
        $.ajax({
            url: ajax_filter_params.ajax_url, // AJAX URL
            type: 'POST',
            data: {
                action: 'filter_posts', // WordPress action
                category: category, // Selected category
                post_type: postType, // Selected post type
            },
            beforeSend: function () {
                // Display loading message while fetching
                $('#posts-container').html('<p>Loading...</p>');
            },
            success: function (response) {
                // Update the posts container with new content
                $('#posts-container').html(response);

                // Debugging: Log the response for inspection
                console.log('AJAX Response:', response);
            },
            error: function (xhr, status, error) {
                // Handle and log errors
                console.error('AJAX Error:', error);
                $('#posts-container').html('<p>An error occurred. Please try again.</p>');
            },
        });
    });

    // Initial debug to confirm script loaded
    console.log('AJAX Filter initialized');
});
