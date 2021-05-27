$(document).ready(function() {

    let     findUser        = utils.elements.add("findUser", "#__e_FindUser"),
            userSelector        = utils.elements.add("userSelector", "#__e_UserFinder")

    function findUserOnClick()
    {
        window.location.href = `/acp/user/${userSelector.getValue()}`
    }

    findUser.onClick(findUserOnClick)

});
