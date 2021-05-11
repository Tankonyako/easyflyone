$(document).ready(function() {

    let  startBooking        = utils.elements.add("startBooking", "#__e_StartBooking"),

         airportOrigin      = utils.elements.add("startBooking", "#__e_AirportOrigin"),
         airportDestination = utils.elements.add("startBooking", "#__e_AirportDestination"),

         changePassengersCount = utils.elements.add("passengerscount", ".__e_ChangePassengersCount"),

        ticketUid = utils.elements.add("ticketUID", "#__e_TicketUID"),

        searchTicket = utils.elements.add("searchTicket", "#__e_SearchTicket"),
        scanTicket = utils.elements.add("scanQrTicket", "#__e_ScanQRTicket")


    var html5QrcodeScanner = null;
    let passengersCount = 1;

    function onStartBooking()
    {
        window.location.href = `/startbook/${airportOrigin.getValue()}/${airportDestination.getValue()}?p=${passengersCount}`
    }

    function onChangePassengerCount()
    {
        passengersCount = $(this).attr('data-passengers-count');

        changePassengersCount.getElement('.active').removeClass('active');
        $(this).addClass('active');
    }

    function searchTicketCb()
    {
        window.location.href = '/ticket/' + ticketUid.getValue();
    }
    function onScanSuccess(qrCodeMessage) {
        console.log(qrCodeMessage)
        if (qrCodeMessage.startsWith('EFO-'))
        {
            $('.qrScanner').hide();
            html5QrcodeScanner.clear();

            ticketUid.getElement().val(qrCodeMessage);
            searchTicket.getElement().click();
        }
    }
    function scanTicketQR()
    {
        $('.qrScanner').modal({});

        html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 25, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    }

    startBooking.onClick(onStartBooking);
    changePassengersCount.onClick(onChangePassengerCount);
    searchTicket.onClick(searchTicketCb);
    scanTicket.onClick(scanTicketQR)

});
