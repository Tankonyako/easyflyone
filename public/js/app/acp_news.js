$(document).ready(function() {

    let     addNewPost        = utils.elements.add("addNewNews", "#__e_AddNewPost"),
        formPost        = utils.elements.add("PostForm", "#__e_PostForm"),
        formPostSubmit        = utils.elements.add("PostFormSubmit", "#__e_PostFormSubmit"),
        formPostDescription        = utils.elements.add("PostFormDescription", "#__e_PostFormDescription")

    window.onNewNewsClick = function()
    {
        $('#addNewPost').modal({})
    }
    function onFormSubmit()
    {
        formPostDescription.setValue(btoa(marked(newsEditor.value())));

        formPost.getElement().submit();
    }

    addNewPost.onClick(onNewNewsClick)
    formPostSubmit.onClick(onFormSubmit)

    let newsEditor = new EasyMDE({element: document.getElementById('post-text')});
});
