//setting the amount of pixels for re-positioning of divs.
var min = '-250px',
	max = '0px';

$(function() {
	/**==========================================================================
	   SIDE NAV 
	 ========================================================================**/

	$('.arrow-toggle').click(function() {
		//toggles sidenav in and out
		if ($('.row-fluid').css('marginLeft') == max) { //checking if right
			$('.row-fluid').animate({marginLeft: min}); //move left
			
			$('#arrow-left').hide();
			$('#arrow-right').show();
		} else {
			$('.row-fluid').animate({marginLeft: max}); //move right
			$('#arrow-left').show();
			$('#arrow-right').hide();
		}

	});

	 /**=======================================================================
	 	LINK BOARD -- SCROLL
	 ====================================================================***/
		
		
		$('#nArrow').click(function() {
			$('.col').animate({scrollLeft : '+=250'}, 300);
		});

		$('#pArrow').click(function(){
			$('.col').animate({scrollLeft : '-=250px'}, 300);
		});

		//use left and right arrows to scroll left and right
		$(document).keydown(function(e) {
			switch(e.which) {
				case 37: //left
					$('.col').animate({scrollLeft : '-=250'}, 300);
				break;

				case 39: //right
					$('.col').animate({scrollLeft : '+=250'}, 300);
				break;

				default: return;
			}

			e.preventDefault();
		});

	//make arrows fade in on out on mouseenter and leave
	$('.r2').mouseenter(function(){
		$('#link-arrows').fadeIn();
	});

	$('.r2').mouseleave(function (){
		$('#link-arrows').fadeOut();
	});

	//trying to check and hide arrow when there are less than 12 items
	// in the div
	if ($('#salesLinks ul.col').children().length <= 12) {
		$('#link-arrows').hide();
	}

 /***===================================================================
     ADD LINK // MODAL FORM // $.ajax()
  =================================================================**/

$('#alForm').on('submit', function(event) {

		event.preventDefault();

		$.ajax({
			type : "POST",
			url  : "src/add.php",
			data: $('#alForm').serialize(),
			cache : true,

			beforeSend: function() {
				$('#loading').fadeIn();
			},

			success: function() {
			$('#success').fadeIn(function() {
				$(this).fadeOut(2000);
			});
			},

			error: function() {
				$('#fail').fadeIn(function() {
					$(this).fadeOut(2000);
				});
			}
			
		}).complete(function(data) {	
			console.log(data);
			$('#alForm').validate();
			$('#loading').hide();

		  //page reload after 2 seconds.
		  //makes sure message is received by the user.
		  setTimeout(function() {
			window.location.reload(true);
		}, 500);
		
		});
	
	
	});

/***================================================================
    DELETE LINK
***=============================================================***/
$('.delete').click(function() {
	var ansDel = confirm("Are you sure you want to delete link? You can't undo this.");

	if (!ansDel) {
		console.log("Process cancelled");
		$('a.delete').removeAttr('href'); //prevents the link from being deleted.
		
	} else {

		var del_link = $(this).attr('id');

		$.ajax({
			type : 'GET',
			url : 'src/delete.php',
			//data: {action: 'deleteLink'},
			data : 'id='+del_link,
			success: function() {
				alert("Link has been deleted!");
			}
		}).complete(function(data){
			console.log(data);
			setTimeout(function() {
				window.location.reload(true);
			}, 1000); 
		});

		console.log("Link deleted");
	}
});



});