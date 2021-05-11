(function() {

    class Ticket {
        constructor(id, generatedDate, passengers, passengerLimit, departureDate, returnDate, willReturn, originIataCode, destinationYataCode, airwayid) {
            this.id = null;
            this.generatedDate = moment().format('DD/MM/YYYY');
            this.passengers = passengers;
            this.passengersLimit = passengerLimit;
            this.departureDate = departureDate;
            this.returnDate = returnDate;
            this.willReturn = willReturn;
            this.originIataCode = originIataCode;
            this.destinationIataCode = destinationYataCode;
            this.airwayid = airwayid;
        }
    }

    class Passenger {
        constructor(firstname, lastname, photo, passportCountry, passportID, passportexpiredate) {
            this.firstname = firstname;
            this.lastname = lastname;
            this.photo = photo;
            this.passportCountry = passportCountry;
            this.passportID = passportID;
            this.passportExpireDate = passportexpiredate;
            this.seatPos = null;
        }
    }

    class SeatPos {
        constructor(x, y) {
            this.x = x;
            this.y = y;
        }
        getFormatted()
        {
            return `${this.y+1}${seatRows[this.x]}`;
        }
    }

    let  content        = utils.elements.add("bookingContent", ".e-booking-content"),

        state           = utils.elements.add("bookingState", "#__e_BookingState"),

        departureDate   = utils.elements.add("departureDate", "#__e_DateDeparture"),
        returnDate      = utils.elements.add("returnDate", "#__e_DateReturn"),

        returnBox      = utils.elements.add("returnBox", ".e-only-return"),
        returnLink      = utils.elements.add("linkReturn", "#__e_LinkReturn"),
        passengersList      = utils.elements.add("passengerList", "#__e_PassengersList"),
        countriesListPlaceholder      = utils.elements.add("countriesPlaceholder", "._t_CountriesSelectorPlaceholder"),

        firstName      = utils.elements.add("firstname", ".__e_FirstName"),
        lastName      = utils.elements.add("lastname", ".__e_LastName"),

        countriesSelector      = utils.elements.add("countriesSelector", ".__e_CountrySelector"),
        passportExpire      = utils.elements.add("passportExpireDate", ".__e_PassportExpireDate"),
        passportID      = utils.elements.add("passportID", ".__e_PassportID"),
        addPassengerLink      = utils.elements.add("passengerAdd", ".__e_AddPassenger"),

        passengerAddError      = utils.elements.add("passengerError", ".__e_PassengerAddError"),

        removePassenger      = utils.elements.add("removepassenger", ".__e_RemovePassenger"),
        selectSeatForPassenger      = utils.elements.add("selectseatpassenger", ".__e_SelectSeat"),
        seatConfirm      = utils.elements.add("confirmSeatSelector", ".__e_SeatConfirm"),

        passengerCount      = utils.elements.add("passengerCount", "#__e_PassengersCount"),
        passengerCountSubmit      = utils.elements.add("passengerCountSubmit", "#__e_PassengersCountSubmit"),
        passengerCountError     = utils.elements.add("passengerCountError", "#__e_PassengersCountError"),

        confirmBooking     = utils.elements.add("confirmbooking", "#__e_ConfirmBooking"),

        emailUser     = utils.elements.add("emailuser", "#__e_EmailUser"),
        doneTicketButton     = utils.elements.add("boneTicketLink", "#__e_DoneTicketButton"),
        emailDoneError     = utils.elements.add("emailDoneError", "#__e_EmailDoneError"),

        Sender     = utils.elements.add("sender", "#__e_Sender")

    const seatRows = 'ABC DEF GHI JKL MNO PQR_STU VWX YZ'.split('');

    var passengerLimit = 6;

    let origin_iata = '', destination_iata = '',
        origin = {}, destination = {},
        airports = [],
        willReturn = false, passengers = [],
        currentSelectSeat = 0, changedState = true,
        stage = 1,
        departureDateValue = moment().format('DD/MM/YYYY'), returnDateValue = moment().add(7, 'days').format('DD/MM/YYYY'),
        completedTicket = null, cost = 0;

    if (currentUser.isLogged)
    {
        // TODO: PHOTO
        passengers.push(new Passenger(currentUser.firstName, currentUser.lastName, 'https://i.imgur.com/kL4xVxs.png', currentUser.passportCountry, currentUser.passportId, currentUser.passportPeriod))
    }

    var seats = [
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'],
        ['F', 'F', 'F', 'X', 'F', 'F', 'F'], // X - NO, F - FREE, T - taked
        ['F', 'F', 'F', 'X', 'F', 'F', 'F']
    ];

    function getByIataCode(code)
    {
        return airports.filter(obj => obj.iata_code === code)[0];
    }

    function setState(title)
    {
        state.setText(title);
    }

    function clearContent()
    {
        content.getElement().html(``);
    }

    function isAllSeatsTaked()
    {
        let selectedSeats = true;
        for (let i = 0; i < passengerLimit; i++)
        {
            if (!passengers[i]) continue;
            if (passengers[i].seatPos == null)
            {
                selectedSeats = false;
                break;
            }
        }
        return selectedSeats;
    }

    function isAllReadyForPay()
    {
        if (!(passengers.length >= passengerLimit))
            return false;

        return isAllSeatsTaked() && utils.testDate(departureDateValue) && utils.testDate(returnDateValue);
    }

    window.serializeTicket = function()
    {
        let ticket = {};
        ticket = JSON.stringify(completedTicket);
        return ticket;
    }

    function setContent(html)
    {
        let km, minToGo;
        content.getElement().html(`
            <div class="row">
                <div class="col-md-4">
                    <h4>Your trip: </h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                        <b>Origin: </b>${origin.name} (${origin_iata}), ${origin.country}, <br>
                            <a class="e-link-black text-right d-block" target="_blank" href="https://www.google.com/maps/search/?api=1&query=${origin._geoloc.lat},${origin._geoloc.lng}">
                            <span class="cil-compass"> Show on map</a>
                        </li>
                        <li class="list-group-item">
                        <b>Destination: </b>${destination.name} (${destination_iata}), ${destination.country}, <br>
                            <a class="e-link-black text-right d-block" target="_blank" href="https://www.google.com/maps/search/?api=1&query=${destination._geoloc.lat},${destination._geoloc.lng}">
                            <span class="cil-compass"> Show on map</a>
                        </li>

                    </ul>
                    <hr class="mt-2 mb-2">
                    ${stage != 1 ? `
                        <h4>Booking info: </h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                            <b>Distance: </b>${km = utils.getDistanceFromLatLonInKm(origin._geoloc.lat, origin._geoloc.lng, destination._geoloc.lat, destination._geoloc.lng).toFixed(2)} km
                            </li>
                            <li class="list-group-item">
                            <b>Passengers: </b>${passengerLimit} people(s)
                            </li>
                            <li class="list-group-item">
                            <b>Duration of flight: </b>${moment.duration(km / 10, "minutes").format("hh:mm", { trim: false }).replaceAll(':', ' hours ').replaceAll('00 hours', '')} minutes
                            </li>
                            <li class="list-group-item">
                            <b>Average cost: </b>${cost = ((((((km / 2 > 11111 ? 11111 : km /2) / 2 * 1.2) > 444 ? 460 : ((km > 666 ? 666 : km) / 2 * 1.2))) * 1.1 * (willReturn ? 1.8 : 1)) * (passengerLimit)).toFixed(2)} €
                            </li>
                        </ul>
                        ${stage == 2 ? `
                        <h4 class="mt-2">Payment:</h4>
                        ${isAllReadyForPay() ? `
                            <p>Congratulations! You have entered all the details and we can start booking for you! Click on the button below to continue.</p>
                            <div class="d-flex">
                                <a class="btn btn-outline-info mr-auto" id="__e_ConfirmBooking"><span class="cil-cash"></span> Confirm booking</a>
                            </div>
                        ` : `
                            <p class="text-danger mb-1">Complete the following steps to proceed booking and payment:</p>
                            <ul class="text-danger">
                                ${passengerLimit != passengers.length ? `<li>Fill information about all passengers.</li>` : ``}
                                ${!isAllSeatsTaked() ? `<li>Select seats for all passengers.</li>` : ``}
                                ${!utils.testDate(departureDateValue) ? `<li>Select departure date</li>` : ``}
                                ${!utils.testDate(returnDateValue) && willReturn ? `<li>Select departure date</li>` : ``}
                            </ul>
                        `}
                        ` : `
                        `}
                    ` : ``}

                </div>
                <div class="col-md ${changedState ? 'fade-in' : ''}">
                    ${html}
                </div>
            </div>
        `);

        if (changedState)
            changedState = !changedState;
    }

    window.changeOneWayOrReturn = function(e)
    {
        willReturn = !willReturn;
        $('.tooltip').remove();
        twoStage();
    }

    function getSeatButtons()
    {
        let out = ``;

        out += '<div class="e-seat-selector">';

        let makedUpLetters = false;
        for (let y = 0; y < seats.length; y++)
        {
            if (!makedUpLetters)
            {
                out += '<div class="e-seat-words">';

                out += `<a class="e-seat-no">е</a>`;
                for (let x = 0; x < seats[y].length; x++)
                    out += `<a class="e-seat-nod">${seatRows[x]}</a>`;
                out += '</div>';

                makedUpLetters = true;
            }
            out += '<div class="e-seat-row">';
            for (let x = -1; x < seats[y].length; x++)
            {
                if (x == -1)
                {
                    out += `<p class="e-seat-no">${y+1}</p>`;
                    continue;
                }
                let seat = seats[y][x].toLowerCase();

                for (let k = 0; k < passengerLimit; k++)
                {
                    if (!passengers[k]) continue;
                    let passenger = passengers[k];

                    if (passenger.seatPos != null && passenger.seatPos.x == x && passenger.seatPos.y == y)
                        seat = `tm-${k}`;
                }

                out += `<a class="e-seat e-seat-${seat} ${seat == "f" ? `__e_SeatConfirm` : ``}" data-seat-x="${x}" data-seat-y="${y}"></a>`;
            }
            out += '</div>';
        }

        out += '</div>';

        return out;
    }

    function getPassengersVisual()
    {
        let out = ``;

        out += '<div class="e-passenger-selector">';

        for (let i = 0; i < passengerLimit; i++)
        {
            if (!passengers[i]) continue;
            let passenger = passengers[i];

            out += `
                <div class="e-passenger row border-bottom pb-3 mb-3 e-passenger-${i}">
                    <div class="col-md-4">
                        <img src="${passenger.photo}" class="e-round w-100">
                        <h3 class="text-center mt-2">#${i+1}</h3>
                    </div>
                    <div class="col-md-8">
                        <h3 class="mb-1 text-left">${passenger.firstname} ${passenger.lastname}</h3>
                        <hr class="mt-1 mb-1">
                        <p class="mb-1 mt-1"><span class="cil-list-low-priority"></span> <b>Passport Country: </b>${passenger.passportCountry}</p>
                        <p class="mb-1 mt-0"><span class="cil-list-low-priority"></span> <b>Passport ID: </b>${passenger.passportID}</p>
                        <p class="mb-1 mt-0"><span class="cil-list-low-priority"></span> <b>Passport Expire Date: </b>${passenger.passportExpireDate}</p>
                        <p class="mb-1 mt-0"><span class="cil-list-low-priority"></span> <b>Seat position: </b>
                            ${passenger.seatPos == null ? `<span class="text-danger">Select a seat for passanger.</span>` :
                `${passenger.seatPos.getFormatted()}`}
                        </p>
                        <div class="d-flex">
                            ${currentSelectSeat == i ? `
                                <a class="btn btn-sm btn-outline-info disabled">Select seat</a>
                            ` : `
                                <a class="btn btn-sm btn-outline-info __e_SelectSeat" data-to-select="${i}">Select seat</a>
                            `}
                            <a class="btn btn-sm btn-outline-danger __e_RemovePassenger ml-2" data-to-remove="${i}">Remove</a>
                        </div>
                    </div>
                </div>
            `;
        }

        out += '</div>';

        return out;
    }

    function getPassengerCreator()
    {
        let out = ``;

        for (let i = 0; i < passengerLimit; i++) {
            if (passengers[i]) continue;

            out += `
                <h4>Passenger #${i+1}</h4>
                <div>
                    <div class="row">
                        <div class="col-md">
                            <label class="mb-1">Passenger First Name:</label>
                            <input class="form-control e-input-black __e_FirstName" type="text" placeholder="First Name" data-for="${i}">
                        </div>
                        <div class="col-md">
                            <label class="mb-1">Passenger Last Name:</label>
                            <input class="form-control e-input-black __e_LastName" type="text" placeholder="First Name" data-for="${i}">
                        </div>
                    </div>

                    <div class="m-1">
                        ${countriesListPlaceholder.getElement().html().replaceAll('___id_', '__e_CountrySelector').replaceAll('___for_', `${i}`)}
                    </div>
                    <div class="m-1">
                        <label class="mb-1">Passenger Passport expire date:</label>
                        <div class="e-datepicker-container">
                            <input class="form-control e-input-black e-datepicker __e_PassportExpireDate" type="text" placeholder="01/01/1980" data-for="${i}">
                            <span class="cil-calendar"></span>
                        </div>
                    </div>

                    <div class="m-1">
                        <label class="mb-1">Passenger Passport ID:</label>
                        <input class="form-control e-input-black __e_PassportID" type="text" placeholder="00000000000" data-for="${i}">
                    </div>
                </div>
                <center><a class="btn btn-outline-dark mt-2 __e_AddPassenger" data-for="${i}"><span class="cil-user-plus"></span> Add passenger</a></center>
                <p class="text-center text-danger mt-1 __e_PassengerAddError"  data-for="${i}"></p>
                <hr>
            `
        }

        return out;
    }

    function threeStage()
    {
        stage = 3;
        changedState = true;

        setState(`Confirming booking...`)

        setContent(`
            <h4 class="text-center">Account</h4>
            <hr>
            <div class="d-flex">

            <div class="m-auto">
                <img src='https://i.imgur.com/kL4xVxs.png' class="rounded rounded-circle mb-2 ml-auto mr-auto">
                ${currentUser.isLogged ? `
                    <h3 class="text-center">${currentUser.firstName} ${currentUser.lastName}</h3>
                ` : `
                    <h3 class="text-center">As guest</h3>
                `}

                <div class="col-md">
                    <label class="mb-1 text-center">Your email (For booking):</label>
                    <input class="form-control e-input-black text-center" id="__e_EmailUser" type="text" placeholder="qwertycoolmail@gmail.com" value="${currentUser.isLogged ? currentUser.contactEmail : ''}">
                </div>
                <hr>
            </div>
            </div>

            <div class="text-center">
                <h3>To pay <strike class="text-muted font-sm">${cost} €</strike> 0 € <span class="badge badge-warning">100% discount</span></h3>
                <hr>
            </div>
            <p class="text-center">By clicking the button below, you agree to the <a href="/privacypolicy" class="e-link-black" target="_blank">Privacy Policy</a> and to the processing of my personal data.</p>

            <p class="text-danger text-center" id="__e_EmailDoneError"></p>
            <div class="d-flex mb-4">

            <div class="m-auto">
                <a class="btn btn-outline-success ${currentUser.isLogged ? `` : `disabled`}" id="__e_DoneTicketButton"><span class="cil-cart"></span> Purchase</a>
            </div>
            </div>

        `);

        emailUser.onInput(function(event) {
            if (!utils.testEmail(emailUser.getValue()))
            {
                emailDoneError.setText('Error! Your email invalid.');
                doneTicketButton.getElement().addClass('disabled');
                return;
            }
            else
            {
                emailDoneError.setText('');
                doneTicketButton.getElement().removeClass('disabled');
                return;
            }
        });

        doneTicketButton.onClick(function(event) {
            Sender.getElement(' input[name="payload"]').val(serializeTicket());
            Sender.getElement(' input[name="email"]').val(emailUser.getValue());

            Sender.getElement().submit();
        });
    }

    function twoStage()
    {
        stage = 2;
        changedState = true;

        setState(`${origin.name} (${origin_iata}) > ${destination.name} (${destination_iata})`)

        setContent(`
            <h4>Dates: </h4>

            <div class="row">
                <div class="m-1 col-md">
                    <label class="mb-1">Departure date:</label>
                    <div class="e-datepicker-container">
                        <input class="form-control e-input-black e-datepicker" type="text" placeholder="01/01/1980" id="__e_DateDeparture" value="${departureDateValue}">
                        <span class="cil-calendar"></span>
                    </div>
                </div>
                <div class="m-1 col-md">
                    <div class="e-only-return">
                        <label class="mb-1">Return date:</label>
                        <div class="e-datepicker-container">
                            <input class="form-control e-input-black e-datepicker" type="text" placeholder="01/01/1980" id="__e_DateReturn" value="${returnDateValue}">
                            <span class="cil-calendar"></span>
                        </div>
                    </div>
                    <a class="btn btn-primary mt-4 ц-100 font-weight-normal" data-toggle="tooltip" data-placement="right" title="" href="#" onclick="changeOneWayOrReturn(this)" id="__e_LinkReturn">I will return</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md border-right">
                    <h2>Select seat: </h2>
                    <hr>
                    ${getSeatButtons()}
                </div>
                <div class="col-md">
                    <h2>Passengers (${passengers.length}/${passengerLimit}): </h2>
                    <hr>
                    <div id="__e_PassengersList">

                    </div>
                    ${getPassengersVisual()}
                    ${passengerLimit <= passengers.length ? `
                        <p class="text-muted text-center">Passengers limit!</p>
                    ` : getPassengerCreator()}

                </div>
            </div>
            <hr>
        `)

        $('.e-datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });

        countriesSelector.getElement().addClass('e-select-advanced').addClass('e-select');

        rebuildSelect2()

        if (willReturn)
        {
            returnBox.getElement().show();
            returnLink.getElement().attr('title', 'Click here if you dont want make a return flight')
        }
        else
        {
            returnBox.getElement().hide();
            returnLink.getElement().attr('title', 'Click here if you want make a return flight')
        }

        returnLink.getElement().html((willReturn ? 'I not will return' : 'I will return') + ' <span class="text-light">?</span>');

        $('[data-toggle="tooltip"]').tooltip()


        removePassenger.onClick(function (event) {
            passengers.splice($(this).attr('data-to-remove'), 1);

            twoStage()
        });

        selectSeatForPassenger.onClick(function (event) {
            currentSelectSeat = parseInt($(this).attr('data-to-select'));

            twoStage()
        });

        seatConfirm.onClick(function (event) {
            if (!(passengers[currentSelectSeat]))
                return;

            let x = parseInt($(this).attr('data-seat-x'));
            let y = parseInt($(this).attr('data-seat-y'));

            let seatPos = new SeatPos(x, y);

            passengers[currentSelectSeat].seatPos = seatPos;

            twoStage()
        });

        addPassengerLink.onClick(function (event) {
            let dataFor = parseInt($(this).attr('data-for'));
            let passenger = new Passenger(
                firstName.getElement(`[data-for="${dataFor}"]`).val(),
                lastName.getElement(`[data-for="${dataFor}"]`).val(),
                'https://i.imgur.com/kL4xVxs.png',
                countriesSelector.getElement(`[data-for="${dataFor}"]`).val(),
                passportID.getElement(`[data-for="${dataFor}"]`).val(),
                passportExpire.getElement(`[data-for="${dataFor}"]`).val()
            );

            for (const k in passenger)
            {
                if (k !== 'seatPos' && (passenger[k] === undefined ||  passenger[k].length <= 1))
                {
                    passengerAddError.getElement(`[data-for="${dataFor}"]`).text('Fill all fields!')
                    return;
                }
            }

            passengers[dataFor] = passenger;

            twoStage();
        });

        departureDate.onChange(function (event) {
            if (!utils.testDate($(this).val())) return;
            departureDateValue = $(this).val();
        })

        returnDate.onChange(function (event) {
            if (!utils.testDate($(this).val())) return;
            returnDateValue = $(this).val();
        })

        confirmBooking.onClick(function (event) {
            if (!isAllReadyForPay()) return;

            let ticket = new Ticket(null, moment().format('DD/MM/YYYY'), passengers, passengerLimit, departureDateValue, returnDateValue, willReturn, origin_iata, destination_iata, 'A-000-000')
            completedTicket = ticket;
            console.log(serializeTicket())
            threeStage();
        })
    }

    function firstStage()
    {
        setState(`Select count os passengers`)


        setContent(`
            <h4>Count of passengers: </h4>

            <div class="row">
                <div class="col-md-4">
                    <div class="m-1">
                        <label class="mb-1">Count of passengers (from 1 to ${passengerLimit})</label>
                        <input class="form-control e-input-black" type="number" min="1" max="${passengerLimit}" placeholder="3" id="__e_PassengersCount">
                    </div>
                </div>
            </div>
            <p class="text-danger" id="__e_PassengersCountError"></p>
            <a class="btn btn-outline-info mt-2" id="__e_PassengersCountSubmit"><span class="cil-airplane-mode"></span> Go next stage</a>
        `);

        passengerCountSubmit.onClick(function (event) {
            if (passengerCount.getValue() >= 1 && passengerLimit >= passengerCount.getValue())
            {
                passengerLimit = parseInt(passengerCount.getValue());
                twoStage();
            }
            else
            {
                passengerCountError.setText("You cant set this limit!")
            }
        });
    }

    function onLoaded(airports_f)
    {
        airports = airports_f;

        console.log('loaded ' + airports.length);
        console.log('From ' + origin_iata + ' to ' + destination_iata)

        if ((!(origin = getByIataCode(origin_iata)) || !(destination = getByIataCode(destination_iata))) || origin_iata === destination_iata)
        {
            setState('Error.');
            content.getElement().html(`
                <p class="text-center mt-5"><span class="text-center cil-x-circle  font-5xl"></span></p>
                <h1 class="text-center">Oops... Sorry.</h1>
                <h3 class="text-center">This way is not allowed.</h3>
            `);
            return;
        }

        let passengers = utils.getUrlParams().get('p');
        if (!(passengers >= 1 && passengerLimit >= passengers))
        {
            firstStage()
            return;
        }

        passengerLimit = parseInt(passengers);

        twoStage()
    }

    window.startBooking = function(origin_iata_f, destination_iata_f)
    {
        origin_iata = origin_iata_f;
        destination_iata = destination_iata_f;

        $.getJSON('/data/airports.json', onLoaded);
    }

})();
