define([
    'uiComponent',
    'ko'
], function(uiComponent, ko) {
    return uiComponent.extend({
        currentTime: ko.observable("Loading Clock..."), //initial value
        initialize: function () {
            this._super();
            setInterval(this.updateTime.bind(this), 1000);
        },
        getTime: function () {
            return this.currentTime;
        },
        updateTime: function () {
            /* Setting new time to our clock variable.
            DOM manipulation will happen automatically */
            this.currentTime(new Date());
        }
    });
});
