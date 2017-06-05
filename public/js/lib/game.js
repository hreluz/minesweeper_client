$(document).ready(function(){
	var token = '';
	let my_alert = new Alert('#notifications');

	//When user selects a level
	$(document).on('click', '.start_game', function(e){
		e.preventDefault();

		let that = $(this);
		let level = that.data('level');
		let xy_mines = get_coordinates_and_mines(level);

		$('#minesweeper-x').val(xy_mines.x);
		$('#minesweeper-y').val(xy_mines.y);
		$('#minesweeper-mines').val(xy_mines.mines);

        var form = $('#form-get-minesweeper');
        var url =  form.attr('action');
        var data = form.serialize();

		get_minesweeper(url,data);

	});
	
	$(document).on("contextmenu", ".cell_click", function(e){
		e.preventDefault();
		let that = $(this);
		let flag = that.data('flag');

		if(flag){
			that.data('flag', false);
			that.removeClass('flag');
		}else{
			that.data('flag', true);
			that.addClass('flag');
		}
	});

	$(document).on('click', '.cell_click', function(e){
		e.preventDefault();
		let that = $(this);
		let flag = that.data('flag');

		if(flag){
			return true;
		}

		let x = that.data('x');
		let y = that.data('y');

		$('#x').val(x);
		$('#y').val(y);
		$('#token').val(token);

        var form = $('#form-select-coordinate');
        var url =  form.attr('action');
        var data = form.serialize();

		$.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(response) {
            	grid_update(response);
            	game_actions(response);
            },
            error: function(response) {
            	if(response.status == 500){
					my_alert.error('Server Run out of memory. Please enter more number of mines',4000);
            	}else{
	                $.each(response.responseJSON, function (key, value) {
	                    my_alert.error(value);
	                });            		
            	}
            }
        }); 
	});


	function get_coordinates_and_mines(level)
	{
		let x = 0;
		let y = 0;
		let mines = 0;

		if(level == 'beginner'){
			x = 10;
			y = 6;
			mines = 5;
		}else if(level == 'intermediate'){
			x = 15;
			y = 9;
			mines = 15;
		}else if(level == 'advanced'){
			x = 23;
			y = 23;
			mines = 25;
		}else{
			x = $('#number_rows').val();
			y = $('#number_columns').val();
			mines = $('#number_mines').val();

			//Clean inputs
			$('#number_rows').val('');
			$('#number_columns').val('');
			$('#number_mines').val('');

			$('#myModal').modal('hide');
		}

		return { 'x': x , 'y': y, 'mines': mines };
	}

	function get_minesweeper(url, data)
	{
		$.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(response) {
            	if(response.result)
            	{
            		$('#minesweeper_grid').html(response.html);
            		token = response.token;
            	}
            },
            error: function(response) {
                //$.each(response.responseJSON, function (key, value) {
                //    alert_custom.error(value);
                // });
            }
        }); 
	}

	function grid_update(response)
	{
		let grid = response.grid;

		$.each(grid, function( x, g ) {
			$.each(g, function( y, value ) {
				let cell = $('#x'+x+'y'+y);

				cell.removeClass('locked');
				cell.removeClass('cell_click');
				cell.addClass('cell_value');

				if(value == 0){
					value = '&nbsp';
				}else if(value == -1){
					value = '<span class="mine">*</span>';
				}

				cell.html(value);
			});
		});
	}

	function game_actions(response)
	{
		let status  = '';
		let status_class =''

    	if(response.is_finished && response.success_game){
    		status = "YOU WIN ! ";
    		status_class = 'alert-success';
    	}else if(!response.is_finished && !response.success_game) {
    		status = "Keep Playing ...";
    		status_class = 'alert-info';
    	}else{
    		status = "Game Over !!  xO";
    		status_class = 'alert-danger';    		
    	}

    	$('#status_game').removeClass();
    	$('#status_game').addClass(status_class);
    	$('#status_game').html(status);
	}

	$(document).ajaxStart(function () {
    	$(document.body).css({ 'cursor': 'wait' })
	});

	$(document).ajaxComplete(function () {
	    $(document.body).css({ 'cursor': 'default' })
	});

});