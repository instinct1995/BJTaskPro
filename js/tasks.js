"use strict";
$(function() {
	
	$("#createTasksForm").submit(function(e){
			
			var url_ = window.location.pathname;
			var pole1 = $('#name_').val();
			var pole2 = $('#email_').val();
			var pole3 = $('#task_name_').val();
			
			var has_ = $('#name_').attr('aria-invalid');
			var has1_ = $('#email_').attr('aria-invalid');
			var has2_ = $('#task_name_').attr('aria-invalid');
			$.ajax({
            type: 'POST',
            url: url_,
            data: $(this).serialize()
			}).done (function()
			{
				if (has_ == 'false' && has1_ == 'false' && has2_ == 'false' && pole1!='' && pole2!='' && pole3!='')
				{
					if (url_.includes("update"))
						$('.js-overlay-thank-you1').fadeIn();
					if (url_.includes("create"))
						$('.js-overlay-thank-you').fadeIn();
					$(this).find('input').val('');
					$('#form').trigger('reset');
				}
				else if (has1_=='true')
				{
					alert ("Email не валиден!");
				}
			});
			return false;
});
	
	
$('.js-close-thank-you').click(function() {
	$('.js-overlay-thank-you').fadeOut();
});

$('.js-close-thank-you1').click(function() {
	$('.js-overlay-thank-you1').fadeOut();
});

$(document).mouseup(function (e) {
    var popup = $('.popup');
    if (e.target!=popup[0]&&popup.has(e.target).length === 0){
        $('.js-overlay-thank-you').fadeOut();
        $('.js-overlay-thank-you1').fadeOut();
    }
});
	
	
	settingTasks();

	$( "#typeTasks").on('change','#taskStatus',function () {
	    const type_tasks = $(this).val();
	    $.ajax({
	        url: "/filter",
	        type: "POST",
	        dataType: "json",
	        data: { type_tasks: type_tasks },
	        success: function( data ) {

	        	$("#paginationTasks").html( data.pagination );
	        	$("#tableTasks").html( data.table );
	        	if (data['count'] == 0) {
	        		$("#limitTasks").prop('disabled',true);
	        	} else {
	        		$("#limitTasks").prop('disabled',false);
	        	}
				localStorageSet({pageTasks:'1',statusTasks: type_tasks});
	        },
	        error: function( data ) {
	            console.log('error   ', data);
	        }
	    });

	})

	$( "#tableTasks" ).on('change','.task-status',function () {
	    const type_tasks = $(this).val();
	    const id = $(this).parent().parent()[0].id.substring(7);
	    $.ajax({
	        url: '/updates',
	        type: "POST",
	        data: ({  id: 		  id,
	                  type_tasks: type_tasks
	        }),
	        success: function( data ) {
	          	const type = $("#taskStatus").val();
	          	if ( type != -1 ) {
	        		$("#paginationTasks").html( data.pagination );
	        		$("#tableTasks").html( data.table );
	          	} else {
	            	const self = $("#tasksId"+id);
	            	hasRemoveClass(self,+type_tasks)
	          	}     
	        },
	        error: function( data ) {
	            console.log( 'error   ',data );

	        }
		});

	});

	$('[data-toggle="popover"]').popover({ trigger: 'hover' });
	$('[data-toggle="tooltip"]').tooltip();

	$("#createTasksForm input, #createTasksForm textarea").jqBootstrapValidation({
    	preventSubmit: true,
    	submitError: function( $form, event, errors ) {
    	},
    	submitSuccess: function( $form, event ) {
    	},
	});

	$("#loginFormTasks input").jqBootstrapValidation({
    	preventSubmit: true,
    	submitError: function( $form, event, errors ) {
    	},
    	submitSuccess: function( $form, event ) {
    	},
	});

 	$('#modalDocumentsRight').on('show.bs.modal', function( e ) {
        modalAnimation('modalDocumentsRight', 'fadeInLeft', 'modal-right');
    });
    $('#modalDocumentsRight').on('hide.bs.modal', function( e ) {
        modalAnimation('modalDocumentsRight', 'fadeInLeftClose', 'modal-right');
    });
 	$('#modalDocumentsLeft').on('show.bs.modal', function( e ) {
        modalAnimation('modalDocumentsLeft', 'fadeInRight', 'modal-left');
    });
    $('#modalDocumentsLeft').on('hide.bs.modal', function( e ) {
        modalAnimation('modalDocumentsLeft', 'fadeInRightClose', 'modal-left');
    });


	$("#limitTasks").change(function () {
	    const limit = $(this).val();
	    $.ajax({
	        url: "/limit",
	        type: "POST",
	        dataType: "json",
	        data: { limit: limit },
	        success: function( data ) {
	       		$("#paginationTasks").html( data.pagination );
	        	$("#tableTasks").html( data.table );
				localStorageSet({ pageTasks: '1', limitTasks: limit });
	        },
	        error: function( data ) {
	            console.log( 'error   ',data );
	        }
	    });

	});
});

