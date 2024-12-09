jQuery(document).ready(function ($) {
    // Event listener for filter changes
    $('#filter-category, #filter-post-type').on('change', function () {
        const category = $('#filter-category').val();
        const postType = $('#filter-post-type').val();

        // AJAX request
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_posts',
                category,
                post_type: postType,
            },
            beforeSend: () => $('#posts-container').html('<p>Loading...</p>'),
            success: (response) => $('#posts-container').html(response),
            error: () => $('#posts-container').html('<p>An error occurred. Please try again.</p>'),
        });
    });

    console.log('AJAX Filter initialized');
});
