(function() {

    window.utils = {};

    var dateRegex = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/g
    var emailRegex = /^[^@ ]+@[^@ ]+\.[^@ ]+$/;

    window.utils.getDistanceFromLatLonInKm = function(lat1,lon1,lat2,lon2) {
        var R = 6371;
        var dLat = deg2rad(lat2-lat1);
        var dLon = deg2rad(lon2-lon1);
        var a =
            Math.sin(dLat/2) * Math.sin(dLat/2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon/2) * Math.sin(dLon/2)
        ;
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return d;
    }

    window.utils.getUrlParams = function()
    {
        const urlParams = new URLSearchParams(window.location.search);

        return urlParams;
    }

    window.utils.testDate = function(date)
    {
        try
        {
            return date.match(dateRegex) != null;
        } catch (e) {

        }
        return false;
    }

    window.utils.testEmail = function(date)
    {
        try
        {
            return date.match(emailRegex) != null;
        } catch (e) {

        }
        return false;
    }

    function deg2rad(deg) {
        return deg * (Math.PI/180)
    }

    (function() {
        let elements = {};

        class E_Element {
            constructor(name, selector) {
                this.name = name;
                this.selector = selector;
            }

            getElement(addSelector = '') {
                return $(this.selector + addSelector);
            }

            onClick(ev, cancelEvent = true) {
                this.getElement().click(function(e) {
                    if (cancelEvent)
                        e.preventDefault();

                    ev.apply(this, e);
                })
            }

            onChange(ev, cancelEvent = false) {
                this.getElement().change(function(e) {
                    if (cancelEvent)
                        e.preventDefault();

                    ev.apply(this, e);
                })
            }
            onInput(ev, cancelEvent = false) {
                this.getElement().on("input", function(e) {
                    if (cancelEvent)
                        e.preventDefault();

                    ev.apply(this, e);
                });
            }

            getValue() {
                return this.getElement().val();
            }

            setValue(val) {
                return this.getElement().val(val);
            }

            setText(text) {
                return this.getElement().text(text);
            }

            setHtml(text) {
                return this.getElement().html(text);
            }
        }

        elements.elements = {};
        elements.add = function(name, selector) {
            if (selector === undefined)
                selector = `#${name}`;

            let element = new E_Element(name, selector);
                elements.elements[name] = element;

            return element;
        };
        elements.get = function(name) {
            return elements.elements[name];
        };

        utils.elements = elements;
    })();



})();
