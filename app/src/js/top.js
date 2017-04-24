require('../less/common.less');
require('../less/top.less');
var IScroll = require('iscroll')

$(function(){
		
		function ll(){
			var myScroll = new IScroll('#wrapper',{
				scrollbars: true,
				mouseWheel: true,
				interactiveScrollbars: true,
				shrinkScrollbars: 'scale',
				fadeScrollbars: true
			})
		}
		
	ll()
	

})