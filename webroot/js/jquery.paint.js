/*!
 * jQuery.paint
 *
 * Copyright (c) 2012 ほと(@hoto17296).
 * http://blog.hotolab.net/
 */

(function($){

	$.fn.paint = function( method ) { if ( methods[method] ) { return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 )); } else if ( typeof method === 'object' || ! method ) { return methods.init.apply( this, arguments ); } else { $.error( 'Method ' + method + ' does not exist on jQuery.paint' ); } };

	var status = {
		shape : 'hand',
		color : '000000',
		thickness : 10,
	};

	var options = {
		prefix : 'paint',
		width : 640,
		height : 480,
		menu : {
			save  : '保存',
			undo  : 'やり直し',
			clear : 'クリア',
		},
		shape : {
			hand : '〜 手書き',
			line : '＼ 直線',
			rect : '□ 四角',
			arc  : '◯ 円',
		},
		slider : {
			orientation: 'vertical',
			animate: 'slow',
			range: 'min',
			value: 10,
			min: 1,
			max: 40,
			slide: function(event, ui){
				status.thickness = ui.value;
				$('#'+options.prefix+'-property-thickness-val').val(ui.value);
			}
		},
		colorpicker : {},
		file : null,
		upload : function(image){}
	};
	
	var drawFlag = false;
	var undoImg = null;
	var c = { elem:null, w:options.width, h:options.height };
	var p = {
			x:0,	oldX:0,
			y:0,	oldY:0,
			pos: function(e){
				var rect = e.target.getBoundingClientRect();
				this.x = e.clientX - rect.left;
				this.y = e.clientY - rect.top;
			},
			savePos: function(e){
				this.pos(e);
				this.oldX = this.x;
				this.oldY = this.y;
			}
	};

	var methods = {
	
		init : function(args) {
			var obj = this;
			
			options = $.extend(options, args);
			console.log(options);
			
			var prfx = options.prefix;
			
			$(obj).append(
				$('<form/>').addClass(prfx+'-tool').append(
					$('<div/>').addClass(prfx+'-menu')
				).append(
					(function(){
						var menu = $('<div/>').addClass(prfx+'-menu');
						$.each(options.menu, function(key,val){
							menu.append(
								$('<button/>').attr('type','button').addClass(prfx+'-menu-'+key).text(val).button().click(function(){
									methods[ key ].apply();
								})
							);
						});
						return menu;
					})()
				).append(
					(function(){
						var shape = $('<div/>').addClass(prfx+'-shape');
						$.each(options.shape, function(key,val){
							shape.append(
								$('<input/>')
									.attr({type:'radio', value:key, name:prfx+'-shape-checkbox', id:prfx+'-shape-'+key})
									.change(function(){
										status.shape = $(this).val();
									})
							).append( $('<label/>').attr('for',prfx+'-shape-'+key).text(val) );
						});
						return shape.buttonset();
					})()
				).append(
					$('<div/>').addClass(prfx+'-property').append(
						$('<div/>').addClass(prfx+'-property-color')
							.append( $('<label/>').text('色') )
							.append(
								$('<div/>').css('background-color','#'+status.color)
									.colorpicker(options.colorpicker)
									.on('changeColor', function(event){ status.color = event.color; })
							)
					).append(
						$('<div/>').addClass(prfx+'-property-thickness')
							.append( $('<label/>').attr('for', prfx+'-property-thickness-val').text('太さ') )
							.append(
								$('<input/>')
									.attr({type:'text', value:options.slider.value, id:prfx+'-property-thickness-val'})
									.addClass(prfx+'-property-thickness-val')
							).append( $('<div/>').addClass(prfx+'-property-thickness-slider').slider(options.slider) )
					)
				).append(
					$('<div/>').addClass(prfx+'-canvas').append(
						$('<canvas/>').addClass(prfx+'-canvas-file')
							.attr({width:options.width,height:options.height})
							.drawRect({ fillStyle:"#fff", x:0, y:0, width:options.width, height:options.height, fromCenter:false })
							.text('このブラウザはCanvasに対応していません')
					).append(
						$('<canvas/>').addClass(prfx+'-canvas-draw')
							.attr({width:options.width, height:options.height})
							.mousedown(methods.mousedown).bind('touchstart', methods.mousedown)
							.mouseup(methods.mouseup).bind('touchend', methods.mouseup)
							.mousemove(methods.mousemove).bind('touchmove', methods.touchmove)
							.mouseout(methods.mouseout).bind('touchcancel', methods.mouseout)
					)
				)
			);
			
			c.elem = $('.'+options.prefix+'-canvas-draw');
			
			if (options.file) methods.load(options.file);
			
			return this;
		},
		
		load : function(file){
			var img = new Image();
			img.src = file;
			img.onload = function(){
				c.w = img.width; c.h = img.height;
				$('.'+options.prefix+'-canvas canvas').attr({ width: img.width, height: img.height });
				$('.'+options.prefix+'-canvas-file').drawImage({ source: img.src, fromCenter: false });
			};
		},
		
		save : function(){
			$('.'+options.prefix+'-canvas-file').draw(function(ctx){ ctx.drawImage(c.elem[0], 0, 0); });
			var image = $('.'+options.prefix+'-canvas-file').getCanvasImage("jpeg");
			
			options.upload(image);
		},
		
		undo : function(){
			if(undoImg==null) return;
			var tmp = undoImg;
			methods.saveUndo();
			c.elem.loadCanvas().putImageData(tmp, 0, 0);
		},
		
		clear : function(){
			undoImg = null;
			c.elem.clearCanvas();
		},
		
		mousedown : function(e){
			drawFlag = true;
			p.savePos(e);
			methods.saveUndo();
		},
		mousemove : function(e){
			if(!drawFlag) return;
			p.pos(e);
			switch(status.shape){
			case 'hand':
				$(this).drawLine({
					strokeStyle: status.color,
					strokeWidth: status.thickness,
					strokeCap: "round",
					strokeJoin: "miter",
					x1: p.oldX, x2: p.x,
					y1: p.oldY, y2: p.y
				});
				p.savePos(e);
				break;
			case 'line':
				$(this).loadCanvas().putImageData(undoImg, 0, 0);
				$(this).drawLine({
					strokeStyle: status.color,
					strokeWidth: status.thickness,
					strokeCap: "round",
					strokeJoin: "miter",
					x1: p.oldX, x2: p.x,
					y1: p.oldY, y2: p.y
				});
				break;
			case 'rect':
				$(this).loadCanvas().putImageData(undoImg, 0, 0);
				$(this).drawRect({
					strokeStyle: status.color,
					strokeWidth: status.thickness,
					x: p.oldX, y: p.oldY,
					width: p.x - p.oldX,
					height: p.y - p.oldY,
					fromCenter: false
				});
				break;
			case 'arc':
				$(this).loadCanvas().putImageData(undoImg, 0, 0);
				$(this).drawEllipse({
					strokeStyle: status.color,
					strokeWidth: status.thickness,
					x: p.oldX, y: p.oldY,
					width: p.x - p.oldX,
					height: p.y - p.oldY,
					fromCenter: false
				});
				break;
			}
		},
		mouseup : function(e){ drawFlag = false; },
		mouseout : function(e){ drawFlag = false; },
    touchmove : function(e){
      methods.mousemove(e);
      event.preventDefault();
    },
		
		saveUndo : function(){
			undoImg = c.elem.loadCanvas().getImageData(0, 0, c.w, c.h);
		},
	};
	
})(jQuery);
