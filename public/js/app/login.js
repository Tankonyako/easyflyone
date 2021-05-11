$(document).ready(function() {

    let loginForm = utils.elements.add("loginForm", "#__e_LoginForm"),
        forgotPasswordForm = utils.elements.add("forgotPasswordForm", "#__e_ForgotPasswordForm"),

        formTogglerLink = utils.elements.add("loginFormTogglerLink", `a[href="#forgotMyPassword"]`),
        createAccountLink = utils.elements.add("registerCreateAccount", `#__e_CreateAccountLink`),

        acceptPolicyCheckBox = utils.elements.add("registerAcceptPolicy", `#__e_AcceptPolicy`);

    function toggleForms()
    {
        if (loginForm.getElement().is(":visible"))
        {
            loginForm.getElement().fadeOut(500);
            forgotPasswordForm.getElement().delay(500).fadeIn(500)
        }
        else
        {
            forgotPasswordForm.getElement().fadeOut(500);
            loginForm.getElement().delay(500).fadeIn(500)
        }
    }

    formTogglerLink.onClick(toggleForms);

    function checkAcceptingPolicy()
    {
        if (this.checked)
            createAccountLink.getElement().removeClass("disabled");
        else
            createAccountLink.getElement().addClass("disabled");
    }

    acceptPolicyCheckBox.onChange(checkAcceptingPolicy);

});
