;(function ( $, window, undefined ) {

    var pluginName = 'b1njAccordion';
        defaults = {
            header    : 'h3',
            conteneur : 'div',
            actif     : 0,
        };

    // Pugin constructor
    function Plugin( element, options ) {
        this.element = element;
        this.$element = $(this.element);
        this.options = $.extend( {}, defaults, options) ;
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype.init = function () {
        var self = this;
        this.$element.find(this.options.conteneur).hide();
        this.$element.find(this.options.header).addClass('accordion-titre');
        this.$element.children(this.options.conteneur + ':eq(' + (this.options.actif - 1) +')').show();
        this.$element.children(this.options.header + ':eq(' + (this.options.actif - 1) +')').addClass('actif');

        this.$element.children(this.options.header).on('click focus', function (e) {
            if(!$(this).hasClass('actif')) {
                self.$element.find(self.options.header).removeClass('actif');
                $(this).parent().find(self.options.conteneur).not($(this).next(self.options.conteneur)).slideUp();
            }
            $(this).toggleClass('actif').next(self.options.conteneur).slideToggle();
        });
    };

    // Adding Plugin to the jQuery.fn object
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
            }
        });
    };

}(jQuery, window, document));