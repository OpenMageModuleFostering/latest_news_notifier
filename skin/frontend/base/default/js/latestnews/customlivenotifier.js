	var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
	var stack_bottomleft = {"dir1": "right", "dir2": "up", "push": "top"};
	var stack_custom = {"dir1": "right", "dir2": "down"};
	var stack_custom2 = {"dir1": "left", "dir2": "up", "push": "top"};
	var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
	var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
	var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
	jQuery(document).ready(function() {
		setTimeout( "fire_ajax();",5000);
	});
	function fire_ajax() {
		var host = window.location.protocol+'//'+window.location.host+'/';
		jQuery.ajax({
			url : host+'m8/index.php/latestnews/index/notifytimer',
			success : function(data) {
				//console.log(data);
				jQuery.parseJSON(data);
		   		var parsed = JSON.parse(data);
				if(parsed['code'] == 'big')
				{
					show_stack_bar_bottom(data);
				}
				else {
					show_stack_bottomright(data);
				}
			}
		});
	}
	function show_stack_bottomright(data) {
		jQuery.parseJSON(data);
		var parser = JSON.parse(data);
		var opts = {
		        title: parser['title'],
		        text: parser['description'],
		        addclass: "stack-bottomright",
		        type : "success",
		        icon: "icon-gift",
		        hide: false,
		        insert_brs : false ,
		        stack: stack_bottomright
		    };
	    jQuery.pnotify(opts);
	}
	function show_stack_bar_bottom(data) {
		jQuery.parseJSON(data);
		var parser = JSON.parse(data);
	    var opts = {
	        title: parser['title'],
	        text: parser['description'],
	        addclass: "stack-bar-bottom",
	        cornerclass: "",
	        width: "70%",
	        hide: false,
	        insert_brs : false ,
	        type : "success",
	        icon : "icon-shopping-cart",
	        stack: stack_bar_bottom
	    };
	    jQuery.pnotify(opts);
	}