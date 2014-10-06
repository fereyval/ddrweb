		$('.page-slide').click(function(event) {
			if( !$('body').hasClass('small-device') )
			{
				$('.page-slide').removeClass('active');
				event.preventDefault();

				var liSlideDestination = $(this).attr('data-rel');
				$(".slides-wrapper").moveTo(liSlideDestination);
				$(this).addClass('active');
			}
		});