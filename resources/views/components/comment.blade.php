@props(['book'])

<script>
    // comments box
    function comments() {
        $.ajax({
            type: 'GET',
            url: '{{ route('showComment', $book->id) }}',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                data.book = data.book.reverse()
                if (data.book.length != 0) {
                    $('#comments').addClass('commentClicked');
                    let commentList = "";
                    $.each(data.book, function(key, value) {
                        commentList +=
                            `<p class="animate__animated animate__fadeIn"><strong>${value.user.name}</strong>: ${value.content}</p>`
                    })
                    $('#comments').html(commentList)
                }
            }
        })
    }
    comments()

    $("#addComment").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('addComment', $book) }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                comment: $('#comment').val()
            },
            cache: false,
            success: function(response) {
                comments();

                $('#comment').val("")
            },
        })
    })
    // comment box end
</script>
