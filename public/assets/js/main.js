// L'ajax pour soumettre la formulaire de commentaire

 $(function() {
            $('#comment-form').submit(function(e) {
                e.preventDefault();
                $('#comment-form button[type="submit"]').prop('disabled', true);
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: commentPath.replace('postId', postId),
                    data: formData + '&post_id=' + postId,
                    success: function(response) {
						$('div#error-messages').hide();
						$('div#success-messages').hide();
						var parser = new DOMParser();
						var htmlDoc = parser.parseFromString(response, 'text/html');
						var ulElement = htmlDoc.querySelector('#comment-form ul li');
						var errorElement = ulElement ? ulElement.textContent : '';
						console.log(errorElement);
    					if (errorElement != '') {
							$('div#error-messages').show();
							$('#error-messages').html(errorElement);
						}else{
							$('div#success-messages').html('Success! votre commentaire est bien ajouté');
							$('div#success-messages').show();
						}
                        var commentsHtml = $(response).find('#comment-list').html();
                        $('#comment-form button[type="submit"]').prop('disabled', false);
                        $('#comment-list').html(commentsHtml);
                        $('#comment-form')[0].reset();
						
                    },
                });
            });
});


(function($) {

	var	$window = $(window),
		$body = $('body'),
		$wrapper = $('#page-wrapper'),
		$banner = $('#banner'),
		$header = $('#header');

	// Breakpoints.
		breakpoints({
			xlarge:   [ '1281px',  '1680px' ],
			large:    [ '981px',   '1280px' ],
			medium:   [ '737px',   '980px'  ],
			small:    [ '481px',   '736px'  ],
			xsmall:   [ null,      '480px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});

	// Mobile?
		if (browser.mobile)
			$body.addClass('is-mobile');
		else {

			breakpoints.on('>medium', function() {
				$body.removeClass('is-mobile');
			});

			breakpoints.on('<=medium', function() {
				$body.addClass('is-mobile');
			});

		}

	// Scrolly.
		$('.scrolly')
			.scrolly({
				speed: 1500,
				offset: $header.outerHeight()
			});

	// Menu.
		$('#menu')
			.append('<a href="#menu" class="close"></a>')
			.appendTo($body)
			.panel({
				delay: 500,
				hideOnClick: true,
				hideOnSwipe: true,
				resetScroll: true,
				resetForms: true,
				side: 'right',
				target: $body,
				visibleClass: 'is-menu-visible'
			});

	// Header.
		if ($banner.length > 0
		&&	$header.hasClass('alt')) {

			$window.on('resize', function() { $window.trigger('scroll'); });

			$banner.scrollex({
				bottom:		$header.outerHeight() + 1,
				terminate:	function() { $header.removeClass('alt'); },
				enter:		function() { $header.addClass('alt'); },
				leave:		function() { $header.removeClass('alt'); }
			});

		}

})(jQuery);