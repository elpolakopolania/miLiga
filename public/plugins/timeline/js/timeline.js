(function(){jQuery(function(){return $.jackInTheBox=function(t,i){var o=this;return"",this.settings={},this.$element=$(t),this.getSetting=function(t){return this.settings[t]},this.callSettingFunction=function(t,i){return null==i&&(i=[]),this.settings[t].apply(this,i)},this.mobileDevice=function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)},this.visible=function(t){var i,n,s,e;return s=(e=o.$window.scrollTop())+o.$window.height()-o.settings.offset,i=(n=t.offset().top)+t.height(),n<=s&&e<=i},this.scrollHandler=function(){return o.$window.scroll(function(){return o.show()})},this.show=function(){return o.$boxes.each(function(t,i){var n;return n=$(i),o.visible(n)?n.css({visibility:"visible"}).addClass(o.settings.animateClass):void 0})},this.init=function(){return this.settings=$.extend({},this.defaults,i),this.$window=$(window),this.$boxes=$("."+this.settings.boxClass).css({visibility:"hidden"}),this.$boxes.length?(this.scrollHandler(),this.show()):void 0},this.mobileDevice()||this.init(),this},$.jackInTheBox.prototype.defaults={boxClass:"box",animateClass:"animated",offset:0},$.fn.jackInTheBox=function(i){return this.each(function(){var t;return void 0===$(this).data("jackInTheBox")?(t=new $.jackInTheBox(this,i),$(this).data("jackInTheBox",t)):void 0})}})}).call(this),$(function(){$("body").jackInTheBox()});