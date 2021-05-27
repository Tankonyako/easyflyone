$(document).ready(function() {

    let     addNewFlight        = utils.elements.add("addNewFlight", "#__e_AddNewFlight")

    window.onNewFlightClick = function()
    {
        $('#addNewFlights').modal({})
    }

    addNewFlight.onClick(onNewFlightClick)

});
