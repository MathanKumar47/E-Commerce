$(document).ready(function () {
    // Handle "quick view" button click
    $('.quick-view').on('click', function () {
      var productId = $(this).data('product-id'); // Get the product ID from the data attribute
      // AJAX request to get the product details
      $.ajax({
        url: '/get_quick_view/' + productId, // Replace with your route to fetch product details
        method: 'GET',
        success: function (response) {
          $('#quickViewContent').html(response); // Populate the modal content with the product details
          $('#quickViewModal').modal('show'); // Show the modal
        },
        error: function (error) {
          console.log('Error fetching product details:', error);
        }
      });
    });
  });
  