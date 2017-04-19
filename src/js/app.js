$(document).ready(function () {
    //sign up and login setup
    var hideSignUp = $('#sign-up-form').hide();
    var hideLogin = $('#login-form').hide();
    var signUpBtn = $('#sign-up-btn');
    var loginBtn = $('#login-btn');
    //tweet setup
    var tweetBtn = $('#tweet-btn');
    var hideTweetForm = $('#tweet-form').hide();
    var textarea = $("textarea");
    var characterCountElement = $("#characterCount");

    signUpBtn.on('click', function (e) {
        e.preventDefault();
        hideSignUp.toggle("slow");
    });

    loginBtn.on('click', function (e) {
        e.preventDefault();
        hideLogin.toggle("slow");
    });


    tweetBtn.on('click', function (e) {
        e.preventDefault();
        hideTweetForm.toggle("slow");
    });


    characterCountElement.html(textarea.val().length + " / " + textarea.attr("maxlength"));

    textarea.on('keyup', function textAreaOnKeyUp() {
        var characterCount = textarea.val().length;
        characterCountElement.html(characterCount + " / " + textarea.attr("maxlength"));

        if (characterCount < 34) {
            characterCountElement.removeClass();
            characterCountElement.addClass("small-character-count");
        } else if (characterCount >= 34 && characterCount < 90) {
            characterCountElement.removeClass();
            characterCountElement.addClass("medium-character-count");
        } else if (characterCount >= 90) {
            characterCountElement.removeClass();
            characterCountElement.addClass("large-character-count");
        }
    });
});