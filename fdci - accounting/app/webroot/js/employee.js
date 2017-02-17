

var timePicker;
var selectedIndex = 0;
var rightClicked = false;
var timer = null;
var hot = null;
var advancedData = [];
var currentSelectedRow  = -1;
var myRole = null;

$(document).ready(function () {

	var selected_row = null;
	var selected_cell = null;
	var dropdownIndex = 0;
	var names = [];
	var positionLevelDropdown = null;

	var lastSelectedIndex = -1;

	var searchValue = "";
	var companies = [];
	var positions = [];
	var positionLevels = [];
	var roles = [];
	fillDropDown();
	
	var clicked = false;

	function ViewEmployee() {
		selectedIndex = hot.getSelectedRange().to.row;
		$("#btn-view-profile").attr('href',baseUrl+myRole+'/employees/profile/'+advancedData[selectedIndex].profile_id);
		$("#txt-errors").html("");
		$("#edit-last-timein").html('Edit');
		$("#edit-last-timeout").html('Edit');
		$("#btn-submit").val('Edit');
		$("#additional-info-container #txt-errors").html("");
		$("#lbl-employee").html('Name : '+advancedData[selectedIndex].name);
		$("#additional-info-container input").attr('disabled','disabled');
		$("#additional-info-container select").attr('disabled','disabled');
		$("#edit-last-timein").attr('disabled','disabled');
		$("#edit-last-timeout").attr('disabled','disabled');
		for(var x in $("#additional-info-container input")) {
			if (!isNaN(parseFloat(x)) && isFinite(x)) {
				var input = $("#additional-info-container input")[x];
				input.value = advancedData[selectedIndex][input.name];
			}
		}
		$("#password").val("company_default_password");
		$("#drug_test").val(advancedData[selectedIndex].drug_test);
	}

	$("#btn-submit").click(function() {
		if ($("#btn-submit").val() === 'Edit') {
			$("#additional-info-container input").removeAttr('disabled');
			$("#additional-info-container select").removeAttr('disabled');
			$("#edit-last-timein").removeAttr('disabled');
				$("#edit-last-timeout").removeAttr('disabled');
			$("#btn-submit").val('Save');
		} else {
			var default_password = "company_default_password";
			var records = [];
			updateAdditionalInfo(selectedIndex);
		}
	});

	$("#btn-search").click(function() {
		if($("#cbo-category").val() === 'employee-id' || $("#cbo-category").val() === 'name' ||
			 $("#cbo-category").val() === 'nick-name' || $("#cbo-category").val().length === 0) {
			searchValue = $("#txt-search").val();
			getEmployees();
		}
	});


	$(document).scroll(showContractButtons);

	$(window).resize(showContractButtons);

	function showContractButtons() {
		if ($("#contract-selections").css('display') === 'block' && lastSelectedIndex >= 0) {
			var row = hot.getSelectedRange().to.row;
			var col = hot.getSelectedRange().to.col;
			var elem = hot.getCell(row,col); 
			var top = ($("#table-employees").offset().top + elem.offsetTop) - $('body').scrollTop();
			var left = (($("#table-employees").offset().left + elem.offsetLeft) + $(".contract").width() -$("#contract-selections").width()) - $('#table-employees').scrollLeft();
			$("#contract-selections").css({'top':top,'left':left,'display':'block'});
		}
	}

	$(document).dblclick(function(e) {
		var target = e.target;
		if (target.className === 'rowHeader' || target.className === 'relative' || 
				e.target.tagName === 'TH') {
			$("#btn-select").click();
		}		
		if (typeof hot.getSelectedRange() !== 'undefined') {
			if (target.className.match('contract')) {
				var top = $("#table-employees").offset().top + target.offsetTop;
				var left = ($("#table-employees").offset().left + target.offsetLeft) + $(".contract").width() -$("#contract-selections").width();
				var row = hot.getSelectedRange().to.row;
				$('#empID').val(advancedData[row].id);
				$('.empID').val(advancedData[row].id);
				$('.View-Contract').attr('data-id-contract',advancedData[row].id+':'+advancedData[row].contract_id);
				$("#contract-selections").css({'top':top,'left':left,'display':'block'});
				if(advancedData[row].contract === null) {
					$(".btn-contact-edit").css('display','none');
					$(".View-Contract").css('display','none');
					$("#btn-view-contract-log").css('display','none');
				} else {
					if(advancedData[row].contract.length === 0) {
						$(".btn-contact-edit").css('display','none');
						$(".View-Contract").css('display','none');
						$("#btn-view-contract-log").css('display','none');
					} else {
						$(".btn-contact-edit").css('display','');	
						$(".View-Contract").css('display','');
						$("#btn-view-contract-log").css('display','');
						if(myRole === 'admin') {
							$(".btn-Addcontract").css('display','');
						} else {
						 	$(".btn-Addcontract").css('display','none');
						}
					}
				}
			}
			if (target.className.match('shift')) {
				$("#modalShift .modal-body").html("");
				$("#modalShift").modal('show');
			}
		}
	});

	function getShiftLists() {
		$.post(baseUrl+'employees/getShiftMasterLists',function(data) {
			$("#modalShift .modal-body").html(data);
			$(".btn-select-shift").click(function(e) {
				var c = confirm('Are you sure you want to select this shift?');
				if (c === true) {
					advancedData[currentSelectedRow].shift = e.target.value;
					advancedData[currentSelectedRow].shift_id = e.target.id;
					hot.getCell(currentSelectedRow,5).innerHTML = e.target.value;
					var emp_id = advancedData[currentSelectedRow].id;
					var shift_id = e.target.id;
					$.post(baseUrl+'employees/updateEmployeeShift',{id:emp_id,shift_id:shift_id},
						function(success) {
							// hot.validateCells(function(){});
							if (success) {
								bootbox.alert('Successfully selected employees shift');
							} else {
								bootbox.alert('Failed to update employees shift. Please try again.');
							}
						});
					$("#modalShift").modal('hide');
				}
			});
		});
	}

	$("#modalShift").on('shown.bs.modal', function(){
		if (advancedData[currentSelectedRow].shift_id === null) {
			$("#modalShift .modal-body").html("<h2> Invalid Employee </h2>");
		} else if(advancedData[currentSelectedRow].shift_id.length === 0) {
			getShiftLists();
		} else {
			$.post(baseUrl+'employees/getEmployeeShift',{id:advancedData[currentSelectedRow].shift_id},function(data) {
				$("#modalShift .modal-body").html(data);
				$("#btn-change-shift").click(function() {
					getShiftLists();
				});
			});
		}
	});

	$("#cbo-position").change(function() {
		$("#cbo-position-level").val("");
		getPositionLevels();
		searchValue = $(this).val();
		getEmployees();
	});

	$("#cbo-position-level").change(function() {
		getEmployees();
	});

	$("#cbo-status").val("");
	$("#cbo-status").change(function() {
		searchValue = $("#cbo-status").val();
		getEmployees();
	});

	function fillDropDown() {
		$.post(baseUrl + 'employees/getDropdownValues',function(data) {
			names = data.names;
			companies = data.companies;
			positions = data.positions;
			positionLevels = data.positionLevels;
			roles = data.roles;
			myRole = data.role;
			getEmployees();
			getPositions();
			getPositionLevels();

		},'JSON');
	}

	function getNames() {
		$.post(baseUrl + 'employees/getDropdownValues',function(data) {
			names = data.names;
		},'JSON');
	}

	function getPositions() {
		$("#cbo-position option:first-child").attr('disabled','disabled');
		for(var x in positions) {
			$("#cbo-position").append("<option value='" + positions[x] + "'> " + positions[x] + " </option>");
		}
	}

	function getPositionLevels() {
		$("#cbo-position-level").html("");
		$("#cbo-position-level").append( "<option value='' disabled> Level </option>");
		for(var x in positionLevels) {
			if ($("#cbo-position").val() === positionLevels[x].position) {
				$("#cbo-position-level").append("<option value='" + positionLevels[x].positionLevel + "'> " + positionLevels[x].positionLevel + " </option>");			
			}
		}
		$("#cbo-position-level").val("");
	}


	$("#cbo-category").change(function() {
		switch($("#cbo-category").val()) {
			case "name" :
				$(".cbo-position").css('display','none');
				$("#txt-search").css('display','');
				$("#cbo-status").css('display','none');
			break;
			case "employee-id" :
				$(".cbo-position").css('display','none');
				$("#txt-search").css('display','');
				$("#cbo-status").css('display','none');
			break;
			case "nick-name" :
				$(".cbo-position").css('display','none');
				$("#txt-search").css('display','');
				$("#cbo-status").css('display','none');
			break;
			case "position" :
				$("#cbo-position").val("");
				$("#cbo-position-level").val("");
				$(".cbo-position").css('display','inline-block');
				$("#txt-search").css('display','none');
				$("#cbo-position-level").html("");
				$("#cbo-status").css('display','none');
			break;
			case "status":
				$("#cbo-status").val("");
				$(".cbo-position").css('display','none');
				$("#txt-search").css('display','none');
				$("#cbo-status").css('display','inline-block');
			break;
		}
	});

	$(document).click(function(e) {
		var target = e.target;
		var textareaExists = false;
		if (typeof hot.getSelectedRange() !== 'undefined' && positionLevelDropdown === null) {
			var col = hot.getSelectedRange().to.col;
			if (col === 4 && $("#table-employees textarea").length > 0) {
				textareaExists = true;
			}
		}
		if (positionLevelDropdown === null && target.className.match('current') && textareaExists) {
			appendPositionLevelDropdown();
		}
		if (positionLevelDropdown !== null && target.className.match('current')) {
			if (e.target.className.match('position-level')) {
				$("#table-employees textarea").css('display','none');
				$("#table-employees select").css({'width':$("#table-employees .position-level").width()+10
																					});
				$(".position-level-dropdown").css('display','block');
				$("#table-employees textarea").blur();
			} else {
				$("#table-employees textarea").css('display','block');
				$(".position-level-dropdown").css('display','none');
			}
			if (hot.getSelectedRange().to.col === 4) {
				refreshPositionLevel(advancedData[hot.getSelectedRange().to.row].position);
			}
		}
		if (!target.className.match('contract')) {
			$("#contract-selections").css({'display':'none'});
		}
		if (target.className.match('current') && typeof hot.getSelectedRange() !== 'undefined') {
			lastSelectedIndex = hot.getSelectedRange().to.row;
		} else {
			lastSelectedIndex = -1;
		}

		if(currentSelectedRow !== -1) {
			$("#btn-view-contract-log").attr('href',baseUrl+myRole+'/employees/contracts/logs/'+advancedData[currentSelectedRow].id);
		}

		if (target.className.match('modal-backdrop fade in')) {
			$(".close").click();
		}


		if (typeof hot.getSelectedRange() !== 'undefined') {
			currentSelectedRow = hot.getSelectedRange().to.row;
		}

	});

	function appendPositionLevelDropdown() {
		var options = '<option value="">Positon Level</option>';
			$("#table-employees textarea").after("<select class='position-level-dropdown'>"+options+"</select>");
			$("#table-employees select").css('display','none');
			positionLevelDropdown = "";
			$("#table-employees select").change(function(){
				var value = $(".position-level-dropdown")[$(".position-level-dropdown").length-1].value;
				advancedData[hot.getSelectedRange().to.row].position_level = value;
				$("#table-employees textarea").val(value);
				var index = hot.getSelectedRange().to.row;
				hot.getCell(index,5).innerHTML = value;
				hot.selectCell(index,4);
				var data = [];
				data[0] = {'id':advancedData[index],'field':'position_level','position':advancedData[index],'value':value};
				$.post(baseUrl+"employees/saveAll",{'employees':data});
			});
	}

	$("#txt-search").keypress(function(e) {
		if (e.keyCode === 13) {
			searchValue = $(this).val();
			getEmployees();
		}
	});


	function getEmployees() {
		$.post(baseUrl + 'employees/getEmployees',{field:$("#cbo-category").val(),value:searchValue,
																		position_level:$("#cbo-position-level").val()},
			function(data) {

				advancedData = data;
				displayEmployees();

		},'JSON');
	}


	function addEmployee(employee,index) {
		$.post(baseUrl + 'employees/addEmployee',{employee:employee},
			function(data) {
				if (data.success) {
					advancedData[index].id = data.id;
					advancedData[index].profile_id = data.profile_id;
					advancedData[index].picture = data.picture;
					advancedData[index].btnAction = '<a class="btn btn-default btn-view-employee" data-toggle="modal" data-target="#modalAccounts"> <i class="icon-briefcase"></i>Accounts</a><a class="btn btn-default btn-view-profile" data-toggle="modal" data-target="#modalProfile" onclick="modalViewProfile('+advancedData[index].employee_id+')"> <i class="icon-user"></i>Profile</a>'; 
					advancedData[index].nick_name = data.nick_name;
					refresh();
				}
			},'JSON');
	}

	function updateAll(data) {
		var data_arr = [];
		for(var x in data) {
			if (typeof(data[x]) === 'object' && data[x] !== null) {
				var index = data[x][0];
				if (hot.sortIndex.length > 0) {
					index = hot.sortIndex[data[x][0]][0];
				}
				if (advancedData[index].id !== null || advancedData[index].id) {
					if (data[x][1] !== 'name' && data[x][1] !== 'contract') {
						if (data[x][3]) {
							if (data[x][2] !== data[x][3]) {
								var employee = {'index':index,id:advancedData[index].id,'field':data[x][1],'value':data[x][3]};
								if (data[x][1] === 'position_level') {
									employee['position'] = advancedData[index].position;
								}
								data_arr.push(employee);
							}
						}
					}
				} else {
					if (advancedData[index].name !== null && advancedData[index].employee_id !== null) {
						if (advancedData[index].name && advancedData[index].employee_id) {
							addEmployee(advancedData[index],index);
						}
					}
				}
			}
		}
		if (data_arr.length) {
			$.post(baseUrl + 'employees/saveAll',{employees:data_arr});
		}
	}

	function updateAdditionalInfo(index) {
		$('.layout-transparent').show();
		var data = {};
		var inputs = $("#additional-info-container input");
		for(var x = 0 ; x < inputs.length ; x++) {
			data[inputs[x].name] = inputs[x].value;
		}
		data['id'] = advancedData[index].id;
		data['drug_test'] = $("#drug_test").val();
		$.post(baseUrl+'employees/updateAdditionInfo',{employee:data},
			function(errors) {
				$('.layout-transparent').hide();
				if (errors) {
					$("#txt-errors").html("<p>"+errors+"</p>");
				} else {
					$(".close").click();
					for(var x = 0 ; x < inputs.length ; x++) {
						advancedData[selectedIndex][inputs[x].name] = inputs[x].value;
					}
					advancedData[selectedIndex]['drug_test'] = $("#drug_test").val();
					$("#drug_test").val("company_default_password");
					bootbox.alert("Successfully Updated Employee Accounts");
				}
			},'JSON');
	}

	function refreshPositionLevel(position) {
		var options = "<option value=''> Position Level </option>";
		for(var x in positionLevels) {
			if (position === positionLevels[x].position) {
				options += "<option value='"+positionLevels[x].positionLevel+"'>"+positionLevels[x].positionLevel+"</option>";
			}
		}
		$(".position-level-dropdown")[$(".position-level-dropdown").length-1].innerHTML = options;
		$(".position-level-dropdown")[$(".position-level-dropdown").length-1].value = advancedData[hot.getSelectedRange().to.row].position_level;
	}

	function validEmployeeID(value, callback) {
		setTimeout(function() {
			if (value === null) {
				callback(true);
			} else if (value.length === 0) {
				callback(true);
			} else if (value.match(/[0-9a-zA-Z-]{5,}/)) {
		    callback(true);
	    } else {
	    	callback(false);
	    }
    }, 1);
    return false;		
	}

	function validRole(role) {
		var flag = false;
		for(var x in roles) {
			if(roles[x] === role) {
				flag = true;
			}
		}
		return flag;
	}

	function sortData() {
		if (hot.sortIndex.length > 0) {
			var data = [];
			for(var x = 0 ; x < hot.sortIndex.length ; x++) {
				data[x] = advancedData[hot.sortIndex[x][0]];
			}
			advancedData = data;
		}
	}

	function refresh() {
		$.post(baseUrl + 'employees/getDropdownValues',function(data) {

			names = data.names;
			refreshTable();
			sortData();

		},'JSON')
	}

	function refreshTable() {
		displayEmployees();
	}


	function validateShift(value, callback) {
		setTimeout(function() {
			if (value === null) {
				callback(true);
			} else if (value.length === 0) {
				callback(true);
			} else if (value === 'Select Shift') {
		      callback(false);
	    } else {
	    	callback(true);
	    }
    }, 1);
    return false;		
	}

	function displayEmployees() {
		if (hot !== null) {
			hot.destroy();
		}
  	hot = new Handsontable($("#table-employees")[0], {
    data: advancedData,
    manualColumnResize: true,
    manualRowResize: true,
    colHeaders: ["View","Picture","Name","Employee ID","Nick Name","Company","Position","Position Level", "Shift","Contract", "Role", "Status"],
  	stretchH: 'all',
    columnSorting: true,
    contextMenu: true,
    className: "htCenter",
    cells: function (row, col, prop) {
	    var cellProperties = {};
	    $(".btn-view-employee").click(ViewEmployee);
	    if (col === 2) {
    		if(advancedData[row].id !== null) {
	    		cellProperties.readOnly = true;
	    	}
	    }

	    if (col === 10) {
	    	if(myRole !== 'admin') {
		    	if(advancedData[row].role === null) {
		    		cellProperties.readOnly = false;
		    	} else if(validRole(advancedData[row].role) && 
		    			advancedData[row].id !== null)
			      cellProperties.readOnly = true;
			   }
	    }
	    return cellProperties;
  	},
    columns: [
    		{data: 'btnAction', renderer: 'html', className: 'htMiddle htCenter', readOnly: true},
	   		{data: 'picture', renderer: 'html', width: 80, readOnly: true},
	   		{
	   			data: 'name',
	   			type: 'autocomplete',
	   			source: names,
	   			strict: false,
	   			className : 'htLeft'
	   		},
		  	{data: 'employee_id',validator: validEmployeeID, type: 'text'},
		  	{data: 'nick_name', type: 'text', readOnly: true},
		  	{
	      	data: 'company_systems', 
	      	type: 'dropdown',
	      	source: companies
	      },
	      {
	      	data: 'position', 
	      	type: 'text',
	      	readOnly: true
	      },
	      {
	      	data: 'position_level', 
	      	type: 'text',
	      	className: 'position-level current htCenter',
	      	readOnly: true
	      },
	      {
	      	data: 'shift', 
	      	type: 'text',
	      	readOnly: true,
	      	className: 'shift current htCenter',
	      	validator: validateShift
	      },
	      {
	      	data: 'contract', 
	      	type: 'text', 
	      	readOnly: true,
	      	className: 'contract current htCenter'
	      },
	      {data: 'role', type: 'dropdown', source: roles},
	      {data: 'status', type: 'dropdown', source: ['Active', 'Inactive']}
	  	  ]
 	 });
		hot.addHook('afterRender',function() {
			if (advancedData[0].id !== null) {
				hot.validateCells(function(){});
			}
		})
		hot.addHook('afterChange',function(data) {
			updateAll(data);
			if (data[0][1] === 'position' && data[0][2] !== data[0][3]) {
				var index = data[0][0];
				if ($(".position-level-dropdown").length > 0) {
					refreshPositionLevel(advancedData[index].position);
				}
				advancedData[index].position_level = "";
				hot.getCell(index,4).innerHTML = "";
				data[0] = {'id':advancedData[index].id,'field':'position_level','position':advancedData[index].position,'value':''};
				$.post(baseUrl+"employees/saveAll",{'employees':data});
			}
		});
		hot.addHook('beforeRemoveRow',function(e) {
			if (advancedData[e].id !== null || advancedData[e].id) {
				if (advancedData[e].status !== "Trash") {
					var c = confirm('Are you sure you want to remove this employee?');
					if (c === true) {
						$.post(baseUrl + 'employees/deleteEmployee',{id:advancedData[e].id});
						advancedData[e].status = "Trash";
					} else {
						hot.undo();
					}
				} else {
					hot.undo();
					alert("Employee is already trash");
				}
			}
		});
	}
	$("#modalViewProfile form").submit(function() {
		return false;
	});
});

function viewProfile(id) {
	$.post(baseUrl+'employees/getEmployeeProfile',{id:id},function(data) {
    $("#modalViewProfile #txt-errors").html("");
		$("#modalViewProfile .modal-body").html(data);
	});
}

function updateProfile() {
	$.ajax( {
    url: baseUrl+'employees/updateEmployeeProfile',
    type: 'POST',
    data: new FormData( $("#modalViewProfile form")[0] ),
    processData: false,
    contentType: false,
    beforeSend: function() {
  	  $('.layout-transparent').show();
    },
    success:function(data){
    	$("#modalViewProfile #txt-errors").html("");
    	var data = JSON.parse(data);
    	var errors = data.errors;
    	$('.layout-transparent').hide();
    	if(errors.length === 0) {
    		$("#modalViewProfile").modal('hide');
    		bootbox.alert('Successfully Update Employee Profile');
    		if(data.picture.length > 0) {
    			advancedData[currentSelectedRow].picture = data.picture;
    		}
    	} else {
    		for(var x in errors) {
    			$("#modalViewProfile #txt-errors").append(errors[x][0]+"<br>");
    		}
    	}
		}
  });
  return false;
}