function hasRemoveClass ( self, classIndex ) {
    const classArrey = ["bg-info","bg-success","bg-warning",'',"bg-danger"];
    for (var i = 0; i < classArrey.length; i++) {
      	if( i == classIndex && classIndex != 3 ) {
        	if (!self.hasClass(classArrey[i])) 
          		self.addClass(classArrey[i]);
      	} else {
        	if (self.hasClass(classArrey[i])) 
          		self.removeClass(classArrey[i]);
      	}
    }
}

function notepadView( self ) {
    const name =  $(self).parent().siblings()[0].textContent;
    const taskName =  $(self).parent().siblings()[2].textContent;
    const id = $(self).parent().parent()[0].id.substring(7);
    const text = $(self).parent().siblings().last()[0].textContent;
    $("#modalTextarea").data( "id",id );
    $("#modalNotepadTitleId").html( name +'<br>'+taskName );
    $("#modalTextarea").val( text );
    $("#modalNotepadId").modal( "show" ); 
 }

function saveNotepad() {
    const id = $("#modalTextarea").data("id");
    const notepad = $("#modalTextarea")[0].value;
    $("#tasksId"+id).children().last()[0].textContent = notepad;
    const self = $("#tasksId"+id).children()[4].children[0].children[0];
    $.ajax({
        url: '/updaten',
        type: "POST",
        data: ({ id: 	  id,
                 notepad: notepad 
        }),
        success: function( data ) {
			if (notepad.trim()) {
			    if ($(self).hasClass("fa-file"))
				    $(self).removeClass("fa-file");
			    $(self).addClass("fa-file-text");
			} else {
			    if ($(self).hasClass("fa-file-text"))
			    	$(self).removeClass("fa-file-text");
			    $(self).addClass("fa-file");
			}
        },
        error: function( data ) {
            console.log( 'error   ', data );
        },
        complete: function() {
          $("#modalNotepadId").modal( "hide" );  
        }  
	});
}

function modalAnimation( id, animation, modal ) {
    modal = modal ? modal : 'modal-left';
    $('#' + id + '.modal .modal-dialog')
     .attr('class', 'modal-dialog ' + modal + ' ' + animation + '  animated');
};

function paginationClick( e, page ) {
    e.preventDefault();
    $.ajax({
        url: '/page',
        type: "POST",
        dataType: 'json',
        data: { page: page },
        success: function( data ) {
       		$("#paginationTasks").html( data.pagination );
        	$("#tableTasks").html( data.table );
			localStorageSet({ pageTasks: page });
        },
        error: function( data ) {
            console.log( 'error   ',data );
        }
	});
}

function orderClick( e, field ) {
	let order;
    e.preventDefault();
	if ( !localStorage.getItem( 'fieldTasks' ) || localStorage.getItem( 'fieldTasks' ) != field ) {
		order = 'ASC';	
	} else {
		if (localStorage.getItem( 'orderTasks' ) == 'ASC' ) {
			order = 'DESC';
		} else {
			order = 'ASC';
		}
	} 
    $.ajax({
        url: '/order',
        type: "POST",
        dataType: 'json',
        data: { field: field },
        success: function( data ) {
       		$("#paginationTasks").html( data.pagination );
        	$("#tableTasks").html( data.table );
			localStorageSet({ pageTasks: '1', fieldTasks: field, orderTasks: order});
        },
        error: function( data ) {
            console.log( 'error   ',data );
        }
	});
}

function settingTasks() {
	const limit  = localStorage.getItem( 'limitTasks' )  ? localStorage.getItem('limitTasks' )  : '3';
	const page   = localStorage.getItem( 'pageTasks' )   ? localStorage.getItem('pageTasks' )   : '1';
	const field  = localStorage.getItem( 'fieldTasks' )  ? localStorage.getItem('fieldTasks' )  : 'id';
	const order  = localStorage.getItem( 'orderTasks' )  ? localStorage.getItem('orderTasks' )  : 'DESC';

    let status = 0;
    if (localStorage.getItem('statusTasks') == null) {
        status = -2;
    } else {
        status = localStorage.getItem('statusTasks');
    }
    if (window.location.href == document.referrer) {
		localStorageSet({ statusTasks: '-2'});
		status = -2;
    }   
	if(window.location.pathname =='/tasks/create' ) {
		localStorageSet({ statusTasks: '-2', pageTasks: '1', fieldTasks: 'id', orderTasks: 'DESC'});
	}
	else {
		if ($("#limitTasks").val() != undefined ) {
			$( "#limitTasks").val( limit );
			$( "#taskStatus").val( status );
		}
	}	
	if(window.location.pathname =='/') {
	    $.ajax({
	        url: '/setting',
	        type: "POST",
	        dataType: 'text',
	        data: ({ limit:  limit,
	         		 page:   page,
	         		 field:  field,
	         		 status: status,	
	         		 order:  order	
	        }),
	        error: function( data ) {
	            console.log( 'error   ',data );
	        }
		});
	}
}

function localStorageSet(params) {
	for(var key in params) { 
		localStorage.setItem( key, params[key] );
	}
}
