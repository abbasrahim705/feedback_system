
function feedbackSubmit(){
    var feedbackData = {
        feedback: $('#feedback').val(),
        _token: $('[name="_token"]').val()
    };

    $.ajax({
        type: 'POST',
        url: '/feedbacks/send',
        data: feedbackData,
        success: function(response) {
            // alert('Feedback submitted successfully!');
            // alert(json_decode(response[2]));
            $('#newlyAddedFeedback').html(response.feedback);
            $('#message').removeClass('d-none');
            $('#message span').html(response.message);
            $('#feedback').val('');
        },
        error: function(xhr, status, error) {
            console.error('Error submitting feedback:', error);
            // alert('Error submitting feedback. Please try again later.');
        }

    });

    setTimeout(() => {
        $('.btn-close').click();
    }, 5000);
}

function commentSubmit($commentId){
    console.log()
    var feedbackData = {
        feedback_id: $('#feedback_id').val(),
        description: $('[name="description'+$commentId+'"]').val(),
        _token: $('[name="_token"]').val()
    };

    $.ajax({
        type: 'POST',
        url: '/comments/send',
        data: feedbackData,
        success: function(response) {

            $('#newlyAddedFeedback').html(response.comment);
            $('#message').removeClass('d-none');
            $('#message span').html(response.message);
            $('[name="description'+$commentId+'"]').val('');
        },
        error: function(xhr, status, error) {
            console.error('Error submitting feedback:', error);
            // alert('Error submitting feedback. Please try again later.');
        }

    });

    setTimeout(() => {
        $('.btn-close').click();
    }, 5000);
}

$(document).ready(function() {
    $('textarea[id^="description"]').on('input', function() {
        var textareaId = $(this).attr('id');
        var text = $(this).val();
        var matches = text.match(/@(\w+)/g);
        var searchTerm = matches ? matches[matches.length - 1].substring(1) : '';

        if (searchTerm.length > 0) {
            $.ajax({
                url: '/users/search',
                method: 'GET',
                data: { q: searchTerm },
                success: function(response) {
                    displayUserSuggestions(textareaId, response);
                }
            });
        } else {
            $('#user-suggestions' + textareaId).empty();
        }
    });
});

function displayUserSuggestions(textareaId, users) {
    var suggestionsHtml = '';
    users.forEach(function(user) {
        suggestionsHtml += '<div>' + user.name + '</div>';
    });
    // console.log(suggestionsHtml);
    // console.log($('#user-suggestions' + textareaId).html(suggestionsHtml));
    $(suggestionsHtml).appendTo($('#user-suggestions' + textareaId));
    console.log($(suggestionsHtml).appendTo($('#user-suggestions' + textareaId)));
    // $('#user-suggestions' + textareaId).html(suggestionsHtml);
}



