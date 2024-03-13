
$(document).ready(function() {
    // Attach submit event listener to the form
    $(document).on('submit', '#commentForm', function(e) {
        e.preventDefault(); // Prevent default form submission
        var formData = new FormData(this); // Reference to the current form
        var button = $(this).find('#submitComment'); // Find the submit button within the form

        $.ajax({
            url: '{{ route("comment") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success) {
                    comment = data.success
                    $('.msg').remove();
                    $('#commentForm textarea').val('');
                    button.closest('.point').after(`
                        <div class="msg my-2 bg-success text-center text-light">You just commented</div>
                    `);
                    var commentContainer = $('.idea-' + formData.get('idea_id'));

                    commentContainer.prepend(`
                        <hr>
                        <div class="d-flex align-items-start" style="margin-left:15px;">
                            <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                                src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi"
                                alt="Luigi Avatar">
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="">${comment.user_id}</h6>
                                    <small class="fs-6 fw-light text-muted">Just now</small>
                                </div>
                                <p class="fs-6 mt-3 fw-light">${comment.comment}</p>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <a href="#" class="fw-light text-decoration-none fs-6">
                                            <span class="fas fa-heart"></span> 100
                                        </a>
                                        <a href="#" class="fw-light text-decoration-none me-1 fs-6">
                                            <span class="fas fa-thumbs-down"></span> 20
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                } else {
                    $('.msg').remove();
                    button.closest('.point').after(`
                        <div class="msg my-2 bg-info text-center text-light">${errorMessage}</div>
                    `);
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = JSON.parse(xhr.responseText).errors;
                $('.msg').remove();
                button.closest('.point').after(`
                    <div class="msg my-2 bg-info text-center text-light">${errorMessage}</div>
                `);
            }
        });
    });
});


function like(event) {
    var idea_id = $(event.target).data('value');
    var url = $(event.target).data('url');
    var like_counter = $(event.target).closest('.card').find('.like-counter');
    var currentCount = parseInt(like_counter.text());

    $.ajax({
        url: url,
        type: 'POST',
        data: { 'like': true, 'idea_id': idea_id },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Get CSRF token from meta tag
        },
        success: function(data) {
            if (data.success) {
                var like = data.success;
                if (like == "created") {
                    $(event.target).addClass('text-danger');
                    var increase = currentCount + 1
                    like_counter.text(increase);
                } else if (like == 'deleted') {
                    $(event.target).removeClass('text-danger');
                    currentCount = Math.max(0, currentCount - 1);
                    like_counter.text(currentCount);
                }
            } else {
                alert('Something went wrong');
            }
        },
        error: function(xhr, status, error) {
            var errorMessage = JSON.parse(xhr.responseText).errors;
            alert('Error: ' + errorMessage);
        }
    });
}



