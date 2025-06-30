BX.ready(function () {
    grecaptcha.ready(function () {
        grecaptcha.execute('6Lc2AM0pAAAAAKr__gJbAgMTHBPSsogBN8cM70GK', {action: 'send_form'})
            .then(function (token) {
                console.log(token)
            });
    });
})
console.log('token')